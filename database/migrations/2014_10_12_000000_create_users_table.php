<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('hometown')->nullable();
            $table->string('avatar')->nullable();
            $table->tinyInteger('age')->nullable();
            $table->string('slug', 20)->unique();
            $table->text('preferences')->nullable();
            $table->boolean('enabled')->default(true);
            $table->boolean('banned')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('role_user',function(Blueprint $table){
            $table->increments('id');
            $table->integer('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permission_role',function(Blueprint $table){
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('permission_id')->references('id')->on('permissions');
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
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
        Schema::drop('users');
    }
}
