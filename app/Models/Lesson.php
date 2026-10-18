<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'video_url',
        'video_path',
        'pdf_file',
        'lock_until_homework_passed',
        'lock_until_quiz_passed',
        'is_free',
        'order',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
