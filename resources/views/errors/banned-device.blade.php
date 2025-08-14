@extends('layouts.app')

@section('title', __('app.device_banned'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <!-- أيقونة الجهاز المحظور -->
            <div class="mx-auto h-24 w-24 flex items-center justify-center rounded-full bg-red-100 dark:bg-red-900">
                <svg class="h-12 w-12 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                {{ __('app.device_banned') }}
            </h2>
            
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('app.device_banned_message') }}
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <!-- معلومات الجهاز -->
            <div class="space-y-4">
                <div class="bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 rounded-md p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                {{ __('app.security_notice') }}
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                <p>{{ __('app.device_security_message') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        {{ __('app.what_you_can_do') }}:
                    </h3>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('app.use_different_device') }}
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('app.clear_browser_data') }}
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('app.use_incognito_mode') }}
                        </li>
                        <li class="flex items-start">
                            <svg class="h-5 w-5 text-green-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('app.contact_support_for_help') }}
                        </li>
                    </ul>
                </div>
            </div>

            <!-- أزرار الإجراءات -->
            <div class="mt-8 space-y-3">
                <a href="{{ route('contact.support') }}" 
                   class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    {{ __('app.contact_support') }}
                </a>
                
                <button onclick="window.location.reload()" 
                        class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                    {{ __('app.try_again') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection 