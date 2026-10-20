<header class="sticky top-0 z-30 flex w-full bg-white border-b border-slate-200 shadow-sm">
    <div class="flex flex-grow items-center justify-between px-4 py-3 md:px-6">
        
        <!-- Left Side: Toggle Sidebar Button & Search Input -->
        <div class="flex items-center gap-3">
            <!-- Hamburger Toggle Button (Mobile) -->
            <button @click="sidebarOpen = !sidebarOpen" 
                    class="block rounded-lg border border-slate-200 bg-slate-100 p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-200 lg:hidden focus:outline-none">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 8C3 7.44772 3.44772 7 4 7H20C20.5523 7 21 7.44772 21 8C21 8.55228 20.5523 9 20 9H4C3.44772 9 3 8.55228 3 8ZM3 16C3 15.4477 3.44772 15 4 15H20C20.5523 15 21 15.4477 21 16C21 16.5523 20.5523 17 20 17H4C3.44772 17 3 15.4477 3 16Z"/>
                </svg>
            </button>

            <!-- Search Bar -->
            <div class="hidden sm:block">
                <form action="#" method="POST">
                    <div class="relative">
                        <button class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 pl-3">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9 3.5C5.96243 3.5 3.5 5.96243 3.5 9C3.5 12.0376 5.96243 14.5 9 14.5C10.2835 14.5 11.464 14.0628 12.4042 13.3283L16.0379 16.962 16.962 16.0379L13.3283 12.4042C14.0628 11.464 14.5 10.2835 14.5 9C14.5 5.96243 12.0376 3.5 9 3.5ZM4.9 9C4.9 6.73563 6.73563 4.9 9 4.9C11.2644 4.9 13.1 6.73563 13.1 9C13.1 11.2644 11.2644 13.1 9 13.1C6.73563 13.1 4.9 11.2644 4.9 9Z"/>
                            </svg>
                        </button>
                        <input type="text" placeholder="{{ __('general.search') }}" class="w-full bg-slate-100 text-slate-800 placeholder-slate-400 pl-10 pr-4 py-2 rounded-lg border border-slate-200 text-sm focus:outline-none focus:border-indigo-500 focus:bg-white transition" />
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Right Side: User Profile & Actions -->

        <div class="flex items-center gap-3">

   

            <div class="relative flex items-center gap-3">
                <div class="hidden text-right lg:block">
                    <span class="block text-sm font-semibold text-slate-800">{{ Auth::user()->name ?? 'اسم المستخدم' }}</span>
                    <span class="block text-xs text-slate-500">Student</span>
                </div>

                <!-- Avatar Circle -->
                <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold border border-indigo-100 shadow-sm">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="mr-1">
                    @csrf
                    <button type="submit" title="تسجيل الخروج" class="p-2 text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>