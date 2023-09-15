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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_th');
            $table->string('name_en');
            $table->decimal('price',10,2);

            $table->tinyInteger('products_categories_id');
            $table->foreign('products_categories_id')->references('id')->on('products_categories');

            $table->boolean('active');


            $table->timestamps();

            $table->index(['name_th', 'name_en', 'products_categories_id', 'created_at']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
