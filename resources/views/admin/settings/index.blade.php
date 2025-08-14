@extends('layouts.app')

@section('title', __('app.settings'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                <i class="fas fa-cogs text-primary-600 ml-2"></i>
                {{ __('app.settings') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                {{ __('app.manage_system_settings') }}
            </p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6 mb-8">
            <!-- Users -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.users_label') }}</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['users']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-success-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.services_label') }}</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['services']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.transactions_label') }}</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['transactions']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Sales -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-danger-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_sales_label') }}</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">${{ number_format($stats['total_amount'], 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-secondary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.categories_label') }}</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['categories']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-info-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.payment_methods_label') }}</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['payment_methods']) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Form -->
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Site Settings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            <i class="fas fa-globe text-primary-600 ml-2"></i>
                            {{ __('app.site_settings') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        @if(isset($settings['site']))
                            @foreach($settings['site'] as $setting)
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        {{ $setting->description }}
                                    </label>
                                    @if($setting->setting_type == 'boolean')
                                        <select name="settings[{{ $setting->setting_key }}]" 
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                            <option value="1" {{ $setting->setting_value == '1' ? 'selected' : '' }}>{{ __('app.enabled') }}</option>
                                            <option value="0" {{ $setting->setting_value == '0' ? 'selected' : '' }}>{{ __('app.disabled') }}</option>
                                        </select>
                                    @else
                                        <input type="text" name="settings[{{ $setting->setting_key }}]" 
                                               value="{{ old('settings.' . $setting->setting_key, $setting->setting_value) }}" 
                                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Contact Settings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            <i class="fas fa-phone text-success-600 ml-2"></i>
                            {{ __('app.contact_settings') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        @if(isset($settings['contact']))
                            @foreach($settings['contact'] as $setting)
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        {{ $setting->description }}
                                    </label>
                                    <input type="{{ $setting->setting_type == 'email' ? 'email' : 'text' }}" 
                                           name="settings[{{ $setting->setting_key }}]" 
                                           value="{{ old('settings.' . $setting->setting_key, $setting->setting_value) }}" 
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Currency Settings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            <i class="fas fa-dollar-sign text-warning-600 ml-2"></i>
                            {{ __('app.currency_settings') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        @if(isset($settings['currency']))
                            @foreach($settings['currency'] as $setting)
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        {{ $setting->description }}
                                    </label>
                                    @if($setting->setting_key == 'default_currency')
                                        <select name="settings[{{ $setting->setting_key }}]" 
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                            <option value="USD" {{ $setting->setting_value == 'USD' ? 'selected' : '' }}>{{ __('app.usd_currency') }}</option>
                                            <option value="YER" {{ $setting->setting_value == 'YER' ? 'selected' : '' }}>{{ __('app.yer_currency') }}</option>
                                            <option value="SAR" {{ $setting->setting_value == 'SAR' ? 'selected' : '' }}>{{ __('app.sar_currency') }}</option>
                                        </select>
                                    @elseif($setting->setting_key == 'currency_position')
                                        <select name="settings[{{ $setting->setting_key }}]" 
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                            <option value="left" {{ $setting->setting_value == 'left' ? 'selected' : '' }}>{{ __('app.left') }}</option>
                                            <option value="right" {{ $setting->setting_value == 'right' ? 'selected' : '' }}>{{ __('app.right') }}</option>
                                        </select>
                                    @else
                                        <input type="text" name="settings[{{ $setting->setting_key }}]" 
                                               value="{{ old('settings.' . $setting->setting_key, $setting->setting_value) }}" 
                                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Payment Settings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            <i class="fas fa-credit-card text-info-600 ml-2"></i>
                            {{ __('app.payment_settings') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        @if(isset($settings['payment']))
                            @foreach($settings['payment'] as $setting)
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        {{ $setting->description }}
                                    </label>
                                    @if($setting->setting_type == 'boolean')
                                        <select name="settings[{{ $setting->setting_key }}]" 
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                            <option value="1" {{ $setting->setting_value == '1' ? 'selected' : '' }}>{{ __('app.enabled') }}</option>
                                            <option value="0" {{ $setting->setting_value == '0' ? 'selected' : '' }}>{{ __('app.disabled') }}</option>
                                        </select>
                                    @else
                                        <input type="text" name="settings[{{ $setting->setting_key }}]" 
                                               value="{{ old('settings.' . $setting->setting_key, $setting->setting_value) }}" 
                                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white">
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Save Buttons -->
            <div class="mt-8">
                <div class="card">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200">
                                <i class="fas fa-save ml-2"></i>
                                {{ __('app.save_settings') }}
                            </button>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200">
                                <i class="fas fa-arrow-left ml-2"></i>
                                {{ __('app.back_to_dashboard') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 