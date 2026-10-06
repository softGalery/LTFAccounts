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
        Schema::create('accounts_payables', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50); 
            $table->string('invoice_number', 255);
            $table->string('bill_date', 255);
            $table->string('due_date', 255);
            $table->string('description', 500);
            $table->string('total_amount', 255);
            $table->string('paid_amount', 255);
            $table->string('balance_amount', 255);
            $table->string('status', 255);
            $table->string('note', 255);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts_payables');
    }
};
