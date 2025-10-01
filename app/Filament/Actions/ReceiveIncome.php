<?php

declare(strict_types=1);

namespace App\Filament\Actions;

use App\Enums\TransactionType;
use App\Models\Account;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;

final class ReceiveIncome
{
    public static function make(?string $name = 'Receive Income'): Action
    {
        return Action::make($name)
            ->slideOver()
            ->icon(Heroicon::ArrowDown)
            ->schema([
                TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->numeric()
                    ->prefix('NPR')
                    ->minValue(0.01)
                    ->step(0.01)
                    ->placeholder('0.00'),
                Textarea::make('note')
                    ->label('Note')
                    ->rows(3)
                    ->placeholder('Optional note...'),
            ])
            ->action(function (array $data, Account $account): void {
                $balance = (float) $account->balance + (float) $data['amount'];
                $account->update(['balance' => $balance]);

                $account->transactions()->create([
                    'type' => TransactionType::Income,
                    'amount' => $data['amount'],
                    'charge' => 0,
                    'balance' => $balance,
                    'note' => $data['note'] ?? null,
                ]);
            })
            ->requiresConfirmation()
            ->successNotificationTitle('Income Received');
    }
}
