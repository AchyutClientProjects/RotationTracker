<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Pages;

use App\Filament\Resources\Accounts\AccountResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateAccount extends CreateRecord
{
    protected static string $resource = AccountResource::class;

    protected static bool $canCreateAnother = false;
}
