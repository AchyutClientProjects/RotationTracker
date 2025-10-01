<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Schemas;

use App\Enums\AccountType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

final class AccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Base Details')
                    ->description('These details contains type and balance.')
                    ->aside()
                    ->schema([
                        Select::make('type')
                            ->options(AccountType::class)
                            ->default('bank')
                            ->live()
                            ->required(),
                        TextInput::make('balance')
                            ->required()
                            ->prefix('NPR')
                            ->numeric()
                            ->default(0),
                    ]),
                Section::make(fn (Get $get): string => $get('type') === AccountType::Bank ? 'Bank Details' : 'Mobile Wallet Details')
                    ->description(fn (Get $get): string => $get('type') === AccountType::Bank ? 'These details are used for bank transactions.' : 'These details are used for mobile wallet transactions.')
                    ->hidden(fn (Get $get): bool => $get('type') === AccountType::Cash)
                    ->aside()
                    ->schema([
                        TextInput::make('account_name')
                            ->label(fn (Get $get): string => $get('type') === AccountType::Bank ? 'Account Holder Name' : 'Wallet Holder Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('account_number')
                            ->label(fn (Get $get): string => $get('type') === AccountType::Bank ? 'Account Number' : 'Wallet Number')
                            ->required()
                            ->maxLength(50),
                        TextInput::make('bank_name')
                            ->label(fn (Get $get): string => $get('type') === AccountType::Bank ? 'Bank Name' : 'Wallet Provider')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }
}
