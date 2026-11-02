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
        Schema::create('liabilities', function (Blueprint $table) {
            $table->id();
            $table->string('loan_name', 255);
            $table->string('lender_name', 255);
            $table->decimal('loan_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2); 
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('paid', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);
            $table->decimal('outstanding_amount', 15, 2);
            $table->string('notes', 1000)->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liabilities');
    }
};
