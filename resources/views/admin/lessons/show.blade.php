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
            <h1 class="text-2xl font-bold text-slate-800">{{ $lesson->title }}</h1>
        </div>
        <div class="flex items-center gap-3">
            <!-- Secondary Button: Back -->
            <a href="{{ route('lessons.index', $course->id) }}" 
               class="px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition flex items-center gap-2">
                <span>←</span>
                <span>{{ __('general.back_to_lessons') }}</span>
            </a>
            <!-- Primary Action Button: Edit -->
            <a href="{{ route('lessons.edit', [$course->id, $lesson->id]) }}" 
               class="px-4 py-2 bg-slate-800 text-white text-sm font-medium rounded-xl hover:bg-slate-900 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>{{ __('general.edit') }}</span>
            </a>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-2xl shadow-xs border border-slate-200/80 p-6 space-y-6">

        <!-- Lesson Meta Info Badges -->
        <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
            <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-lg text-xs font-semibold">
                {{ __('general.order') }}: #{{ $lesson->order }}
            </span>

            @if($lesson->is_free)
                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200/60 rounded-lg text-xs font-semibold">
                    {{ __('general.free_preview') }}
                </span>
            @else
                <span class="px-3 py-1 bg-slate-50 text-slate-600 border border-slate-200/60 rounded-lg text-xs font-semibold">
                    {{ __('general.paid') }}
                </span>
            @endif
        </div>

        <!-- Video Section -->
        <div>
            <h2 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ __('general.video_content') }}
            </h2>

            @if($lesson->video_path)
                <!-- Local Video Player -->
                <div class="rounded-xl overflow-hidden bg-black aspect-video border border-slate-200">
                    <video controls class="w-full h-full">
                        <source src="{{ asset('storage/' . $lesson->video_path) }}" type="video/mp4">
                        {{ __('general.browser_not_support_video') }}
                    </video>
                </div>
            @elseif($lesson->video_url)
                @php
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $lesson->video_url, $matches);
                    $youtubeId = $matches[1] ?? null;
                @endphp

                @if($youtubeId)
                    <!-- YouTube Embedded Video -->
                    <div class="rounded-xl overflow-hidden aspect-video border border-slate-200">
                        <iframe class="w-full h-full" 
                                src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <!-- External Link Fallback -->
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-200/80 flex items-center justify-between">
                        <span class="text-sm text-slate-600 truncate max-w-md">{{ $lesson->video_url }}</span>
                        <a href="{{ $lesson->video_url }}" target="_blank" 
                           class="px-3.5 py-2 bg-slate-800 text-white text-xs font-medium rounded-lg hover:bg-slate-900 transition flex items-center gap-1.5">
                            <span>{{ __('general.open_link') }}</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                @endif
            @else
                <div class="p-8 text-center bg-slate-50 rounded-xl text-slate-400 text-sm border border-dashed border-slate-200">
                    {{ __('general.no_video_attached') }}
                </div>
            @endif
        </div>

        <!-- PDF Section -->
        <div class="pt-4 border-t border-slate-100">
            <h2 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                {{ __('general.pdf_attachment') }}
            </h2>

            @if($lesson->pdf_file)
                <div class="space-y-4">
                    <!-- Download Card Header -->
                    <div class="flex items-center justify-between p-4 bg-slate-50 border border-slate-200/80 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-red-50 border border-red-100 text-red-600 flex items-center justify-center font-bold text-xs">
                                PDF
                            </div>
                            <span class="text-sm font-medium text-slate-700">{{ __('general.pdf_file') }}</span>
                        </div>
                        <a href="{{ asset('storage/' . $lesson->pdf_file) }}" target="_blank" download
                           class="px-4 py-2 bg-slate-800 text-white text-xs font-medium rounded-lg hover:bg-slate-900 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span>{{ __('general.download_pdf') }}</span>
                        </a>
                    </div>

                    <!-- PDF Embedded Viewer -->
                    <div class="rounded-xl border border-slate-200 overflow-hidden h-[500px] bg-slate-50">
                        <object data="{{ asset('storage/' . $lesson->pdf_file) }}" type="application/pdf" class="w-full h-full">
                            <p class="p-6 text-center text-slate-500 text-sm">
                                {{ __('general.cannot_preview_pdf') }} 
                                <a href="{{ asset('storage/' . $lesson->pdf_file) }}" class="text-slate-800 font-semibold underline" target="_blank">{{ __('general.click_here_to_download') }}</a>
                            </p>
                        </object>
                    </div>
                </div>
            @else
                <div class="p-8 text-center bg-slate-50 rounded-xl text-slate-400 text-sm border border-dashed border-slate-200">
                    {{ __('general.no_pdf_attached') }}
                </div>
            @endif
        </div>

    </div>

</div>
@endsection