<?php

namespace App\Filament\Pages;

use App\Models\Loan;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use BackedEnum;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class Report extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.report';

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected static string | UnitEnum | null $navigationGroup = 'Admin';

    /**
     * Tabel laporan
     */
    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(Loan::query()->whereIn('status', ['borrowed', 'returned', 'overdue']))
            ->columns([
                Tables\Columns\TextColumn::make('user.id')->label('User')->searchable(),
                Tables\Columns\TextColumn::make('item')->label('Item')->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'borrowed',
                        'success' => 'returned',
                        'danger'  => 'overdue',
                    ]),
                Tables\Columns\TextColumn::make('borrowed_at')->label('Borrowed'),
                Tables\Columns\TextColumn::make('returned_at')->label('Returned'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'borrowed'  => 'Borrowed',
                        'returned'  => 'Returned',
                        'overdue'   => 'Overdue',
                    ]),
            ])
            ->emptyStateHeading('No loan')
            ->headerActions([
                ExportAction::make()
                    ->label('Export')
                    ->exports([
                        \pxlrbt\FilamentExcel\Exports\ExcelExport::make('Loans')
                            ->fromTable()
                            ->withFilename('loans-' . now()->format('Y-m-d')),
                    ]),
                ]);

    }

    /**
     * Statistik ringkas (widget)
     */
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Livewire\ReportStats::class,
        ];
    }
}
