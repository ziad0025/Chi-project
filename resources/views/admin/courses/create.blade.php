@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">{{ __('general.create_new_course') }}</h1>
            <p class="text-sm text-slate-500 mt-1"> {{__('general.fill_the_form_below')}}</p>
        </div>
        <a href="{{ route('courses.index') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-slate-300 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-xl transition">
           {{ __('general.back_to_courses') }}
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf

        <!-- Main Column -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs space-y-5">
                
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2"> {{ __('general.course_title') }} <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm @error('title') border-rose-500 @enderror" 
                           placeholder="{{ __('general.placeholder_title_course') }}" required>
                    @error('title')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grade -->
                <div>
                    <label for="grade" class="block text-sm font-semibold text-slate-700 mb-2"> {{ __('general.grade') }} <span class="text-rose-500">*</span></label>
                    <select name="grade" id="grade" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm bg-white @error('grade') border-rose-500 @enderror" required>
                        <option value="" disabled selected> {{ __('general.grade_year') }} </option>
                        <option value="الصف الأول الثانوي" {{ old('grade') == 'الصف الأول ' ? 'selected' : '' }}>الصف الأول </option>
                        <option value="الصف الثاني الثانوي" {{ old('grade') == 'الصف الثاني ' ? 'selected' : '' }}>الصف الثاني </option>
                        <option value="الصف الثالث الثانوي" {{ old('grade') == 'الصف الثالث ' ? 'selected' : '' }}>الصف الثالث </option>
                        <option value="الصف الثالث الثانوي" {{ old('grade') == 'الصف الرابع ' ? 'selected' : '' }}>الصف الرابع </option>
                    </select>
                    @error('grade')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2"> {{ __('general.description_ofcourse') }} </label>
                    <textarea name="description" id="description" rows="5" 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm" 
                              placeholder="{{ __('general.placeholder_description_ofcourse') }}">{{ old('description') }}</textarea>
                </div>

            </div>
        </div>

        <!-- Sidebar Panel -->
        <div class="space-y-6">
            
            <!-- Image / Thumbnail with File Indicator -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs space-y-4" x-data="{ fileName: null }">
                <label class="block text-sm font-semibold text-slate-700">{{ __('general.image_title') }} </label>
                
                <div class="border-2 border-dashed rounded-2xl p-4 text-center transition cursor-pointer relative overflow-hidden"
                     :class="fileName ? 'border-emerald-400 bg-emerald-50/40' : 'border-slate-200 hover:border-indigo-400 bg-slate-50/50'">
                    
                    <input type="file" name="image" id="image" accept="image/*" 
                           class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10"
                           @change="fileName = $event.target.files[0] ? $event.target.files[0].name : null">

                    <!-- Default View -->
                    <div x-show="!fileName" class="space-y-2">
                        <p class="text-xs text-slate-600 font-medium"> {{ __('general.image_upload_prompt') }} </p>
                        <p class="text-[10px] text-slate-400">PNG, JPG, WEBP</p>
                    </div>

                    <!-- Selected View -->
                    <div x-show="fileName" class="space-y-1 py-1" x-cloak>
                        <div class="w-8 h-8 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-sm font-bold">
                            ✓
                        </div>
                        <p class="text-xs font-semibold text-emerald-700">{{ __('general.succses_image') }} </p>
                        <p class="text-[11px] text-slate-500 font-mono truncate max-w-[200px] mx-auto" x-text="fileName"></p>
                    </div>

                </div>
                @error('image')
                    <p class="text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Publishing & Pricing -->
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-xs space-y-5">
                
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-slate-700 mb-2"> {{ __('general.course_price') }} </label>
                    <div class="relative">
                        <input type="number" name="price" id="price" value="{{ old('price', 0) }}" step="0.01" min="0" 
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition text-sm" 
                               placeholder="0.00">
                        <span class="absolute ltr:right-4 rtl:left-4 top-2.5 text-xs text-slate-400 font-semibold">EGP</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1"> {{ __('general.course_price_description') }} </p>
                </div>

                <!-- Status Checkbox / Toggle -->
                <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                    <div>
                        <span class="block text-sm font-semibold text-slate-700"> {{ __('general.publish_course') }} </span>
                        <span class="block text-xs text-slate-400"> {{ __('general.course_visibility_description') }} </span>
                    </div>
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} 
                           class="w-5 h-5 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                </div>

                <!-- Submit Buttons -->
                <div class="pt-4 space-y-2">
                    <button type="submit" 
                            class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl transition shadow-xs text-center">
                        {{ __('general.save_and_create_course') }}
                    </button>
                </div>

            </div>

        </div>

    </form>

</div>
@endsection