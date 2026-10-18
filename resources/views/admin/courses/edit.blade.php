@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800"> {{ __('general.course_edit_title') }} : {{ $course->title }}</h1>
            <p class="text-slate-500 text-sm mt-1">{{ __('general.course_edit_description') }}</p>
        </div>
        <a href="{{ route('courses.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-slate-300 border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-200 transition shadow-xs">
            {{ __('general.back_to_courses') }}
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xs border border-slate-100 p-6 sm:p-8">
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Title Input -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('general.title') }} <span class="text-rose-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-slate-800 focus:ring-0 text-sm transition placeholder:text-slate-400 @error('title') border-rose-500 @enderror">
                @error('title')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grade & Price Inputs (Two Columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="grade" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('general.grade') }}</label>
                    <input type="text" name="grade" id="grade" value="{{ old('grade', $course->grade) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-slate-800 focus:ring-0 text-sm transition placeholder:text-slate-400">
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('general.price') }}</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $course->price) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-slate-800 focus:ring-0 text-sm transition placeholder:text-slate-400">
                </div>
            </div>

            <!-- Description Textarea -->
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('general.description') }}</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-slate-800 focus:ring-0 text-sm transition placeholder:text-slate-400">{{ old('description', $course->description) }}</textarea>
            </div>

            <!-- Course Image Section -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">{{ __('general.course_image') }}</label>

                <!-- معاينة الصورة الحالية إن وجدت -->
                @if($course->image)
                    <div class="mb-3 flex items-center gap-4 p-3 bg-slate-50 border border-slate-100 rounded-xl">
                        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-16 h-16 object-cover rounded-lg">
                        <div>
                            <p class="text-xs font-semibold text-slate-700">{{ __('general.current_image') }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ __('general.new_image_replaces_current') }}</p>
                        </div>
                    </div>
                @endif

                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 transition">
                @error('image')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Published Checkbox -->
            <div class="flex items-center gap-3 pt-2">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $course->is_published) ? 'checked' : '' }}
                       class="w-4 h-4 text-slate-800 rounded-md border-slate-300 focus:ring-0">
                <label for="is_published" class="text-sm font-medium text-slate-700">{{ __('general.publish_course') }}</label>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <a href="{{ route('courses.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-200 transition">
                    {{ __('general.cancel') }}
                </a>
                <button type="submit" class="px-6 py-2.5 bg-slate-800 text-white text-sm font-medium rounded-xl hover:bg-slate-900 transition shadow-xs">
                    {{ __('general.save_changes') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection