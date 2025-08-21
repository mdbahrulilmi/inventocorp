<?php

namespace App\Filament\Resources\Borrows\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Flex;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;


class BorrowForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Repeater::make('items')
                    ->label('Borrowed Items')
                    ->schema([
                        Select::make('item_id')
                            ->label('Item')
                            ->options(\App\Models\Inventory::pluck('code', 'id'))
                            ->searchable()
                            ->required(),
                        TextInput::make('quantity')
                            ->label('Quantity')
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->required(),
                    ])
                    ->columns(2)
                    ->minItems(1)
                    ->required(),

                Flex::make([
                    DatePicker::make('loan_date')
                    ->label('Borrow date')
                    ->native(false)
                    ->minDate(today())
                    ->maxDate(today())
                    ->default(today()),
                    DatePicker::make('due_date')
                    ->label('Due date')
                    ->native(false)
                    ->minDate(today()->addDays(1))
                    ->maxDate(today()->addDays(7)),
                ])                
            ]);
    }
}
