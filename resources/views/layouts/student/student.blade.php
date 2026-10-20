<!DOCTYPE html>
<html lang="{{app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data="{ sidebarOpen: false }" class="font-sans antialiased bg-slate-50 text-slate-800 min-h-screen">
        
        <!-- Background Overlay للموبايل لما السايد بار يتفتح -->
        <div x-show="sidebarOpen" 
             x-cloak
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden transition-opacity"></div>

        <!-- 1. السايد بار (Dark) -->
        @include('layouts.student.sidebar')

        <!-- 2. الجزء الأيسر (الناف بار الأبيض + المحتوى) -->
        <div class="ltr:lg:ml-64 rtl:lg:mr-64 flex flex-col min-h-screen transition-all">
    @include('layouts.student.nav')

    <main class="flex-1 p-6 bg-slate-50">
       
            @yield('content')
       
    </main>
</div>

    </body>
</html>