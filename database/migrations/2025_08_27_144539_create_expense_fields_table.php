<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expense_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('terminal_id')->constrained('terminals')->onDelete('cascade'); 
            $table->string('expense_type');
            $table->decimal('commission_rate', 5, 2)->default(0);
            $table->decimal('min_commission', 10, 2)->nullable();
            $table->decimal('max_commission', 10, 2)->nullable();
            $table->string('created_by')->default('System');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expense_fields');
    }
};
