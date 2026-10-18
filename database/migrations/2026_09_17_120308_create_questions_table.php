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
            $table->id();
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete();
            $table->text('question_text')->nullable(); // نص السؤال
            $table->string('question_image')->nullable(); // صورة السؤال (اختياري)
            $table->json('options'); // خيارات السؤال (كمصفوفة JSON)
            $table->string('correct_answer'); // الإجابة الصحيحة
            $table->text('explanation')->nullable(); // شرح الإجابة الصحيحة (اختياري)

            $table->timestamps();
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
