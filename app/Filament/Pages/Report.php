<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use BackedEnum;


class Report extends Page
{
    protected string $view = 'filament.pages.report';

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected static ?string $recordTitleAttribute = 'Report';

    protected static string | UnitEnum | null $navigationGroup = 'Admin';

}
