<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Loan;

class ReportStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Loans', Loan::count()),

            Stat::make('Active Loans', Loan::where('status', 'borrowed')->count())
                ->description('Currently borrowed')
                ->color('warning'),

            Stat::make('Returned', Loan::where('status', 'returned')->count())
                ->description('Successfully returned')
                ->color('success'),

            Stat::make('Overdue', Loan::where('status', 'overdue')->count())
                ->description('Need follow up')
                ->color('danger'),
        ];
    }
}
