<?php

namespace App\Filament\Resources\Inventories\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

use Filament\Schemas\Schema;

class InventoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title'),
                TextInput::make('code')
                ->hidden()
                ->disabled()
                ->dehydrated(true),
                Select::make('category_id')
                ->label('Category')
                ->relationship('category', 'title')
                ->required()
                ->native(false),
                TextInput::make('available_quantity')
                ->hidden()
                ->disabled()
                ->dehydrated(true),
                TextInput::make('quantity')
                ->numeric()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    $set('available_quantity', $state);
                }),
                TextInput::make('location')
            ]);
    }
}
