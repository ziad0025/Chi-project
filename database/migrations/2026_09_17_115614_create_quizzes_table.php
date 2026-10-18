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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
            $table->string('title'); // عنوان الامتحان او الواجب 

            $table->enum('type', ['quiz', 'homework']); // نوع الاسئله : امتحان او واجب
            $table->integer('duration_minutes')->nullable(); // مدة الامتحان او الواجب
            $table->integer('passmark')->nullable(); // درجة النجاح في الامتحان او الواجب

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
