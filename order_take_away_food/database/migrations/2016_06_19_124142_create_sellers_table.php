<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->string('id');
            $table->string('seller_name');
            $table->string('seller_email');
            $table->string('seller_tel');
            $table->text('seller_add');
            $table->integer('seller_sp');
            $table->string('seller_activity');
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
        Schema::drop('sellers');
    }
}
