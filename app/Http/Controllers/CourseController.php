<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('lessons')->latest()->paginate(12);
        return view('admin.courses.index', compact('courses'));
    }
    public function create()
    {
        return view('admin.courses.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'nullable|numeric|min:0',
            'is_published' => 'nullable|boolean',
        ]);

        $course = new Course();
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->grade = $request->input('grade');
        $course->price = $request->input('price', 0);
        $course->is_published = $request->has('is_published');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
            $course->image = $imagePath;
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', __('general.create_course') . ' ' . __('general.successfully'));
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.courses.edit', compact('course'));
    }
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'price' => 'nullable|numeric|min:0',
            'is_published' => 'nullable|boolean',
        ]);

        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->grade = $request->input('grade');
        $course->price = $request->input('price', 0);
        $course->is_published = $request->has('is_published');

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $imagePath = $request->file('image')->store('courses', 'public');
            $course->image = $imagePath;
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', __('general.edit_course') . ' ' . __('general.successfully'));
    }
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Delete the course image if it exists
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', __('general.delete_course') . ' ' . __('general.successfully'));
    }
}
