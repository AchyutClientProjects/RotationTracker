<?php

declare(strict_types=1);

namespace App\Models;

use AchyutN\LaravelHelpers\Traits\HasTheSlug;
use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Account extends Model
{
    use HasTheSlug;

    protected string $sluggableColumn = 'name';

    /** @returns HasMany<Transaction> */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    protected function casts(): array
    {
        return [
            'type' => AccountType::class,
        ];
    }
}
