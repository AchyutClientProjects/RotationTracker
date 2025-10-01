<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Resources\Transactions\Schemas;

use App\Filament\Schemas\AccountDetailsSchema;
use App\Models\Transaction;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns()
            ->components([
                Section::make('Account Details')
                    ->description('These details are related to the account.')
                    ->relationship('account')
                    ->collapsed()
                    ->components(fn (Schema $schema, Transaction $transaction) => AccountDetailsSchema::configure($schema, $transaction->account)->getComponents()),
                Section::make('Related Account Details')
                    ->description('These details are related to the associated account, if any.')
                    ->relationship('relatedAccount')
                    ->collapsed()
                    ->components(fn (Schema $schema, Transaction $transaction) => AccountDetailsSchema::configure($schema, $transaction->relatedAccount)->getComponents()),
            ]);
    }
}
