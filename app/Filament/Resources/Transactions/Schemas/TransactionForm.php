<?php

namespace App\Filament\Resources\Transactions\Schemas;

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
                Select::make('account_id')
                    ->relationship('account', 'name')
                    ->required(),
                TextInput::make('related_account_id')
                    ->required()
                    ->numeric(),
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
            ]);
    }
}
