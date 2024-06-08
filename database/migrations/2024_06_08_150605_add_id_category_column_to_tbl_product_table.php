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
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->unsignedBigInteger('id_subcategory');
            $table->foreign('id_subcategory')->references('id_subcategory')->on('tbl_subcategories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_products', function (Blueprint $table) {
            $table->dropForeign('users_id_subcategory_foreign');
            $table->dropColumn('id_subcategory');
        });
    }
};
