<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('device_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->BigInteger('product_type_id')->unsigned();
            $table->BigInteger('invoice_id')->unsigned()->nullable();
            $table->BigInteger('manager_id')->unsigned()->nullable();
            $table->BigInteger('company_id')->unsigned()->nullable();
            $table->date('repair_date')->nullable();

            $table->text('comment')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('is_repaired')->default(false);


            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
