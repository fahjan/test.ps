<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->uuid('creator_id')->index();
            $table->uuid('updator_id')->nullable()->index();
            $table->uuid('user_id')->index();
            $table->integer('school_id')->index();
            $table->integer('job_id')->index();
            $table->string('photo')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainers');
    }
}
