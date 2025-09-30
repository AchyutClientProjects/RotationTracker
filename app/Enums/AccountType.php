<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum AccountType: string implements HasColor, HasIcon, HasLabel
{
    case Bank = 'bank';
    case Cash = 'cash';
    case DigitalWallet = 'digital_wallet';

    public function getLabel(): string
    {
        return match ($this) {
            self::Bank => 'Bank',
            self::Cash => 'Cash',
            self::DigitalWallet => 'Digital Wallet',
        };
    }

    public function getIcon(): Heroicon
    {
        return match ($this) {
            self::Bank => Heroicon::BuildingLibrary,
            self::Cash => Heroicon::Banknotes,
            self::DigitalWallet => Heroicon::DevicePhoneMobile,
        };
    }

    public function getColor(): array
    {
        return match ($this) {
            self::Bank => Color::Red,
            self::Cash => Color::Green,
            self::DigitalWallet => Color::Blue,
        };
    }
}
