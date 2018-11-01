<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('street')->nullable();
            $table->string('parish')->nullable();          
            $table->string('mobile')->nullable();          
            $table->string('landline')->nullable();          
            $table->string('farm_name')->nullable();            
            $table->string('farm_address_steet')->nullable();            
            $table->string('farm_address_parish')->nullable();            
            $table->string('flock_capacity')->nullable();            
            $table->string('principal_occupation')->nullable();           
            $table->longText('qualifications')->nullable();
            $table->longText('training')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('profiles');
    }
}
