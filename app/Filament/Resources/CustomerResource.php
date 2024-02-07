<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\{Pages, RelationManagers};
use App\Models\Customer;
use Filament\Forms\Components\{Fieldset, Repeater, Select, TextInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\{Forms, Tables};
use Illuminate\Database\Eloquent\{Builder, SoftDeletingScope};
use Illuminate\Support\Facades\Hash;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Cliente';

    protected static ?string $pluralModelLabel = 'Clientes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Informações Pessoais')->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->tel()
                        ->required()
                        ->mask('(99) 99999-9999')

                        ->maxLength(255),
                    Forms\Components\TextInput::make('cpf')
                        ->required()
                        ->mask('999.999.999-99')
                        ->minLength(11)
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->email()

                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context): bool => $context === 'create')
                        ->disabled(fn (string $context): bool => $context === 'edit'),
                ]),

                Fieldset::make('Endereços do cliente')->schema([
                    Repeater::make('adreesses')
                        ->relationship()
                        ->label('Endereços')
                        ->schema([
                            TextInput::make('street')->required()->label('Endereço'),
                            TextInput::make('neighborhood')->required()->label('Bairro'),
                            TextInput::make('city')->required()->label('Cidade'),
                            TextInput::make('cep')->required()->label('CEP'),
                        ])
                        ->columns(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index'  => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view'   => Pages\ViewCustomer::route('/{record}'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
