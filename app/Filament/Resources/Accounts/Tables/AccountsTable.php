<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Tables;

use App\Filament\Actions\ReceiveIncome;
use Filament\Actions\ActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\RecordActionsPosition;
use Filament\Tables\Table;

final class AccountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    TextColumn::make('name'),
                    TextColumn::make('type')
                        ->badge(),
                    TextColumn::make('balance')
                        ->money('NPR')
                        ->badge(),
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    ReceiveIncome::make(),
                ])
                    ->label('Actions')
                    ->icon(Heroicon::Cog8Tooth),
            ], position: RecordActionsPosition::BeforeColumns)
            ->defaultSort('balance', 'desc')
            ->paginated(false);
    }
}
