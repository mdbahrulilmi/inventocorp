<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use App\Models\Inventory;
use Filament\Tables\Columns\TextColumn;

class AvailableItems extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.available-items';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Inbox;


    public function table(Tables\Table $table): Tables\Table
    {
        return $table
             ->query(Inventory::query())
             ->columns([
                TextColumn::make('category.title')
                ->label('Category')
                ->searchable(),
                TextColumn::make('title')
                ->label('Title')
                ->searchable(),
                TextColumn::make('code')
                ->label('Code')
                ->searchable(),
                TextColumn::make('available_quantity')
                ->label('Available Quantity'),
                TextColumn::make('location')
                ->label('Location'),
            ]);
    }
}
