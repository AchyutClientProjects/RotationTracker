<?php

declare(strict_types=1);

namespace App\Filament\Schemas;

use App\Enums\AccountType;
use App\Models\Account;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

final class AccountDetailsSchema
{
    public static function configure(Schema $schema, Account $account): Schema
    {
        return $schema
            ->components([
                TextEntry::make('type')
                    ->label('Account Type')
                    ->badge(),
                TextEntry::make('account_name')
                    ->label(fn (): string => $account->type === AccountType::Bank ? 'Account Holder Name' : 'Wallet Holder Name')
                    ->hidden(fn (): bool => $account->type === AccountType::Cash)
                    ->placeholder('N/A')
                    ->copyable()
                    ->badge(),
                TextEntry::make('account_number')
                    ->label(fn (): string => $account->type === AccountType::Bank ? 'Account Number' : 'Wallet Number')
                    ->hidden(fn (): bool => $account->type === AccountType::Cash)
                    ->placeholder('N/A')
                    ->copyable()
                    ->badge(),
                TextEntry::make('bank_name')
                    ->label(fn (): string => $account->type === AccountType::Bank ? 'Bank Name' : 'Wallet Provider')
                    ->hidden(fn (): bool => $account->type === AccountType::Cash)
                    ->placeholder('N/A')
                    ->copyable()
                    ->badge(),
            ]);
    }
}
