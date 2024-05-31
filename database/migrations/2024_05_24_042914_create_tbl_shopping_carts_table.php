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
        Schema::create('tbl_shopping_carts', function (Blueprint $table) {
            $table->id('id_shopping_cart');
            $table->unsignedBigInteger('id_user')->required();
            $table->foreign('id_user')->references('id_user')->on('tbl_users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_product')->required();
            $table->foreign('id_product')->references('id_product')->on('tbl_products')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity')->notNull();
            $table->decimal('subtotal')->notNull();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_shopping_carts');
    }
};