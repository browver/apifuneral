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
        Schema::create('plot_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plot_id');
            $table->timestamp('purchase_date')->useCurrent();
            $table->decimal('total_price', 12, 2);
            $table->string('payment_status', 20)->default('REQUESTED');

            //relations
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plot_id')->references('id')->on('cemetery_models');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_purchases');
    }
};