<?php

namespace App\Filament\Resources\Accounts\Schemas;

use App\Enums\AccountType;
use App\Models\Account;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccountInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([

                Section::make('Base Details')
                    ->description('These details contains type and balance.')
                    ->aside()
                    ->columns()
                    ->schema([
                        TextEntry::make('type')
                            ->label('Account Type')
                            ->badge(),
                        TextEntry::make('balance')
                            ->label('Account Balance')
                            ->badge()
                            ->money('NPR'),
                    ]),
                Section::make(fn (Account $record) => $record->type === AccountType::Bank ? 'Bank Details' : 'Mobile Wallet Details')
                    ->hidden(fn (Account $record) => $record->type === AccountType::Cash)
                    ->description(fn (Account $record) => $record->type === AccountType::Bank ? 'These details are used for bank transactions.' : 'These details are used for mobile wallet transactions.')
                    ->aside()
                    ->schema([
                        TextEntry::make('account_name')
                            ->label(fn (Account $record) => $record->type === AccountType::Bank ? 'Account Holder Name' : 'Wallet Holder Name')
                            ->placeholder('N/A')
                            ->copyable()
                            ->badge(),
                        TextEntry::make('account_number')
                            ->label(fn (Account $record) => $record->type === AccountType::Bank ? 'Account Number' : 'Wallet Number')
                            ->placeholder('N/A')
                            ->copyable()
                            ->badge(),
                        TextEntry::make('bank_name')
                            ->label(fn (Account $record) => $record->type === AccountType::Bank ? 'Bank Name' : 'Wallet Provider')
                            ->placeholder('N/A')
                            ->copyable()
                            ->badge(),
                    ]),
            ]);
    }
}
