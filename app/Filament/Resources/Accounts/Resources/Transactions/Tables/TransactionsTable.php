<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Resources\Transactions\Tables;

use App\Enums\TransactionType;
use App\Filament\Resources\Accounts\AccountResource;
use App\Models\Transaction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('relatedAccount.name')
                    ->url(fn (Transaction $transaction): string => $transaction->relatedAccount !== null ? AccountResource::getUrl('view', ['record' => $transaction->relatedAccount]) : '')
                    ->placeholder('N/A'),
                TextColumn::make('type')
                    ->badge(),
                TextColumn::make('amount')
                    ->money('NPR')
                    ->color(fn (Transaction $transaction): array => match ($transaction->type) {
                        TransactionType::Expense, TransactionType::TransferOut => Color::Red,
                        TransactionType::Income, TransactionType::TransferIn => Color::Green,
                    })
                    ->badge(),
                TextColumn::make('charge')
                    ->badge()
                    ->color(fn (Transaction $transaction): array => $transaction->charge > 0 ? Color::Red : Color::Gray)
                    ->money('NPR'),
                TextColumn::make('balance')
                    ->money('NPR')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false)
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
