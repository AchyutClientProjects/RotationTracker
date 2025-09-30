<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\TransactionType;
use App\Models\Account;

final class AccountObserver
{
    public function created(Account $account): void
    {
        $account->transactions()->create([
            'type' => TransactionType::Income,
            'amount' => $account->balance,
            'charge' => 0,
            'balance' => $account->balance,
        ]);
    }
}
