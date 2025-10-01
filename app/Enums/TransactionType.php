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
    case TransferIn = 'transfer_in';
    case TransferOut = 'transfer_out';

    public function getLabel(): string
    {
        return match ($this) {
            self::Income => 'Income',
            self::Expense => 'Expense',
            self::TransferIn => 'Transfer In',
            self::TransferOut => 'Transfer Out',
        };
    }

    public function getIcon(): Heroicon
    {
        return match ($this) {
            self::Income => Heroicon::ArrowUpCircle,
            self::Expense => Heroicon::ArrowDownCircle,
            self::TransferIn => Heroicon::ArrowRightEndOnRectangle,
            self::TransferOut => Heroicon::ArrowRightStartOnRectangle,
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::Income => Color::Green,
            self::Expense => Color::Red,
            self::TransferIn => Color::Blue,
            self::TransferOut => Color::Orange,
        };
    }
}
