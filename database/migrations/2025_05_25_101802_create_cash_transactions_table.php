<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_account_id')->nullable();
            $table->string('transaction_number')->unique();
            $table->decimal('amount', 15, 2);
            $table->enum('type', ['deposit', 'withdraw']);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('payment_account_id')->references('id')->on('payment_accounts')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_transactions');
    }
};
