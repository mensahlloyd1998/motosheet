<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->decimal('price', 12, 2)->nullable();
            $table->enum('price_type', ['fixed', 'negotiable'])->default('fixed');

            $table->year('year')->nullable();
            $table->integer('mileage')->nullable();

            $table->enum('transmission', ['manual', 'automatic'])->nullable();
            $table->enum('fuel_type', ['petrol', 'diesel', 'hybrid', 'electric'])->nullable();
            $table->enum('condition', ['new', 'used', 'foreign_used'])->nullable();

            $table->text('description')->nullable();

            $table->enum('status', ['draft', 'active', 'expired', 'sold'])
                  ->default('draft');

            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
