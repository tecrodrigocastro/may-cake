<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\{Pages, RelationManagers};
use App\Models\{Adreesse, Customer, Order, Product, User};
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
                    Select::make('user_id')
                        ->label('Cliente')
                        ->options(User::where('type', 'customer')->pluck('name', 'id'))
                        ->reactive()
                        //->relationship('user', 'name')
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

                            if (!$get('user_id')) {
                                return [];
                            }

                            $customer = User::find($get('user_id'));

                            //return $customer->addresses->pluck('street', 'id');

                            $addresses = Adreesse::where('user_id', $customer->id)->get();

                            return  $addresses->pluck('street', 'id');
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

                                return "";
                            }
                            $set('total_price', 0);

                            return "";
                        }),
                ]),

                /*    Placeholder::make('total')
                ->content(function (Get $get): string {
                    return '€' . number_format($get('cost') * $get('quantity'), 2);
                }), */

                Section::make('Produtos')->schema([
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
                                    $set('subtotal', $state * Product::find($get('product_id'))->price);
                                })
                                ->required(),

                            TextInput::make('subtotal')
                                ->label('Preço Total')
                                ->readOnly()
                                ->default(0)
                                ->required(),
                        ])->columns(3),
                ])->columnSpanFull()->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
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
                        default      => 'success',
                    })->formatStateUsing(fn (string $state): string => match ($state) {
                        'new'        => 'Novo',
                        'processing' => 'Em Preparo',
                        'shipped'    => 'Enviado',
                        'delivered'  => 'Entregue',
                        'canceled'   => 'Cancelado',
                        default      => 'Novo',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment')
                    ->label('Pagamento')
                    ->searchable()
                    ->sortable()->formatStateUsing(fn (string $state): string => match ($state) {
                        'pix'         => 'Pix',
                        'cash'        => 'Em Dinheiro',
                        'credit_card' => 'Cartão de Credito',
                        'debit_card'  => 'Cartão de Debito',
                        default       => 'Pix',
                    }),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Preço Total')
                    ->money('brl')
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
