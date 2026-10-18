@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.add_new_lesson') }}</h1>
            <p class="text-slate-500 text-sm mt-1">{{ __('general.add_lesson_desc') }}: <span class="font-semibold text-slate-700">{{ $course->title }}</span></p>
        </div>
        <a href="{{ route('lessons.index', $course->id) }}" 
           class="px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition">
            ← {{ __('general.back_to_lessons') }}
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xs border border-slate-100 p-6 md:p-8">
        <form action="{{ route('lessons.store',$course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Lesson Title & Order -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="md:col-span-3">
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('general.lesson_title') }} <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:border-slate-400 focus:outline-none transition @error('title') border-rose-500 @enderror"
                           placeholder="{{ __('general.enter_lesson_title') }}">
                    @error('title')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('general.lesson_order') }}</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $nextOrder ?? 1) }}" min="1"
                           class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:border-slate-400 focus:outline-none transition @error('order') border-rose-500 @enderror">
                    @error('order')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Video Section (URL or File) -->
            <div class="border-t border-slate-100 pt-6 space-y-4">
                <h3 class="text-sm font-bold text-slate-800 mb-4">{{ __('general.video_source') }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Video URL -->
                    <div>
                        <label for="video_url" class="block text-sm font-medium text-slate-700 mb-2">{{ __('general.external_video_url') }}</label>
                        <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}"
                               class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:bg-white focus:border-slate-400 focus:outline-none transition @error('video_url') border-rose-500 @enderror"
                               placeholder="https://youtube.com/... {{ __('general.or') }} Vimeo">
                        <p class="text-xs text-slate-400 mt-1">{{ __('general.video_url_hint') }}</p>
                        @error('video_url')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload Video File -->
                    <div>
                        <label for="video_file" class="block text-sm font-medium text-slate-700 mb-2">{{ __('general.upload_video_file') }}</label>
                        <input type="file" name="video_file" id="video_file" accept="video/*"
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 transition">
                        @error('video_file')
                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- PDF Attachment Section -->
            <div class="border-t border-slate-100 pt-6">
                <label for="pdf_file" class="block text-sm font-semibold text-slate-700 mb-2">{{ __('general.pdf_attachment') }}</label>
                <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                       class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 transition">
                @error('pdf_file')
                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Free Toggle / Checkbox -->
            <div class="border-t border-slate-100 pt-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_free" value="1" {{ old('is_free') ? 'checked' : '' }}
                           class="w-4 h-4 text-slate-800 border-slate-300 rounded focus:ring-slate-500">
                    <span class="text-sm font-medium text-slate-700">{{ __('general.allow_free_preview') }}</span>
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="border-t border-slate-100 pt-6 flex items-center justify-end gap-3">
                <a href="{{ route('lessons.index', $course->id) }}" 
                   class="px-5 py-2.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-200 transition">
                    {{ __('general.cancel') }}
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-slate-800 text-white text-sm font-medium rounded-xl hover:bg-slate-900 transition shadow-xs">
                    {{ __('general.save_lesson') }}
                </button>
            </div>
        </form>
    </div>

</div>
@endsection