<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('name')
                ->required()
                ->maxLength(64),
                TextInput::make('email')
                ->required()
                ->label('Email address'),
                TextInput::make('phone')
                ->required()
                ->label('Phone number'),
                Select::make('role')
                ->required()
                ->options([
                    'admin' => 'Admin',
                    'member' => 'Member'
                ])
                ->native(false),
                TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->required(fn (string $operation): bool => $operation === 'create')
            ]);
    }
}
