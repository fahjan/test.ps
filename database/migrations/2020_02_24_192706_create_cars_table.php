<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('vehicletypes', function (Blueprint $table) {
            $table->increments('id');
            // $table->timestamps();
            $table->string('title');
        });

        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('creator_id')->index();
            $table->uuid('updator_id')->nullable()->index();
            $table->integer('school_id')->nullable()->index('school_id');
            $table->string('title');
            $table->string('car_number')->nullable();
            $table->date('renewal_at');
            $table->date('insurance_at');
            // $table->date('purchase_at')->nullable();
            // $table->integer('license_id')->index('license_id');
            $table->year('model_year')->nullable();
            $table->text('notes')->nullable();
            $table->integer('trainer_id')->index('trainer_id')->nullable();
            $table->integer('vehicletype_id')->nullable()->index('vehicletype_id');
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
        Schema::dropIfExists('vehicletypes');
        Schema::dropIfExists('cars');
    }
}
