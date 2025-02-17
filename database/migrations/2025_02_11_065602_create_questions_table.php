<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('modul_id');
            $table->unsignedBigInteger('topik_id');
            $table->text('question');
            $table->string('answer')->nullable();
            $table->integer('timer')->nullable();
            $table->text('inline_answers')->nullable();
            $table->string('audio')->nullable();
            $table->boolean('audio_play')->default(false);
            $table->boolean('auto_next')->default(false);
            $table->enum('type', [1, 2, 3]);
            $table->enum('difficulty', [1, 2, 3, 4, 5]);            
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('modul_id')->references('id')->on('moduls');
            $table->foreign('topik_id')->references('id')->on('topiks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
