<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudySessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('class_id');
            $table->string('location');
            $table->integer('owner_id');
            $table->double('latitude', 20,10);
            $table->double('longitude', 20,10);
            $table->string('details', 150);
            $table->timestamp('time_start');
            $table->timestamp('time_end')->nullable();
            $table->integer('status');
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
        Schema::drop('study_sessions');
    }
}
