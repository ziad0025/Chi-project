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
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // الطالب
            $table->foreignId('quiz_id')->constrained()->cascadeOnDelete(); // الكويز أو الواجب
            
            $table->integer('score');             // الدرجة التي حصل عليها الطالب
            $table->integer('total_marks');       // الدرجة الكلية للامتحان
            $table->boolean('is_passed');         // هل اجتاز درجة النجاح المطلوب؟
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
