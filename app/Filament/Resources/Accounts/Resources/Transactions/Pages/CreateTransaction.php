<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Resources\Transactions\Pages;

use App\Filament\Resources\Accounts\Resources\Transactions\TransactionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;
}
