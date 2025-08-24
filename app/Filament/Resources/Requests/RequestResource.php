<?php

namespace App\Filament\Resources\Requests;

use App\Filament\Resources\Requests\Pages\ListRequests;
use App\Filament\Resources\Requests\Tables\RequestsTable;
use App\Models\Loan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class RequestResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleBottomCenterText;

    protected static ?string $navigationLabel = 'Request';

    protected static ?string $breadcrumb = 'Management Request';

    protected static string | UnitEnum | null $navigationGroup = 'Admin';

    protected static ?string $recordTitleAttribute = 'Request';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }


    
    public static function form(Schema $schema): Schema
    {
        return RequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RequestsTable::configure($table);
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
            'index' => ListRequests::route('/'),
        ];
    }
}
