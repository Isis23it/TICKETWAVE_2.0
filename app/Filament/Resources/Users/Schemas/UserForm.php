<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('Información personal')
          ->columns(2)
          ->schema([
            TextInput::make('name')
              ->label('Nombre')
              ->required()
              ->maxLength(255),

            TextInput::make('email')
              ->label('Correo electrónico')
              ->email()
              ->required()
              ->maxLength(255)
              ->unique(
                table: 'users',
                column: 'email',
                ignoreRecord: true
              )
              ->helperText('Debe ser único en la plataforma'),
          ]),

        Section::make('Rol y acceso')
          ->columns(2)
          ->schema([
            Select::make('role')
              ->label('Rol')
              ->required()
              ->options([
                'buyer'     => 'Comprador',
                'organizer' => 'Organizador',
                'admin'     => 'Administrador',
              ])
              ->helperText('Define los permisos del usuario en la plataforma'),

            TextInput::make('password')
              ->label('Nueva contraseña')
              ->password()
              ->minLength(8)
              ->dehydrateStateUsing(
                fn($state) => filled($state)
                  ? bcrypt($state)
                  : null
              )
              ->dehydrated(fn($state) => filled($state))
              ->nullable()
              ->helperText('Dejar vacío para mantener la contraseña actual'),
          ]),
      ]);
  }
}
