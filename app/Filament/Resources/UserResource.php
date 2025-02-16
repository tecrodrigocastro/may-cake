<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\{Pages, RelationManagers};
use App\Models\User;
use Filament\Forms\Components\{DateTimePicker, Fieldset, Repeater, Select, TextInput};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\{Forms, Tables};
use Illuminate\Database\Eloquent\{Builder, SoftDeletingScope};
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Informações Pessoais')->schema([
                    TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->label('Telefone')
                        ->tel()
                        ->required()
                        ->mask('(99) 99999-9999'),
                    TextInput::make('cpf')
                        ->label('CPF')
                        ->required()
                        ->mask('999.999.999-99')
                        ->minLength(11),
                    TextInput::make('email')
                        ->label('E-mail')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    //DateTimePicker::make('email_verified_at'),
                    TextInput::make('password')
                        ->label('Senha')
                        ->password()
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                        ->dehydrated(fn ($state) => filled($state))
                        ->required(fn (string $context): bool => $context === 'create')
                        ->disabled(function (string $context): bool {

                            //dd(auth()->id(), request()->route('record'), $context);

                            return $context === 'edit'; // && auth()->id() != request()->route('record');
                        }),

                    Select::make('type')
                    ->label('Tipo de usuário')
                    ->options([
                        'admin'    => 'Administrador',
                        'customer' => 'Cliente',
                    ]),

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
                        ->columns(2)->grid(2)->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view'   => Pages\ViewUser::route('/{record}'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
