<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class City extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function ($table) {
            $table->increments('id');
            // $table->primary('id');
            $table->string('title');
        });

        Schema::create('cities', function ($table) {
            $table->increments('id');
            // $table->primary('id');

            $table->integer('country_id');
            $table->string('title');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
