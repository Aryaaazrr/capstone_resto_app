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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('id_kategori')->required();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_produk')->notNull();
            $table->text('deskripsi_produk')->notNull();
            $table->decimal('harga_produk')->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};