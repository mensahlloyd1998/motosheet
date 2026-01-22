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
            $table->dropUnique('cars_slug_unique');
            $table->unique(['user_id', 'slug']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            // Drop the composite unique index
            $table->dropUnique(['user_id', 'slug']);
    
            // Restore the original unique index on slug
            $table->unique('slug');
        });
    }
};
