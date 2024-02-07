<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\{Pages, RelationManagers};
use App\Models\{Customer, Order, Product};
use Filament\Forms\Components\{Fieldset, Placeholder, Repeater, Section, Select, TextInput};
use Filament\Forms\{Form, Get, Set};
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\{Forms, Tables};
use Illuminate\Database\Eloquent\{Builder, SoftDeletingScope};

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Pedido';

    protected static ?string $pluralModelLabel = 'Pedidos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Dados do pedido')->schema([
                    Select::make('customer_id')
                        ->label('Cliente')
                        ->reactive()
                        ->relationship('customer', 'name')
                        ->required(),

                    Select::make('status')->options([
                        'new'        => 'Novo',
                        'processing' => 'Em Preparo',
                        'shipped'    => 'Enviado',
                        'delivered'  => 'Entregue',
                        'canceled'   => 'Cancelado',
                    ])->label('Status')->required()->default('new'),

                    Select::make('payment')->options([
                        'pix'         => 'Pix',
                        'cash'        => 'Em Dinheiro',
                        'debit_card'  => 'Cartão de debito',
                        'credit_card' => 'Cartão de credito',
                    ])->label('Metodo de pagamento')->required()->default('pix'),

                    Select::make('adreesses_id')
                        ->label('Endereço')
                        ->options(function (Get $get) {

                            if (!$get('customer_id')) {
                                return [];
                            }

                            $customer = Customer::find($get('customer_id'));

                            //return $customer->addresses->pluck('street', 'id');

                            return $customer->adreesses->pluck('street', 'id');
                        })
                        ->required(),
                    TextInput::make('total_price')
                        ->label('Preço Total')
                        ->readOnly()
                        ->reactive()
                        ->required(),

                    Placeholder::make('.')
                        ->content(function (Get $get, Set $set): string {
                            if ($get('items')) {
                                $set('total_price', collect($get('items'))->sum('subtotal'));
                                // dump($get('total_price'));

                                return "";
                                //return 'R$ ' . number_format(collect($get('products'))->sum('subtotal'), 2);
                            }
                            $set('total_price', 0);

                            return "";
                        }),
                ]),

                /*    Placeholder::make('total')
                ->content(function (Get $get): string {
                    return '€' . number_format($get('cost') * $get('quantity'), 2);
                }), */

                Section::make('Produtos')->columns(2)->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                                ->label('Produto')
                                ->reactive()
                                ->options(Product::query()->pluck('name', 'id'))
                                ->required(),

                            TextInput::make('quantity')
                                ->label('Quantidade')
                                ->numeric()
                                ->default(0)
                                ->reactive()
                                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                    $set('subtotal', $state * Product::find($get('product_id'))?->price ?? 0);
                                })
                                ->required(),

                            TextInput::make('subtotal')
                                ->label('Preço Total')
                                ->readOnly()
                                ->default(0)
                                ->required(),
                        ])->columns(3),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'        => 'success',
                        'processing' => 'warning',
                        'shipped'    => 'info',
                        'delivered'  => 'gray',
                        'canceled'   => 'danger',
                    })->formatStateUsing(fn (string $state): string => match ($state) {
                        'new'        => 'Novo',
                        'processing' => 'Em Preparo',
                        'shipped'    => 'Enviado',
                        'delivered'  => 'Entregue',
                        'canceled'   => 'Cancelado',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment')
                    ->label('Pagamento')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Preço Total')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view'   => Pages\ViewOrder::route('/{record}'),
            'edit'   => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
