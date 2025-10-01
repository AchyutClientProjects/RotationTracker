<?php

declare(strict_types=1);

namespace App\Filament\Resources\Accounts\Resources\Transactions;

use App\Filament\Resources\Accounts\AccountResource;
use App\Filament\Resources\Accounts\Resources\Transactions\Pages\CreateTransaction;
use App\Filament\Resources\Accounts\Resources\Transactions\Pages\EditTransaction;
use App\Filament\Resources\Accounts\Resources\Transactions\Pages\ViewTransaction;
use App\Filament\Resources\Accounts\Resources\Transactions\Schemas\TransactionForm;
use App\Filament\Resources\Accounts\Resources\Transactions\Schemas\TransactionInfolist;
use App\Filament\Resources\Accounts\Resources\Transactions\Tables\TransactionsTable;
use App\Models\Transaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = AccountResource::class;

    public static function form(Schema $schema): Schema
    {
        return TransactionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TransactionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransactionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateTransaction::route('/create'),
            'view' => ViewTransaction::route('/{record}'),
            'edit' => EditTransaction::route('/{record}/edit'),
        ];
    }
}
