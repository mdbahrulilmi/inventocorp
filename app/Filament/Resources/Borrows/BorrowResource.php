<?php

namespace App\Filament\Resources\Borrows;

use App\Filament\Resources\Borrows\Pages\CreateBorrow;
use App\Filament\Resources\Borrows\Pages\ListBorrows;
use App\Filament\Resources\Borrows\Schemas\BorrowForm;
use App\Filament\Resources\Borrows\Tables\BorrowsTable;
use App\Models\Loan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BorrowResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PlusCircle;
    
    protected static ?string $navigationLabel = 'Borrow';

    protected static ?string $recordTitleAttribute = 'Borrow';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'member';
    }

    public static function form(Schema $schema): Schema
    {
        return BorrowForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BorrowsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBorrows::route('/'),
            'create' => CreateBorrow::route('/create'),
        ];
    }
}
