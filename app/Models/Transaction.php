<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $account_id
 * @property int|null $related_account_id
 * @property TransactionType $type
 * @property string $amount
 * @property string $charge
 * @property string $balance
 * @property string|null $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Account $account
 * @property-read \App\Models\Account|null $relatedAccount
 * @method static Builder<static>|Transaction newModelQuery()
 * @method static Builder<static>|Transaction newQuery()
 * @method static Builder<static>|Transaction query()
 * @method static Builder<static>|Transaction whereAccountId($value)
 * @method static Builder<static>|Transaction whereAmount($value)
 * @method static Builder<static>|Transaction whereBalance($value)
 * @method static Builder<static>|Transaction whereCharge($value)
 * @method static Builder<static>|Transaction whereCreatedAt($value)
 * @method static Builder<static>|Transaction whereId($value)
 * @method static Builder<static>|Transaction whereNote($value)
 * @method static Builder<static>|Transaction whereRelatedAccountId($value)
 * @method static Builder<static>|Transaction whereType($value)
 * @method static Builder<static>|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Transaction extends Model
{
    /** @returns BelongsTo<Account> */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /** @returns BelongsTo<Account> */
    public function relatedAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    protected function casts(): array
    {
        return [
            'type' => TransactionType::class,
        ];
    }
}
