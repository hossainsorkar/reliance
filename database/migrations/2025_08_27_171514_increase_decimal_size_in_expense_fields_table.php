<?php

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
    Schema::table('expense_fields', function (Blueprint $table) {
        $table->decimal('commission_rate', 15, 2)->change();
        $table->decimal('min_commission', 20, 2)->nullable()->change();
        $table->decimal('max_commission', 20, 2)->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('expense_fields', function (Blueprint $table) {
        $table->decimal('commission_rate', 10, 2)->change();
        $table->decimal('min_commission', 10, 2)->nullable()->change();
        $table->decimal('max_commission', 10, 2)->nullable()->change();
    });
}

};
