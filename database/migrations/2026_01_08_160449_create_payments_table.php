<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('car_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('GHS');

            $table->string('payment_reference')->unique();
            $table->string('payment_method')->nullable();

            $table->enum('status', ['pending', 'successful', 'failed'])
                  ->default('pending');

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
