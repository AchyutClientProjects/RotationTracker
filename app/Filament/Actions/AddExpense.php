<?php

declare(strict_types=1);

namespace App\Filament\Actions;

use App\Enums\TransactionType;
use App\Models\Account;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Icons\Heroicon;

final class AddExpense
{
    public static function make(?string $name = 'Add Expense'): Action
    {
        return Action::make($name)
            ->slideOver()
            ->icon(Heroicon::ArrowUp)
            ->schema([
                TextInput::make('amount')
                    ->label('Amount')
                    ->required()
                    ->numeric()
                    ->prefix('NPR')
                    ->minValue(0.01)
                    ->step(0.01)
                    ->placeholder('0.00'),
                Checkbox::make('include_charge')
                    ->label('Include Charge')
                    ->live(),
                TextInput::make('charge')
                    ->hidden(fn (Get $get): bool => ! $get('include_charge'))
                    ->label('Charge')
                    ->default(10)
                    ->numeric()
                    ->prefix('NPR')
                    ->minValue(0)
                    ->step(0.01)
                    ->placeholder('0.00'),
                Textarea::make('note')
                    ->label('Note')
                    ->rows(3)
                    ->placeholder('Optional note...'),
            ])
            ->action(function (array $data, Account $account): void {
                $charge = $data['include_charge'] ? ($data['charge'] ?? 0) : 0;

                $balance = (float) $account->balance - (float) $data['amount'] - (float) $charge;
                $account->update(['balance' => $balance]);

                $account->transactions()->create([
                    'type' => TransactionType::Expense,
                    'amount' => $data['amount'],
                    'charge' => $charge,
                    'balance' => $balance,
                    'note' => $data['note'] ?? null,
                ]);
            })
            ->requiresConfirmation()
            ->successNotificationTitle('Expense Added');
    }
}
