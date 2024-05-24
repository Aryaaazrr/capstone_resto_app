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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->unsignedBigInteger('id_users')->required();
            $table->foreign('id_users')->references('id_users')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_produk')->required();
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onUpdate('cascade')->onDelete('cascade');
            $table->float('kuantitas')->notNull();
            $table->decimal('subtotal')->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
