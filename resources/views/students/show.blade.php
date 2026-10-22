@extends('layouts.student.student')

@section('content')
<div class="space-y-6">

    <!-- Breadcrumbs & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-100 shadow-xs">
        <div>
            <!-- Breadcrumb -->
            <nav class="flex text-xs text-slate-400 mb-2 font-medium" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li><a href="{{ route('students.index') }}" class="hover:text-indigo-600">Home</a></li>
                    <li><svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li><a href="{{ route('students.my-courses') ?? '#' }}" class="hover:text-indigo-600">My Courses</a></li>
                    <li><svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li class="text-slate-800 font-semibold">{{ $course->title }}</li>
                </ol>
            </nav>
            <h1 class="text-2xl font-bold text-slate-800">{{ $activeLesson->title ?? 'Course Lesson' }}</h1>
        </div>
        
        <!-- Download PDF Button (Above Video) -->
        @if($activeLesson && $activeLesson->pdf_file)
            <a href="{{ asset('storage/' . $activeLesson->pdf_file) }}" target="_blank" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold rounded-xl transition shadow-xs">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download PDF
            </a>
        @endif
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Video Player Area (Takes 2 columns) -->
        <div class="lg:col-span-2">
            <!-- Video Player -->
            <div class="bg-white p-2 rounded-3xl border border-slate-100 shadow-sm sticky top-6">
                <div class="aspect-video bg-slate-900 rounded-2xl overflow-hidden relative">
                    @if($activeLesson->video_url)
                        <iframe src="{{ $activeLesson->video_url }}" class="w-full h-full absolute inset-0" frameborder="0" allowfullscreen></iframe>
                    @elseif($activeLesson->video_path)
                        <video controls class="w-full h-full absolute inset-0">
                            <source src="{{ asset('storage/' . $activeLesson->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <div class="flex flex-col items-center justify-center h-full text-slate-400">
                            <svg class="w-16 h-16 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span class="text-sm font-medium">No video available for this lesson</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Course Content Sidebar (Takes 1 column) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xs overflow-hidden sticky top-6">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="font-bold text-slate-800 text-base">Course Content</h2>
                    <p class="text-xs text-slate-500 mt-1">{{ $lessons->count() }} Lessons</p>
                </div>
                
                <div class="max-h-[600px] overflow-y-auto">
                    @foreach($lessons as $lesson)
                        <a href="{{ route('students.show', ['course' => $course->id, 'lesson' => $lesson->id]) }}" 
                           class="block p-4 border-b border-slate-50 transition {{ $activeLesson && $activeLesson->id == $lesson->id ? 'bg-indigo-50/40 border-l-4 border-l-indigo-600' : 'hover:bg-slate-50 border-l-4 border-l-transparent' }}">
                            <div class="flex items-center gap-3">
                                <!-- Icon (Play for video, Document for PDF) -->
                                <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center {{ $activeLesson && $activeLesson->id == $lesson->id ? 'bg-indigo-100 text-indigo-600' : 'bg-slate-100 text-slate-400' }}">
                                    @if($lesson->video_url || $lesson->video_path)
                                        <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    @endif
                                </div>
                                
                                <!-- Text -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold truncate {{ $activeLesson && $activeLesson->id == $lesson->id ? 'text-indigo-700' : 'text-slate-700' }}">
                                        Lesson {{ $lesson->order }}: {{ $lesson->title }}
                                    </h3>
                                    <div class="flex items-center gap-2 mt-1 text-[11px] text-slate-500">
                                        <span>Video</span>
                                        @if($lesson->pdf_file)
                                            <span>• PDF</span>
                                        @endif
                                        @if($lesson->is_free)
                                            <span class="text-emerald-600 font-bold">• Free</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection