<?php

namespace App\Filament\Resources\Accounts\Resources\Transactions\Schemas;

use App\Enums\TransactionType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('related_account_id')
                    ->relationship('relatedAccount', 'name')
                    ->required(),
                Select::make('type')
                    ->options(TransactionType::class)
                    ->default('income')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                TextInput::make('charge')
                    ->required()
                    ->numeric()
                    ->default(10),
                TextInput::make('balance')
                    ->required()
                    ->numeric(),
            ]);
    }
}
