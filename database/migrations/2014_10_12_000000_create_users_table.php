<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('role')->default('user');
            $table->string('postal_code');
            $table->string('city');
            $table->string('province');
            $table->string('email')->unique();
            $table->BigInteger('company_id')->unsigned();
            $table->BigInteger('manager_id')->unsigned()->nullable();
            $table->string('phone_number')->unique();
            $table->string('IBAN')->unique()->nullable();
            $table->string('rek_houder')->nullable();


            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable()->default('/images/default.png');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
