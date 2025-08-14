@extends('layouts.app')

@section('title', \App\Helpers\AppHelper::getSiteName())

@section('content')
<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-gradient-to-br from-blue-600 to-purple-700 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            <h1 class="text-4xl font-bold text-white">
                {{ \App\Helpers\AppHelper::getSiteName() }}
            </h1>
        </div>

        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <div class="scale-100 p-6 bg-white/10 backdrop-blur-sm rounded-lg shadow-2xl flex motion-safe:hover:scale-[1.01] transition-all duration-250">
                    <div>
                        <h2 class="text-xl font-semibold text-white">{{ __('app.welcome_message') }}</h2>
                        <p class="mt-4 text-blue-100 text-sm leading-relaxed">
                            {{ __('app.welcome_message') }}
                        </p>
                    </div>
                </div>

                <div class="scale-100 p-6 bg-white/10 backdrop-blur-sm rounded-lg shadow-2xl flex motion-safe:hover:scale-[1.01] transition-all duration-250">
                    <div>
                        <h2 class="text-xl font-semibold text-white">{{ __('app.features') }}</h2>
                        <ul class="mt-4 text-blue-100 text-sm leading-relaxed">
                            <li>• {{ __('app.user_management') }}</li>
                            <li>• {{ __('app.service_management') }}</li>
                            <li>• {{ __('app.transaction_management') }}</li>
                            <li>• {{ __('app.dashboard') }}</li>
                            <li>• {{ __('app.responsive') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-blue-100 sm:text-start">
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="group inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 rounded-lg transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="-mt-px mr-1 w-5 h-5 stroke-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        {{ __('app.login') }}
                    </a>
                </div>
            </div>

            <div class="ml-4 text-center text-sm text-blue-100 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</div>
@endsection
