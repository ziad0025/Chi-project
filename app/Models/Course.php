<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'grade',
        'is_published',
    ];
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order', 'asc'    );
    }
}
