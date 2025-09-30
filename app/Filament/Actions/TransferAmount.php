<?php

declare(strict_types=1);

namespace App\Filament\Actions;

use App\Enums\TransactionType;
use App\Models\Account;
use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Icons\Heroicon;

final class TransferAmount
{
    public static function make($name = 'Transfer Amount'): Action
    {
        return Action::make($name)
            ->slideOver()
            ->icon(Heroicon::ArrowPath)
            ->schema([
                Select::make('to_account_id')
                    ->label('To Account')
                    ->required()
                    ->options(fn (Account $account): array => Account::where('id', '!=', $account->id)->pluck('name', 'id')->toArray())
                    ->placeholder('Select an account'),
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
            ])
            ->action(function (array $data, Account $account): void {
                $charge = $data['include_charge'] ? ($data['charge'] ?? 0) : 0;
                $toAccount = Account::findOrFail($data['to_account_id']);

                $account->transactions()->create([
                    'type' => TransactionType::TransferOut,
                    'amount' => $data['amount'],
                    'charge' => $charge,
                    'related_account_id' => $toAccount->id,
                ]);
                $account->balance -= ($data['amount'] + $charge);
                $account->save();

                $toAccount->transactions()->create([
                    'type' => TransactionType::TransferIn,
                    'amount' => $data['amount'],
                    'charge' => 0,
                    'related_account_id' => $account->id,
                ]);
                $toAccount->balance += $data['amount'];
                $toAccount->save();
            })
            ->requiresConfirmation()
            ->successNotificationTitle('Amount Transferred');
    }
}
