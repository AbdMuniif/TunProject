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
        Schema::create('speeches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->date('speech_date')->nullable();
            $table->string('location')->nullable();
            $table->string('video_url')->nullable();
            $table->string('audio_file')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }
};
