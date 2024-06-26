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
        Schema::create('tbl_subcategories', function (Blueprint $table) {
            $table->id('id_subcategory');
            $table->unsignedBigInteger('id_category')->required();
            $table->foreign('id_category')->references('id_category')->on('tbl_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_subcategories');
    }
};
