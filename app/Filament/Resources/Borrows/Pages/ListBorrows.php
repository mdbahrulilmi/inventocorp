<?php

namespace App\Filament\Resources\Borrows\Pages;

use App\Filament\Resources\Borrows\BorrowResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBorrows extends ListRecords
{
    protected static string $resource = BorrowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getHeading(): string
    {
        return 'Loan History';
    }

    public function getTitle(): string
    {
        return 'Loan History';
    }
}
