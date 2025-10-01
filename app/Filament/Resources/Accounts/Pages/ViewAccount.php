<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Pages;

use App\Filament\Actions\AddExpense;
use App\Filament\Actions\ReceiveIncome;
use App\Filament\Actions\TransferAmount;
use App\Filament\Resources\Accounts\AccountResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

final class ViewAccount extends ViewRecord
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            ReceiveIncome::make(),
            AddExpense::make(),
            TransferAmount::make(),
        ];
    }
}
