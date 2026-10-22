<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    // عرض الكورسات المتاحة ليقوم الطالب بالتسجيل فيها
    public function index()
    {
        $courses = Course::where('is_published', true)->with('lessons')->paginate(9);
        return view('students.index', compact('courses'));
    }

    // عرض الكورسات الخاصة بالطالب المسجل فيها فعلياً (My Courses)
    public function myCourses()
    {
        $student = Auth::user();
        $courses = $student->courses()->with('lessons')->paginate(9);
        return view('students.my-courses', compact('courses'));
    }

    // عملية تسجيل الطالب في كورس معين
   public function enroll($id)
{
    $course = Course::findOrFail($id);
    $student = Auth::user();

    // التأكد من عدم تكرار التسجيل مسبقاً
    if (!$student->courses->contains($course->id)) {
        $student->courses()->attach($course->id); // تم إضافة الأقواس () هنا
    }

    return redirect()->route('students.my-courses')->with('success', __('general.enroll_success') ?? 'تم التسجيل في الكورس بنجاح');
}
// إلغاء التسجيل في الكورس (حذف من كورسات الطالب)
public function unenroll($id)
{
    $course = Course::findOrFail($id);
    $student = Auth::user();

    // فك الارتباط بين الطالب والكورس
    $student->courses()->detach($course->id);

    return redirect()->route('students.my-courses')->with('success', __('general.course_removed') ?? 'تم إزالة الكورس من قائمتك بنجاح');
}
    public function show(Course $course)
    {
        // التأكد إن الطالب مشترك في الكورس ده فعلاً
        if (!auth()->user()->courses->contains($course->id)) {
            abort(403, 'أنت غير مشترك في هذا الكورس.');
        }

        // جلب الدروس مرتبة
        $lessons = $course->lessons()->orderBy('order', 'asc')->get();
        
        // تحديد الدرس النشط (اللي الطالب داس عليه، أو أول درس لو لسه بيدخل)
        $activeLessonId = request('lesson', $lessons->first()?->id);
        $activeLesson = $lessons->firstWhere('id', $activeLessonId);

        return view('students.show', compact('course', 'lessons', 'activeLesson'));
    }
}