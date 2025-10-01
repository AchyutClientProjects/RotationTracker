<?php

declare(strict_types=1);

use App\Enums\TransactionType;
use App\Models\Account;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->foreignIdFor(Account::class)
                ->constrained()
                ->cascadeOnDelete();
            $blueprint->foreignIdFor(Account::class, 'related_account_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $blueprint->string('type')->default(TransactionType::Income);
            $blueprint->decimal('amount', 15);
            $blueprint->decimal('charge', 15)->default(10);
            $blueprint->decimal('balance', 15);
            $blueprint->text('note')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
