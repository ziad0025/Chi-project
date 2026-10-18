<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_image',
        'options',
        'correct_answer',
        'explanation',
    ];

    protected $casts = [
        'options' => 'array', // تحويل خيارات السؤال من JSON إلى مصفوفة
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
