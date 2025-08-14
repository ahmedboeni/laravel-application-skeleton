@extends('layouts.app')

@section('title', __('app.profile'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                {{ __('app.profile') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                {{ __('app.profile_updated') }}
            </p>
        </div>

        <!-- Profile Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="mr-3">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                                {{ __('app.error') }}
                            </h3>
                            <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="mr-3">
                            <h3 class="text-sm font-medium text-green-800 dark:text-green-200">
                                {{ __('app.success') }}
                            </h3>
                            <div class="mt-2 text-sm text-green-700 dark:text-green-300">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Profile Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        {{ __('app.user_details') }}
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.name') }}
                            </label>
                            <input id="username" name="username" type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200"
                                   value="{{ old('username', auth()->user()->username) }}"
                                   placeholder="{{ __('app.name_placeholder') }}">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.email') }}
                            </label>
                            <input id="email" name="email" type="email" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   placeholder="{{ __('app.email_placeholder') }}">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.phone') }}
                            </label>
                            <input id="phone" name="phone" type="tel" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200"
                                   value="{{ old('phone', auth()->user()->phone) }}"
                                   placeholder="{{ __('app.phone_placeholder') }}">
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.address') }}
                            </label>
                            <input id="address" name="address" type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200"
                                   value="{{ old('address', auth()->user()->address) }}"
                                   placeholder="{{ __('app.address_placeholder') }}">
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        {{ __('app.reset_password') }}
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.password') }}
                            </label>
                            <input id="current_password" name="current_password" type="password" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200"
                                   placeholder="{{ __('app.password_placeholder') }}">
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.password') }}
                            </label>
                            <input id="password" name="password" type="password" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200"
                                   placeholder="{{ __('app.password_placeholder') }}">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.confirm_password') }}
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors duration-200"
                                   placeholder="{{ __('app.password_placeholder') }}">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('dashboard') }}" 
                       class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        {{ __('app.cancel') }}
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        {{ __('app.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 