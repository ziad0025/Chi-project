@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.students_enrolled') ?? 'الطلاب المسجلين في كورس' }}: {{ $course->title }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ __('general.total_students') ?? 'إجمالي الطلاب المسجلين' }}: <span class="font-semibold text-indigo-600">{{ $course->users->count() }}</span></p>
        </div>
        <div>
            <a href="{{ route('courses.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium text-sm rounded-xl transition shadow-xs">
                <span>{{ __('general.back_to_courses') ?? 'العودة للكورسات' }}</span>
            </a>
        </div>
    </div>

    <!-- Students Table / List -->
    @if($course->users->count() > 0)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left rtl:text-right border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            <th class="py-4 px-6">#</th>
                            <th class="py-4 px-6">{{ __('general.name') ?? 'اسم الطالب' }}</th>
                            <th class="py-4 px-6">{{ __('general.email') ?? 'البريد الإلكتروني' }}</th>
                            <th class="py-4 px-6">{{ __('general.enrollment_date') ?? 'تاريخ التسجيل' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                        @foreach($course->users as $index => $student)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="py-4 px-6 font-medium text-slate-500">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-semibold text-slate-800 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">
                                        {{ mb_substr($student->name, 0, 1) }}
                                    </div>
                                    {{ $student->name }}
                                </td>
                                <td class="py-4 px-6 text-slate-500">{{ $student->email }}</td>
                                <td class="py-4 px-6 text-slate-400 text-xs">{{ $student->pivot->created_at ? $student->pivot->created_at->format('Y-m-d') : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
            <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">{{ __('general.no_students_enrolled') ?? 'لا توجد طلاب مسجلين' }}</h3>
            <p class="text-sm text-slate-500">{{ __('general.no_students_description') ?? 'لم يقم أي طالب بالتسجيل في هذا الكورس حتى الآن.' }}</p>
        </div>
    @endif

</div>
@endsection