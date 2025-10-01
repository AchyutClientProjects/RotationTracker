<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Resources\Transactions\Schemas;

use App\Enums\TransactionType;
use App\Filament\Schemas\AccountDetailsSchema;
use App\Models\Transaction;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;

final class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns()
            ->components([
                Grid::make(1)
                    ->schema([
                        Section::make('Account Details')
                            ->description('These are the details related to the account this transaction belongs to.')
                            ->relationship('account')
                            ->hidden(fn (Transaction $transaction): bool => $transaction->account === null)
                            ->collapsed()
                            ->components(fn (Schema $schema, Transaction $transaction): array => AccountDetailsSchema::configure($schema, $transaction->account)->getComponents()),
                        Section::make('Related Account Details')
                            ->description('These are the details related to the other account involved in this transaction, if any.')
                            ->relationship('relatedAccount')
                            ->hidden(fn (Transaction $transaction): bool => $transaction->relatedAccount === null)
                            ->collapsed()
                            ->components(fn (Schema $schema, Transaction $transaction): array => AccountDetailsSchema::configure($schema, $transaction->relatedAccount)->getComponents()),
                    ]),
                Grid::make(1)
                    ->schema([
                        Section::make()
                            ->columns(1)
                            ->schema([
                                TextEntry::make('type')
                                    ->badge(),
                                TextEntry::make('amount')
                                    ->badge()
                                    ->color(fn (Transaction $transaction): array => match ($transaction->type) {
                                        TransactionType::Expense, TransactionType::TransferOut => Color::Red,
                                        TransactionType::Income, TransactionType::TransferIn => Color::Green,
                                    })
                                    ->money('NPR'),
                                TextEntry::make('charge')
                                    ->color(fn (Transaction $transaction): array => $transaction->charge > 0 ? Color::Red : Color::Gray)
                                    ->badge()
                                    ->money('NPR'),
                                TextEntry::make('balance')
                                    ->badge()
                                    ->money('NPR'),
                                TextEntry::make('note')
                                    ->placeholder('N/A')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }
}
