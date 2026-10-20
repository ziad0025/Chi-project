<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
class DashboardController extends Controller
{
    public function index()
{
   $coursesCount = Course::count();
    $publishedCoursesCount = Course::where('is_published', 1)->count();
    $studentsCount = User::where('role', 'student')->count();
    
    // بيانات إضافية لتعبئة الصفحة وزيادة تفاصيلها
    $latestCourses = Course::latest()->take(5)->get();

    return view('dashboard', compact(
        'coursesCount', 
        'publishedCoursesCount', 
        'studentsCount', 
        'latestCourses'
    ));
}
}
