<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Account extends Model
{
    protected function casts(): array
    {
        return [
            'type' => \App\Enums\AccountType::class,
        ];
    }
}
