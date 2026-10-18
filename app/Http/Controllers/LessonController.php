<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    // عرض دروس كورس معين
    public function index(Course $course)
    {
        $lessons = $course->lessons()->orderBy('order', 'asc')->get();
        return view('admin.lessons.index', compact('course', 'lessons'));
    }

    // صفحة إضافة درس جديد لكورس معين
    public function create(Course $course)
    {
        return view('admin.lessons.create', compact('course'));
    }

    // حفظ الدرس الجديد
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt',
            'pdf_file' => 'nullable|file|mimes:pdf', // 10MB max
            'is_free' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $lesson = new Lesson();
        $lesson->course_id = $course->id;
        $lesson->title = $request->input('title');
        $lesson->video_url = $request->input('video_url');
        $lesson->is_free = $request->has('is_free');
        $lesson->order = $request->input('order', $course->lessons()->count() + 1);

        // رفع ملف الفيديو لو تم اختياره كملف
        if ($request->hasFile('video_file')) {
            $lesson->video_path = $request->file('video_file')->store('lessons/videos', 'public');
        }

        // رفع ملف الـ PDF
        if ($request->hasFile('pdf_file')) {
            $lesson->pdf_file = $request->file('pdf_file')->store('lessons/pdfs', 'public');
        }

        $lesson->save();

        return redirect()->route('lessons.index', $course->id);
    }

    public function show(Course $course, Lesson $lesson) 
    {
        return view('admin.lessons.show', compact('course', 'lesson'));
    }

    public function edit(Course $course , Lesson $lesson) 
    {
        return view('admin.lessons.edit', compact('course','lesson'));

    }
    public function update(Request $request, Course $course , Lesson $lesson)
    {
          $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,qt', // 100MB max
            'pdf_file' => 'nullable|file|mimes:pdf', // 10MB max
            'is_free' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $lesson->title = $request->title;
        $lesson->video_url = $request->video_url;
        $lesson->is_free = $request->has('is_free');
        $lesson->order = $request->order ?? $lesson->order;

        if ($request->hasFile('video_file')) {
            if ($lesson->video_path && Storage::disk('public')->exists($lesson->video_path)) {
                Storage::disk('public')->delete($lesson->video_path);
            }
            $lesson->video_path = $request->file('video_file')->store('lessons/videos', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($lesson->pdf_file && Storage::disk('public')->exists($lesson->pdf_file)) {
                Storage::disk('public')->delete($lesson->pdf_file);
            }
            $lesson->pdf_file = $request->file('pdf_file')->store('lessons/pdfs', 'public');
        }


        $lesson->save();

        return redirect()->route('lessons.index', compact('course', 'lesson'));

    }
    public function destroy(Course $course, Lesson $lesson)
    {
        if ($lesson->video_path && Storage::disk('public')->exists($lesson->video_path)) {
            Storage::disk('public')->delete($lesson->video_path);
        }

        if ($lesson->pdf_file && Storage::disk('public')->exists($lesson->pdf_file)) {
            Storage::disk('public')->delete($lesson->pdf_file);
        }

        $lesson->delete();

        return redirect()->route('lessons.index', compact('course', 'lesson'));
    }
    
    
}