@extends('layouts.student.student')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.available_courses') }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ __('general.browse_and_enroll') }}</p>
        </div>
    </div>

    <!-- Courses Grid (مطابق للصورة تماماً) -->
    @if($courses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                    
                    <!-- Top Image Banner (نفس الهيدر المظلم للكارت) -->
                    <div class="relative h-44 bg-slate-900 flex items-center justify-center p-4">
                        <span class="text-2xl font-bold text-white tracking-wide opacity-90">Course</span>
                        
                     
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

                    <!-- Footer Action -->
                    <div class="px-5 py-3.5 bg-slate-50/80 border-t border-slate-100">
                        @if(Auth::user()->courses->contains($course->id))
                            <form action="{{ route('students.unenroll', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-semibold rounded-xl border border-rose-200 transition text-center">
                                    {{ __('general.remove_course') }}
                                </button>
                            </form>
                        @else
                            <form action="{{ route('students.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition text-center shadow-xs">
                                    {{ __('general.add_to_my_courses') }}
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
            <p class="text-sm text-slate-500">{{ __('general.no_courses') }}</p>
        </div>
    @endif

</div>
@endsection