<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Resources\Transactions\Pages;

use App\Filament\Resources\Accounts\Resources\Transactions\TransactionResource;
use Filament\Resources\Pages\ViewRecord;

final class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
