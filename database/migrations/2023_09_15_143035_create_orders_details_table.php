<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('orders_id');
            $table->foreign('orders_id')->references('id')->on('orders');

            $table->tinyInteger('products_id');
            $table->foreign('products_id')->references('id')->on('products');

            $table->string('products_name_th');
            $table->string('products_name_en');

            $table->decimal('price', 10, 2);

            $table->timestamps();

            $table->index(['orders_id','products_id','products_name_th','products_name_en', 'created_at']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_details');
    }
};
