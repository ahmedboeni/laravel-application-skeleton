@extends('layouts.app')

@section('title', __('app.dashboard'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                {{ __('app.dashboard') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                {{ __('app.welcome_message', ['site_name' => \App\Helpers\AppHelper::getSiteName()]) }}
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_users') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['users']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Services -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_services') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['services']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Transactions -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_transactions') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['transactions']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_revenue') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['total_amount'], 2) }} {{ __('app.currency') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Transactions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.recent_activity') }}</h3>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        @forelse($latestTransactions as $transaction)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $transaction->user->name ?? __('app.no_data') }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $transaction->description ?? __('app.transaction') }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right" :class="{ 'text-left': direction === 'rtl' }">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ number_format($transaction->amount, 2) }} {{ __('app.currency') }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $transaction->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <p class="text-gray-500 dark:text-gray-400">{{ __('app.no_transactions') }}</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.transactions.index') }}" class="text-sm text-primary-600 hover:text-primary-500">
                        {{ __('app.view') }} {{ __('app.transactions') }} →
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.quick_actions') }}</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('admin.users.create') }}" 
                           class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.add_user') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.create_new_account') }}</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.services.create') }}" 
                           class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-md bg-success-500 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.add_service') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.create_new_service') }}</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.categories.create') }}" 
                           class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.add_category') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.create_new_category') }}</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.advertisements.create') }}" 
                           class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-md bg-danger-500 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.add_advertisement') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.create_new_advertisement') }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="mt-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.system_status') }}</h3>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-3 w-3 rounded-full bg-success-400"></div>
                            </div>
                            <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.database') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.connected') }} {{ __('app.and') }} {{ __('app.stable') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-3 w-3 rounded-full bg-success-400"></div>
                            </div>
                            <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.server') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.running') }} {{ __('app.normally') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-3 w-3 rounded-full bg-success-400"></div>
                            </div>
                            <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.api') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.available') }} {{ __('app.and') }} {{ __('app.responsive') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 