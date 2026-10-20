@extends('layouts.app') 

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-gray-700 text-3xl  font-bold">{{ __('general.user_management') }}</h3>
    </div>

    <!-- جدول عرض الطلاب -->
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full divide-y divide-gray-200 ">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('general.name') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('general.email') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('general.phone') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('general.role') }}</th>
                            <th class="px-6 py-3 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __('general.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 ">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-center text-sm leading-5 text-center font-medium text-gray-900">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-center text-gray-500">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-center leading-5 text-gray-500">
                                    {{ $user->phone ?? __('general.not_available') }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm text-center leading-5 font-semibold text-green-600">
                                    {{ $user->role }} 
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center text-sm leading-5 font-medium">
                                    <!-- مكان الزر أو الإجراءات مستقبلاً -->
                                    <span class="text-gray-400  text-center text-xs">قريباً</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    {{ __('general.no_students_found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- التصفح (Pagination) -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection