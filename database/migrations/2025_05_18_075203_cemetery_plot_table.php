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
        Schema::create('cemetery_models', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('plot_number', 50)->unique();
            $table->uuid('class_id');
            $table->decimal('area_sqm', 12, 2);
            $table->boolean('is_available')->default(true);
            $table->text('location');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
