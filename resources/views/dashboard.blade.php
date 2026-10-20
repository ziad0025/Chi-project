@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.dashboard_title') }}</h1>
            <p class="text-sm text-slate-500 mt-1">{{ __('general.dashboard_welcome') }}</p>
        </div>
     
    </div>

    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Total Courses -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">{{ __('general.total_courses') }}</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ $coursesCount ?? 0 }}</h3>
                <span class="text-xs text-emerald-600 font-semibold mt-2 inline-block">{{ __('general.active_in_system') }}</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>

        <!-- Published Courses -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">{{ __('general.published_courses') }}</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ $publishedCoursesCount ?? 0 }}</h3>
                <span class="text-xs text-indigo-600 font-semibold mt-2 inline-block">{{ __('general.available_for_students') }}</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>

        <!-- Total Students -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">{{ __('general.total_students') }}</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ $studentsCount ?? 0 }}</h3>
                <span class="text-xs text-emerald-600 font-semibold mt-2 inline-block">{{ __('general.registered_in_system') }}</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>

    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
            <h3 class="text-lg font-bold text-slate-800 mb-4">{{ __('general.system_statistics') }}</h3>
            <div class="relative h-72">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs">
            <h3 class="text-lg font-bold text-slate-800 mb-4">{{ __('general.courses_distribution') }}</h3>
            <div class="relative h-72 flex justify-center">
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Courses Table & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Recent Courses -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 p-6 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-800">{{ __('general.latest_courses') }}</h3>
                <a href="{{ route('courses.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition">{{ __('general.show_all') }}</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left rtl:text-right border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase">
                            <th class="py-3 px-4">{{ __('general.course_title') }}</th>
                            <th class="py-3 px-4">{{ __('general.course_price') }}</th>
                            <th class="py-3 px-4">{{ __('general.status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($latestCourses ?? [] as $course)
                            <tr class="hover:bg-slate-50/50">
                                <td class="py-3.5 px-4 font-semibold text-slate-800">{{ $course->title }}</td>
                                <td class="py-3.5 px-4 text-slate-600">{{ $course->price ? $course->price . ' EGP' : __('general.free') }}</td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $course->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $course->is_published ? __('general.publich') : __('general.draft') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-slate-400 text-sm">{{ __('general.no_courses') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions Panel -->
        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-bold text-slate-800 mb-4">{{ __('general.quick_actions') }}</h3>
                <div class="space-y-3">
                    <a href="{{ route('courses.index') }}" class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-indigo-50/50 text-slate-700 hover:text-indigo-600 text-sm font-medium rounded-xl border border-slate-200/60 transition">
                        <span>{{ __('general.manage_courses') ?? 'إدارة الكورسات' }}</span>
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <a href="{{ route('courses.create') }}" class="flex items-center justify-between p-3.5 bg-slate-50 hover:bg-indigo-50/50 text-slate-700 hover:text-indigo-600 text-sm font-medium rounded-xl border border-slate-200/60 transition">
                        <span>{{ __('general.create_new_course') }}</span>
                        <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-slate-100">
                <div class="bg-indigo-50/60 p-4 rounded-xl text-indigo-900 text-xs leading-relaxed">
                    💡 <span class="font-bold">{{ __('general.system_tip_title') ?? 'نصيحة النظام:' }}</span> {{ __('general.system_tip_desc') ?? 'يمكنك متابعة الطلاب المسجلين في كل مادة مباشرة عبر أيقونة الطلاب في صفحة إدارة الكورسات.' }}
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['{{ __('general.total_courses') }}', '{{ __('general.published_courses') }}', '{{ __('general.total_students') }}'],
            datasets: [{
                label: '{{ __('general.statistics') ?? "الإحصائيات" }}',
                data: [{{ $coursesCount }}, {{ $publishedCoursesCount }}, {{ $studentsCount }}],
                backgroundColor: ['#6366f1', '#10b981', '#f59e0b'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    const ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
    new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: ['{{ __('general.publich') }}', '{{ __('general.draft') }}'],
            datasets: [{
                data: [{{ $publishedCoursesCount }}, {{ $coursesCount - $publishedCoursesCount }}],
                backgroundColor: ['#10b981', '#cbd5e1']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection