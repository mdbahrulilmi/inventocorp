<?php

namespace App\Filament\Resources\Requests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;

class RequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id'),
                TextColumn::make('details.item.title'),
                TextColumn::make('loan_date'),
                TextColumn::make('due_date'),
                TextColumn::make('return_date'),
                SelectColumn::make('status')
                ->label('Status')
                ->options([
                    'requested' => 'Requested',
                    'accepted' => 'Accepted',
                    'rejected' => 'Rejected',
                    'borrowed' => 'Borrowed',
                    'returned' => 'Returned',
                    'overdue' => 'Overdue',
                ])
                ->native(false),
            ])
            ->emptyStateHeading('No Request');
    }
}
