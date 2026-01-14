<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('car_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();

            $table->decimal('offer_price', 12, 2)->nullable();
            $table->text('message')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
