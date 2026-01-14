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
        Schema::table('cars', function (Blueprint $table) {
            //
            $table->string('make')->after('slug')->nullable();
            $table->string('model')->after('make')->nullable();
            $table->string('trim')->after('model')->nullable();
            $table->string('exterior_color')->after('trim')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            //
            $table->dropColumn(['make', 'model', 'trim', 'exterior_color']);
        });
    }
};
