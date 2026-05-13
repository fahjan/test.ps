<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('school_id')->constrained();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['bank of palestine', 'palyap', 'jawwal pay', 'cash'])->comment('e.g., bank_transfer, cash, paylay, jawwalpay');
            $table->string('transaction_id')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
