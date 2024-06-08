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
        Schema::create('tbl_transaction_details', function (Blueprint $table) {
            $table->id('id_transaction_detail');
            $table->unsignedBigInteger('id_transaction')->required();
            $table->foreign('id_transaction')->references('id_transaction')->on('tbl_transactions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_product')->required();
            $table->foreign('id_product')->references('id_product')->on('tbl_products')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity')->notNull();
            $table->decimal('price')->notNull();
            $table->decimal('total')->notNull();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transaction_details');
    }
};
