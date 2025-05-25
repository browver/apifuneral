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
        Schema::create('maintenance_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plot_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamp('order_date')->useCurrent();
            $table->string('status', 20)->default('REQUESTED');

            //relations
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plot_id')->references('id')->on('plot_models');
            $table->foreign('service_id')->references('id')->on('service_models');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_orders');
    }
};
