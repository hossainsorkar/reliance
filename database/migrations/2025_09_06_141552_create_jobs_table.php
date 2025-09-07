<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('buyer_name')->nullable();
            $table->decimal('value_usd', 15, 2)->nullable();
            $table->decimal('usd_rate_bdt', 15, 2)->nullable();
            $table->decimal('voucher_amount', 15, 2)->nullable();
            $table->unsignedBigInteger('party_id');
            $table->unsignedBigInteger('terminal_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('items')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->integer('ctns_pieces')->nullable();
            $table->string('be_no')->nullable();
            $table->string('lc_no')->nullable();
            $table->string('sales_contact')->nullable();
            $table->string('ud_no')->nullable();
            $table->string('ud_amendment_no')->nullable();
            $table->string('master_awb_bl_no')->nullable();
            $table->string('house_awb_no')->nullable();
            $table->string('job_no');
            $table->string('job_type')->nullable();
            $table->string('job_status')->nullable();
            $table->timestamps();

            // Foreign keys (assuming related tables exist)
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('cascade');
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
