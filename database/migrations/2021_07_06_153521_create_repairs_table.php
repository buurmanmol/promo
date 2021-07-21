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
            $table->uuid('id')->primary();
            $table->BigInteger('user_id')->unsigned();
            $table->bigInteger('brands_models_id')->unsigned();
            $table->BigInteger('product_type_id')->unsigned();
            $table->text('comment')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('is_repaired')->default(false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('brands_models_id')->references('id')->on('brands_models')->onDelete('cascade');
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');

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
