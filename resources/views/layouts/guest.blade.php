<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts (ممكن تشيل السطر ده لو مش مسطب node_modules) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Tailwind CSS CDN (عشان يشتغل معاك فوراً من غير npm run dev) -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#E8F1F8]">
        <!-- خلفية السحاب اللي في التصميم -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            
            <!-- تأثير السحاب الخفيف في الخلفية -->
            <div class="absolute inset-0 bg-cover bg-center opacity-40 pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/clouds.png');"></div>

            <!-- الكارت الأبيض الأساسي -->
            <div class="w-full sm:max-w-4xl mt-6 px-0 py-0 bg-white shadow-2xl overflow-hidden sm:rounded-3xl flex flex-col md:flex-row relative z-10">
                            <!-- الجزء الشمال (الصورة) -->
                <div class="hidden md:block md:w-1/2 bg-gray-100 relative">
                    <img src="{{ asset('images/bg.jpg') }}" alt="University Platform" class="w-full h-full object-cover">
                    
                    <!-- Overlay خفيف عشان الكلام يبان عليه -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    
                    <!-- النص اللي فوق الصورة -->
                    <div class="absolute bottom-10 left-10 text-white z-10">
                        <h1 class="font-black text-4xl leading-tight mb-2">EXPLORE.<br>LEARN. GROW.</h1>
                        <p class="text-gray-200 text-sm font-medium">Your gateway to academic success.</p>
                    </div>
                </div>
                <!-- الجزء اليمين (الفورم) -->
                <div class="w-full md:w-1/2 p-8 sm:p-12 bg-white flex flex-col justify-center">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>