<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Widgets;

use App\Models\Account;
use App\Models\Transaction;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class StatsOverview extends StatsOverviewWidget
{
    protected int|array|null $columns = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Current Balance', function (): string {
                $accounts = Account::query()->get();
                $totalBalance = $accounts->sum('balance');

                return 'NPR '.number_format($totalBalance, 2);
            })
                ->icon(Heroicon::CurrencyDollar),
            Stat::make('Charges Paid', function (): string {
                $transactions = Transaction::query()->get();
                $totalCharge = $transactions->sum('charge');

                return 'NPR '.number_format($totalCharge, 2);
            })
                ->icon(Heroicon::CreditCard),
        ];
    }
}
