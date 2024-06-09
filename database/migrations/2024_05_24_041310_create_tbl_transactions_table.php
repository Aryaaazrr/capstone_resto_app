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
        Schema::create('tbl_transactions', function (Blueprint $table) {
            $table->id('id_transaction');
            $table->unsignedBigInteger('id_user')->required();
            $table->foreign('id_user')->references('id_user')->on('tbl_users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_receipt')->notNull();
            $table->decimal('grand_total')->notNull();
            $table->string('no_telp')->notNull();
            $table->date('reservation_date')->notNull();
            $table->time('reservation_time')->notNull();
            $table->integer('reservation_people')->notNull();
            $table->text('reservation_message')->default('-');
            $table->enum('status_transaction', ['Pending', 'Process', 'Completed', 'Cancel'])->default('Pending');
            $table->enum('status_payment', ['Pending', 'Paid', 'Failed', 'Canceled'])->default('Pending');
            $table->string('token_payment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transactions');
    }
};
