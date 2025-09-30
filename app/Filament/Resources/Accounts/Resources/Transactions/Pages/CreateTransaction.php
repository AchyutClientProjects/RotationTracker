<?php

namespace App\Filament\Resources\Accounts\Resources\Transactions\Pages;

use App\Filament\Resources\Accounts\Resources\Transactions\TransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;
}
