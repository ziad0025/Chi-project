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
            $table->string('title');
            $table->text('description')->nullable();

            $table->string('video_url'); // رابط الفيديو
            $table->string('pdf_file')->nullable(); //ملزمة شرح لو في 

            // شروط لفتح الدرس
            $table->boolean('lock_until_homework_passed')->default(false); // قفل الفيديو لحين حل الواجب
            $table->boolean('lock_until_quiz_passed')->default(false);     // قفل الفيديو لحين حل الامتحان

            $table->boolean('is_free')->default(false); // الدرس مجاني ام لا    
            $table->integer('order')->default(0); // ترتيب الدرس داخل الكورس
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
