<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('school_id')->constrained();
            $table->foreignUuid('user_id')->constrained();


            $table->string('title');
            $table->text('content')->nullable();
            $table->string('video_url')->nullable();

            $table->integer('sort_order')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
