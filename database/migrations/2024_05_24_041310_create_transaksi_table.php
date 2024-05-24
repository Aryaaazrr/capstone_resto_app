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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_users')->required();
            $table->foreign('id_users')->references('id_users')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_resi_transaksi')->notNull();
            $table->decimal('grand_total')->notNull();
            $table->enum('status_transasksi', ['Pending', 'Proses', 'Sedang Dikirim', 'Pesanan Selesai', 'Batal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};