<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('identification');
            $table->string('formal_name');
            $table->integer('service_type_id');
            $table->enum('status', ['available', 'transit', 'unavailable','denied']);
            $table->string('logo');
            $table->integer('leaving_in')->nullable();
            $table->boolean('enabled')->default(true);
            $table->boolean('delivery_bike');
            $table->boolean('delivery_motorcycle');
            $table->boolean('lets_negotiate');
            $table->string('slug')->unique();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('service_types',function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
        }); 
        Schema::create('truck_user',function(Blueprint $table){
            $table->increments('id');
            $table->integer('truck_id')->unsigned()->index();
            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('truck_user', function ($table) {
            $table->dropForeign(['truck_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::drop('service_types');
        Schema::drop('truck_user');
        Schema::drop('trucks');
        Schema::enableForeignKeyConstraints();
    }
}
