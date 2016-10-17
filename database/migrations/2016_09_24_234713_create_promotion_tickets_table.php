<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('promotion_id')->unsigned();
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
            $table->string('qr_code');
            $table->string('nfc_code');
            $table->string('hash_code');
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
        Schema::disableForeignKeyConstraints();
        Schema::table('promotion_tickets', function ($table) {
            $table->dropForeign(['promotion_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::drop('promotion_tickets');
        Schema::enableForeignKeyConstraints();
    }
}
