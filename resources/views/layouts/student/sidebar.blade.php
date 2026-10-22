<aside :class="sidebarOpen ? 'translate-x-0' : (document.dir === 'rtl' ? 'translate-x-full lg:translate-x-0' : '-translate-x-full lg:translate-x-0')"
       class="fixed top-0 ltr:left-0 rtl:right-0 z-50 w-64 h-screen transition-transform duration-300 ease-in-out bg-slate-900 ltr:border-r rtl:border-l border-slate-800 flex flex-col justify-between">
    <div>
        <!-- Logo / Brand Area -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800 bg-slate-950/40">
            <div class="flex items-center gap-3">
                 <img src="{{ asset('images/logo-white.png') }}" alt="Logo" class="h-10 mb-2">
                <span class="text-base font-bold text-white tracking-wide">{{ __('general.student_dashboard') ?? 'بوابة الطلاب' }}</span>
            </div>

            <!-- Close button for Mobile only -->
            <button @click="sidebarOpen = false" class="text-slate-400 hover:text-white lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="p-4 space-y-1.5">
            <a href="{{ route('students.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('students.index') ? 'bg-indigo-600 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                <span>{{ __('general.available_courses') ?? 'الكورسات المتاحة' }}</span>
            </a>

            <a href="{{ route('students.my-courses') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('students.my-courses') ? 'bg-indigo-600 text-white shadow-sm' : 'hover:bg-slate-800 text-slate-300 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <span>{{ __('general.my_courses') ?? 'كورساتي المسجلة' }}</span>
            </a>
        </nav>
    </div>

    <!-- Bottom User Info & Logout -->
    <div class="p-4 border-t border-slate-800 bg-slate-950/20">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5 overflow-hidden">
                <div class="w-8 h-8 rounded-full bg-indigo-500/20 text-indigo-400 border border-indigo-500/30 flex items-center justify-center font-bold text-xs shrink-0">
                    {{ mb_substr(Auth::user()->name ?? 'S', 0, 1) }}
                </div>
                <span class="text-xs font-semibold text-slate-300 truncate max-w-[110px]">{{ Auth::user()->name ?? 'طالب' }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-400 transition rounded-lg hover:bg-slate-800" title="تسجيل الخروج">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </div>
</aside>