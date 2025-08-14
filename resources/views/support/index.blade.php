@extends('layouts.app')

@section('title', __('app.support_center'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                {{ __('app.support_center') }}
            </h2>
            
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('app.support_center_description') }}
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- الأسئلة الشائعة -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        {{ __('app.frequently_asked_questions') }}
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">
                                {{ __('app.faq_question_1') }}
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('app.faq_answer_1') }}
                            </p>
                        </div>
                        
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">
                                {{ __('app.faq_question_2') }}
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('app.faq_answer_2') }}
                            </p>
                        </div>
                        
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 dark:text-white mb-2">
                                {{ __('app.faq_question_3') }}
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('app.faq_answer_3') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- طرق التواصل -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        {{ __('app.contact_methods') }}
                    </h3>
                    
                    <div class="space-y-4">
                        <a href="{{ route('contact.support') }}" 
                           class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ __('app.email_support') }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $contactSettings['contact_email'] }}</p>
                            </div>
                        </a>
                        
                        <div class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <svg class="h-6 w-6 text-green-600 dark:text-green-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ __('app.phone_support') }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $contactSettings['contact_phone'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <svg class="h-6 w-6 text-purple-600 dark:text-purple-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ __('app.live_chat') }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('app.live_chat_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- أزرار الإجراءات -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('login') }}" 
                   class="flex-1 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    {{ __('app.back_to_login') }}
                </a>
                
                <a href="{{ route('contact.support') }}" 
                   class="flex-1 flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                    {{ __('app.contact_support') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 