@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.course_lessons') }}: {{ $course->title }}</h1>
            <p class="text-slate-500 text-sm mt-1">{{ __('general.manage_lessons_desc') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('courses.index') }}" 
               class="px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-medium rounded-xl hover:bg-slate-50 transition">
                ← {{ __('general.back_to_courses') }}
            </a>
            <a href="{{ route('lessons.create', $course->id) }}" 
               class="px-4 py-2 bg-slate-800 text-white text-sm font-medium rounded-xl hover:bg-slate-900 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('general.add_new_lesson') }}
            </a>
        </div>
    </div>

    <!-- Lessons Table / List -->
    <div class="bg-white rounded-2xl shadow-xs border border-slate-100 overflow-hidden">
        @if($lessons->isEmpty())
            <div class="p-12 text-center">
                <p class="text-slate-400 text-sm mb-4">{{ __('general.no_lessons_yet') }}</p>
                <a href="{{ route('lessons.create', $course->id) }}" 
                   class="inline-block px-4 py-2 bg-slate-800 text-white text-sm font-medium rounded-xl">
                    {{ __('general.add_first_lesson') }}
                </a>
            </div>
        @else
            <table class="w-full text-right text-sm">
                <thead class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold">
                    <tr>
                        <th class="p-4">#</th>
                        <th class="p-4">{{ __('general.lesson_title') }}</th>
                        <th class="p-4">{{ __('general.video_type') }}</th>
                        <th class="p-4">{{ __('general.pdf_file') }}</th>
                        <th class="p-4">{{ __('general.is_free') }}</th>
                        <th class="p-4 text-center">{{ __('general.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($lessons as $lesson)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 font-bold text-slate-400">{{ $lesson->order }}</td>
                            <td class="p-4 font-semibold text-slate-800">{{ $lesson->title }}</td>
                            <td class="p-4 text-slate-500">
                                @if($lesson->video_url)
                                    <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-md text-xs font-medium">{{ __('general.external_link') }}</span>
                                @elseif($lesson->video_path)
                                    <span class="px-2.5 py-1 bg-purple-50 text-purple-600 rounded-md text-xs font-medium">{{ __('general.uploaded_file') }}</span>
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="p-4">
                                @if($lesson->pdf_file)
                                    <span class="text-emerald-600 text-xs font-semibold">{{ __('general.available') }} ✓</span>
                                @else
                                    <span class="text-slate-300">-</span>
                                @endif
                            </td>
                            <td class="p-4">
                                @if($lesson->is_free)
                                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-md text-xs font-medium">{{ __('general.free_preview') }}</span>
                                @else
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-md text-xs font-medium">{{ __('general.paid') }}</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Show / Preview -->
                                    <a href="{{ route('lessons.show', [$course->id, $lesson->id]) }}" 
                                       title="{{ __('general.show') }}"
                                       class="p-2 text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('lessons.edit', [$course->id, $lesson->id]) }}" 
                                       title="{{ __('general.edit') }}"
                                       class="p-2 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('lessons.destroy', [$course->id, $lesson->id]) }}" method="POST" onsubmit="return confirm('{{ __('general.confirm_delete_lesson') }}')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                title="{{ __('general.delete') }}"
                                                class="p-2 text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection