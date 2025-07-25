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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained()->OnDelete('set null');
            $table->integer('order')->default(0);
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('path_video')->nullable();
            $table->string('views')->default(0);
            $table->string('hours')->default(0);
            $table->string('minutes')->default(0);
            $table->string('second')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
