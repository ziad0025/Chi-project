@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 ">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.courses') }}</h1>
        </div>
        <div>
            <a href="{{ route('courses.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white font-medium text-sm rounded-xl transition shadow-xs">
               <span>{{ __('general.create_course') }}</span>
               <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
               </svg>
            </a>
        </div>
    </div>

    <!-- Courses Grid -->
    @if($courses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between hover:shadow-md transition duration-200">
                    
                    <!-- Card Header / Image -->
                    <div class="relative h-48 bg-slate-100">
                        <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://placehold.co/600x400/1e293b/FFF?text=Course' }}" 
                             alt="{{ $course->title }}" 
                             class="w-full h-full object-cover">
                        
                        <!-- Status Badge -->
                        <span class="absolute top-3 ltr:right-3 rtl:left-3 px-2.5 py-1 text-xs font-semibold rounded-full backdrop-blur-md {{ $course->is_published ? 'bg-emerald-500/90 text-white' : 'bg-slate-700/80 text-slate-200' }}">
                            {{ $course->is_published ? __('general.publich') : __('general.draft') }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 line-clamp-1 mb-2">{{ $course->title }}</h3>
                            <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $course->description ?? __('general.no_description') }}</p>
                        </div>

                        <!-- Stats / Meta -->
                        <div class="flex items-center justify-between text-xs text-slate-500 pt-4 border-t border-slate-100">
                            <span class="flex items-center gap-1.5 font-medium">
                                 {{ $course->lessons_count }} {{ __('general.lessons') ?? 'دروس' }}
                            </span>
                            <span class="font-bold text-slate-700 text-sm">
                                {{ $course->price ? $course->price . ' EGP' :  __('general.free') }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Actions Footer -->
                    <div class="px-5 py-3.5 bg-slate-50/80 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('lessons.index', $course->id) }}" 
                           class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">
                           {{ __('general.show_contant') }}
                        </a>

                        <div class="flex items-center gap-2">
                            <!-- Edit -->
                            <a href="{{ route('courses.edit', $course->id) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 transition" title="{{ __('general.edit') }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <!-- Delete -->
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 transition" title="{{ __('general.delete') }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
            <h3 class="text-lg font-bold text-slate-800 mb-1">{{ __('general.no_courses') }}</h3>
            <p class="text-sm text-slate-500 mb-6">{{ __('general.no_courses_description') }}</p>
            <a href="{{ route('courses.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition">
                {{ __('general.create_course') }}
            </a>
        </div>
    @endif

</div>
@endsection