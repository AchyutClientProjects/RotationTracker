<?php

declare(strict_types=1);

namespace App\Models;

use AchyutN\LaravelHelpers\Traits\HasTheSlug;
use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property AccountType $type
 * @property string|null $account_name
 * @property string|null $account_number
 * @property string|null $bank_name
 * @property string $balance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Transaction> $transactions
 * @property-read int|null $transactions_count
 *
 * @method static Builder<static>|Account findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder<static>|Account newModelQuery()
 * @method static Builder<static>|Account newQuery()
 * @method static Builder<static>|Account query()
 * @method static Builder<static>|Account whereAccountName($value)
 * @method static Builder<static>|Account whereAccountNumber($value)
 * @method static Builder<static>|Account whereBalance($value)
 * @method static Builder<static>|Account whereBankName($value)
 * @method static Builder<static>|Account whereCreatedAt($value)
 * @method static Builder<static>|Account whereId($value)
 * @method static Builder<static>|Account whereName($value)
 * @method static Builder<static>|Account whereSlug($value)
 * @method static Builder<static>|Account whereType($value)
 * @method static Builder<static>|Account whereUpdatedAt($value)
 * @method static Builder<static>|Account withUniqueSlugConstraints(Model $model, string $attribute, array $config, string $slug)
 *
 * @mixin \Eloquent
 */
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
