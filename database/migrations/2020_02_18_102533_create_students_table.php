<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->timestamps();
            $table->uuid('creator_id')->index();
            $table->uuid('updator_id')->nullable()->index();
            $table->uuid('user_id')->index();
            $table->integer('school_id')->index();
            $table->string('first_name');
            $table->string('father_name');
            $table->string('gfather_name');
            $table->string('family_name');
            $table->string('id_number');
            $table->integer('city_id')->index();
            $table->integer('license_id')->index();
            $table->date('dateofbirth');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->enum('glasses', ['yes', 'no'])->default('no');
            $table->enum('exam_type', ['written', 'oral', 'minioral'])->default('written');
            $table->string('address')->nullable();
            $table->float('agreed_amount')->default(0.0);
            $table->string('prev_license')->nullable();

            $table->string('prev_place')->nullable();
            $table->string('prev_number')->nullable();
            $table->date('prev_end_date')->nullable();
            $table->string('license_number')->nullable();
            $table->date('license_end_at')->nullable();
            $table->string('training_number')->nullable();
            $table->date('training_end_at')->nullable();
            $table->bigInteger('trainer_id')->index()->nullable();
            $table->bigInteger('drivingtrainer_id')->index()->nullable();
            $table->string('archive_number')->nullable();

            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
