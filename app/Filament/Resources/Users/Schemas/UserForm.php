<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Livewire\Component as Livewire;
use Illuminate\Support\Facades\Auth;

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
              ->maxLength(255)
              ->validationMessages([
                'required' => 'El nombre es obligatorio.',
                'max'      => 'El nombre no puede superar los 255 caracteres.',
              ]),

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
              ->helperText('Debe ser único en la plataforma')
              ->validationMessages([
                'required' => 'El correo electrónico es obligatorio.',
                'email'    => 'Ingresa un correo electrónico válido.',
                'unique'   => 'Este correo ya está registrado.',
                'max'      => 'El correo no puede superar los 255 caracteres.',
              ]),
          ]),

        Section::make('Rol y acceso')
          ->columns(2)
          ->schema([
            Select::make('role')
              ->label('Rol')
              ->required()
              ->options([
                'comprador'  => 'Comprador',
                'organizer'  => 'Organizador',
                'admin'      => 'Administrador',
              ])
              ->helperText('Define los permisos del usuario en la plataforma')
              ->disabled(
                fn(Livewire $livewire): bool =>
                isset($livewire->record) &&
                  $livewire->record->id === Auth::id()
              )
              ->validationMessages([
                'required' => 'El rol es obligatorio.',
              ]),

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
              ->helperText('Dejar vacío para mantener la contraseña actual')
              ->validationMessages([
                'min' => 'La contraseña debe tener al menos 8 caracteres.',
              ]),
          ]),
      ]);
  }
}
