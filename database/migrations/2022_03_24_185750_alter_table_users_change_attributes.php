<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name', 'remember_token']);
            $table->string('firstname')->after('id');
            $table->string('lastname')->after('firstname');
            $table->date('birthdate')->after('lastname');
            $table->integer('points')->after('birthdate');
            $table->string('api_token')->after('password');
            $table->timestamp('last_login_at')->nullable()->after('updated_at');
            $table->string('email_verify_token')->after('email_verified_at');
            $table->boolean('cgu_accepted')->default(false)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
