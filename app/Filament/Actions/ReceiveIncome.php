<?php

declare(strict_types=1);

namespace App\Filament\Actions;

use App\Enums\TransactionType;
use App\Models\Account;
use Filament\Actions\Action;
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
            ])
            ->action(function (array $data, Account $record): void {
                $record->transactions()->create([
                    'type' => TransactionType::Income,
                    'amount' => $data['amount'],
                    'charge' => 0,
                ]);

                $record->balance += $data['amount'];
                $record->save();
            })
            ->requiresConfirmation()
            ->successNotificationTitle('Income Received');
    }
}
