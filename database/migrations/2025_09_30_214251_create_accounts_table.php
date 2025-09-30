<?php

declare(strict_types=1);

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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->storedAs("
                CASE
                    WHEN account_name IS NULL AND bank_name IS NULL AND account_number IS NULL
                        THEN 'Cash'
                    ELSE CONCAT(
                        COALESCE(account_name, ''),
                        CASE WHEN account_name IS NOT NULL AND bank_name IS NOT NULL THEN ' - ' ELSE '' END,
                        COALESCE(bank_name, ''),
                        CASE WHEN account_number IS NOT NULL THEN CONCAT(' (', account_number, ')') ELSE '' END
                    )
                END
            ")->nullable();
            $table->string('slug')->nullable();
            $table->string('type')->default(App\Enums\AccountType::Bank);
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->decimal('balance', 15)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
