<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->date('bill_date');
            $table->string('bill_no')->unique();
            $table->string('type')->nullable();

            // Foreign keys
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('party_id')->constrained()->onDelete('cascade');

            // Amounts
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('received_amount', 12, 2)->default(0);
            $table->decimal('due_amount', 12, 2)->default(0);

            // Notes
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
