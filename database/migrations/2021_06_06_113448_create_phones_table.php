<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('product_id')->nullable();
            $table->string('sku')->nullable();
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->text('images')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('extra_model')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_group')->nullable();
            $table->string('color')->nullable();
            $table->string('extra_field')->nullable();
            $table->string('quality_label')->nullable();
            $table->string('price')->nullable();
            $table->string('qty')->nullable();
            $table->string('wc_product_parent')->nullable();
            $table->string('wc_product_type')->nullable();
            $table->string('status')->nullable();
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
