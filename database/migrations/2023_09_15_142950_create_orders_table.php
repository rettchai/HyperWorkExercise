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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->tinyInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->text('shipping_address');
            $table->text('receipt_address');
            $table->decimal('summary_price', 10, 2);

            $table->timestamps();

            // $table->index(['user_id', 'created_at']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
