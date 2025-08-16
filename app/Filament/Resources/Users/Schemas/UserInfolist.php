<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('name')
                    ->label('Name')
                    ->weight('bold')
                    ->color('primary'),

                TextEntry::make('email')
                    ->label('Email Address')
                    ->icon('heroicon-m-envelope'),

                TextEntry::make('phone')
                    ->label('Phone Number')
                    ->icon('heroicon-m-phone'),

                TextEntry::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'member' => 'success',
                        default => 'gray',
                    }),
                ]);
    }
}
