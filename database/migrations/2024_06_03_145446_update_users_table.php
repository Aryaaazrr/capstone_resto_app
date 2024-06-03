<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            $table->renameColumn('username', 'email');
            $table->string('name')->after('id');
        });
    }

    public function down()
    {
        Schema::table('tbl_users', function (Blueprint $table) {
            $table->renameColumn('email', 'username');
            $table->dropColumn('name');
        });
    }
};
