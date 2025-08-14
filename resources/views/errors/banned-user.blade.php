@extends('layouts.app')

@section('title', __('app.account_banned'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <!-- أيقونة الحظر -->
            <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                <svg class="h-12 w-12 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                </svg>
            </div>
            
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                {{ __('app.account_banned') }}
            </h2>
            
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('app.account_banned_message') }}
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <!-- تفاصيل الحظر -->
            <div class="space-y-4">
                @if($user->ban_reason)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('app.ban_reason') }}:
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-3 rounded-md">
                        {{ $user->ban_reason }}
                    </p>
                </div>
                @endif

                @if($user->banned_by)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('app.banned_by') }}:
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $user->banned_by }}
                    </p>
                </div>
                @endif

                @if($user->banned_at)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('app.banned_at') }}:
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $user->banned_at->format('Y-m-d H:i:s') }}
                    </p>
                </div>
                @endif

                @if($remainingTime)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('app.remaining_ban_time') }}:
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $remainingTime }}
                    </p>
                </div>
                @endif

                @if($user->warning_count > 0)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('app.warning_count') }}:
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $user->warning_count }} {{ __('app.warnings') }}
                    </p>
                </div>
                @endif
            </div>

            <!-- أزرار الإجراءات -->
            <div class="mt-8 space-y-3">
                <a href="{{ route('login') }}" 
                   class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    {{ __('app.back_to_login') }}
                </a>
                
                <a href="{{ route('contact.support') }}" 
                   class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                    {{ __('app.contact_support') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 