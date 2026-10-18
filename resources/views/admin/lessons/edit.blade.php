@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header & Navigation -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-1">
                <a href="{{ route('courses.index') }}" class="hover:text-slate-800 transition">{{ $course->title }}</a>
                <span>/</span>
                <a href="{{ route('lessons.index', $course->id) }}" class="hover:text-slate-800 transition">{{ __('general.course_lessons') }}</a>
            </div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.edit_lesson') }}</h1>
        </div>
        <div>
            <a href="{{ route('lessons.index', $course->id) }}" 
               class="px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition flex items-center gap-2">
                <span>←</span>
                <span>{{ __('general.back_to_lessons') }}</span>
            </a>
        </div>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 p-6">
        <form action="{{ route('lessons.update', [$course->id, $lesson->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Lesson Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-1">
                    {{ __('general.lesson_title') }} <span class="text-rose-500">*</span>
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" required
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:outline-none focus:border-slate-400 transition">
                @error('title')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lesson Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-slate-700 mb-1">
                    {{ __('general.order') }}
                </label>
                <input type="number" name="order" id="order" value="{{ old('order', $lesson->order) }}" min="1"
                       class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:outline-none focus:border-slate-400 transition">
                @error('order')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Video Section -->
            <div class="pt-4 border-t border-slate-100 space-y-4">
                <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ __('general.video_content') }}
                </h2>

                <!-- YouTube / External URL -->
                <div>
                    <label for="video_url" class="block text-xs font-medium text-slate-600 mb-1">
                        {{ __('general.video_url') }}
                    </label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $lesson->video_url) }}" placeholder="https://www.youtube.com/watch?v=..."
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:outline-none focus:border-slate-400 transition">
                    @error('video_url')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video File Upload -->
                <div>
                    <label for="video_file" class="block text-xs font-medium text-slate-600 mb-1">
                        {{ __('general.upload_video_file') }}
                    </label>
                    <input type="file" name="video_file" id="video_file" accept="video/*"
                           class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer border border-slate-200 rounded-xl bg-slate-50">
                    
                    @if($lesson->video_path)
                        <div class="mt-2 flex items-center gap-2 text-xs text-slate-500">
                            <span class="font-medium text-slate-700">{{ __('general.current_file') }}:</span>
                            <span class="truncate max-w-xs">{{ basename($lesson->video_path) }}</span>
                        </div>
                    @endif
                    @error('video_file')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- PDF Attachment Section -->
            <div class="pt-4 border-t border-slate-100 space-y-4">
                <h2 class="text-sm font-bold text-slate-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    {{ __('general.pdf_attachment') }}
                </h2>

                <div>
                    <label for="pdf_file" class="block text-xs font-medium text-slate-600 mb-1">
                        {{ __('general.upload_pdf') }}
                    </label>
                    <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf"
                           class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer border border-slate-200 rounded-xl bg-slate-50">
                    
                    @if($lesson->pdf_file)
                        <div class="mt-2 flex items-center gap-2 text-xs text-slate-500">
                            <span class="font-medium text-slate-700">{{ __('general.current_file') }}:</span>
                            <span class="truncate max-w-xs">{{ basename($lesson->pdf_file) }}</span>
                        </div>
                    @endif
                    @error('pdf_file')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Is Free Toggle Checkbox -->
            <div class="pt-4 border-t border-slate-100">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_free" value="1" {{ old('is_free', $lesson->is_free) ? 'checked' : '' }}
                           class="w-4 h-4 text-slate-800 rounded border-slate-300 focus:ring-slate-400">
                    <span class="text-sm font-medium text-slate-700">{{ __('general.is_free_preview') }}</span>
                </label>
            </div>

            <!-- Actions Footer -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('lessons.index', $course->id) }}" 
                   class="px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition">
                    {{ __('general.cancel') }}
                </a>
                <button type="submit" 
                        class="px-5 py-2.5 bg-slate-800 text-white text-sm font-medium rounded-xl hover:bg-slate-900 transition shadow-xs">
                    {{ __('general.save_changes') }}
                </button>
            </div>

        </form>
    </div>

</div>
@endsection