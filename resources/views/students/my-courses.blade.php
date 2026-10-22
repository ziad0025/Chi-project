@extends('layouts.student.student')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.my_courses') }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ __('general.my_courses_desc') }}</p>
        </div>
    </div>

    <!-- Courses Grid -->
    @if($courses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                    
                    <!-- Top Image Banner -->
                    <div class="relative h-44 bg-slate-100">
                        <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://placehold.co/600x400/1e293b/FFF?text=Course' }}" 
                            alt="{{ $course->title }}" 
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Content -->
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $course->title }}</h3>
                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">{{ $course->description }}</p>
                        </div>

                        <div class="flex items-center justify-between text-xs text-slate-500 pt-4 border-t border-slate-100">
                            <span>{{ $course->lessons->count() }} {{ __('general.lessons') }}</span>
                            <span class="font-bold text-slate-800 text-sm">
                                {{ $course->price ? $course->price . ' EGP' : __('general.free') }}
                            </span>
                        </div>
                    </div>

                    <!-- Footer Action (الزرارين جنب بعض) -->
                    <div class="px-5 py-3.5 bg-slate-50/80 border-t border-slate-100 flex items-center gap-2">
                        
                        <!-- زرار ابدأ التعلم (بياخد المساحة الأكبر) -->
                        <a href="{{ route('students.show', $course->id) }}" 
                           class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition text-center shadow-xs flex justify-center items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('general.start_learning') ?? 'ابدأ التعلم' }}
                        </a>

                        <!-- زرار إلغاء الاشتراك (أيقونة صغيرة) -->
                        <form action="{{ route('students.unenroll', $course->id) }}" method="POST" class="flex-shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="{{ __('general.remove_course') }}" class="w-10 h-10 flex items-center justify-center bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl border border-rose-200 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>

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
            <h3 class="text-lg font-bold text-slate-800 mb-1">{{ __('general.no_enrolled_courses') }}</h3>
            <p class="text-sm text-slate-500 mb-6">{{ __('general.no_enrolled_desc') }}</p>
            <a href="{{ route('students.index') }}" class="px-4 py-2.5 bg-indigo-600 text-white text-xs font-semibold rounded-xl hover:bg-indigo-700 transition inline-block">
                {{ __('general.browse_available_courses') }}
            </a>
        </div>
    @endif

</div>
@endsection