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
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users')->required();
            $table->foreign('id_users')->references('id_users')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_produk')->required();
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onUpdate('cascade')->onDelete('cascade');
            $table->float('rate')->notNull();
            $table->text('komentar')->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};