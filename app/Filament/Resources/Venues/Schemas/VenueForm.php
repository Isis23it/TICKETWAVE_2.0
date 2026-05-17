<?php

namespace App\Filament\Resources\Venues\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

/**
 * Formulario para crear y editar Recintos.
 * Campos en español con validaciones y valores por defecto.
 */
class VenueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),

                TextInput::make('city')
                    ->label('Ciudad')
                    ->required(),

                TextInput::make('state')
                    ->label('Estado')
                    ->required(),

                TextInput::make('neighborhood')
                    ->label('Colonia'),

                TextInput::make('country')
                    ->label('País')
                    ->required()
                    ->default('México'),

                TextInput::make('postal_code')
                    ->label('Código postal'),

                TextInput::make('address')
                    ->label('Dirección'),

                TextInput::make('capacity')
                    ->label('Capacidad')
                    ->required()
                    ->numeric(),

                TextInput::make('latitude')
                    ->label('Latitud')
                    ->numeric(),

                TextInput::make('longitude')
                    ->label('Longitud')
                    ->numeric(),

                FileUpload::make('image_url')
                    ->label('Imagen')
                    ->image()
                    ->disk('public')
                    ->directory('venues')
                    ->maxSize(2048),

                Toggle::make('active')
                    ->label('Activo')
                    ->required()
                    ->default(true),
            ]);
    }
}