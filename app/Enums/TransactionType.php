<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum TransactionType: string implements HasColor, HasIcon, HasLabel
{
    case Income = 'income';
    case Expense = 'expense';
    case Transfer = 'transfer';

    public function getLabel(): string
    {
        return match ($this) {
            self::Income => 'Income',
            self::Expense => 'Expense',
            self::Transfer => 'Transfer',
        };
    }

    public function getIcon(): Heroicon
    {
        return match ($this) {
            self::Income => Heroicon::ArrowUpCircle,
            self::Expense => Heroicon::ArrowDownCircle,
            self::Transfer => Heroicon::ArrowsRightLeft,
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::Income => Color::Green,
            self::Expense => Color::Red,
            self::Transfer => Color::Blue,
        };
    }
}
