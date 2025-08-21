<?php

namespace App\Filament\Resources\Borrows\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class BorrowsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) =>
                $query->where('user_id', Auth::id())
            )
            ->columns([
                Tables\Columns\TextColumn::make('loan_date')
                    ->label('Borrow Date')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('due_date')
                    ->label('Due Date')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('return_date')
                    ->label('Return Date')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'returned',
                        'danger'  => 'overdue',
                        'warning' => 'borrowed',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('details.item.title')
                    ->label('Item Code')
                    ->listWithLineBreaks()
                    ->limit(20),
            ])
            ->filters([
                //
            ]);
    }
}
