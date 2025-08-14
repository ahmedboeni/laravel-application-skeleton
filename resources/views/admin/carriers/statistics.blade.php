@extends('layouts.app')

@section('title', __('app.carriers_statistics'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.carriers_statistics') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.carriers_statistics_description') }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.carriers.index') }}" class="btn btn-secondary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back_to_carriers') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Carriers -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_carriers') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['total_carriers']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Carriers -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-success-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.active_carriers') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['active_carriers']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inactive Carriers -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.inactive_carriers') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['inactive_carriers']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Average Tabs per Carrier -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-info-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.avg_tabs_per_carrier') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ $stats['total_carriers'] > 0 ? number_format(\App\Models\Carrier::all()->sum(function($carrier) { return count($carrier->tabs); }) / $stats['total_carriers'], 1) : 0 }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Carriers by Service Type -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.carriers_by_service_type') }}</h3>
                </div>
                <div class="card-body">
                    @if($stats['carriers_by_service_type']->count() > 0)
                        <div class="space-y-4">
                            @foreach($stats['carriers_by_service_type'] as $serviceType)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-4 w-4 rounded-full bg-blue-500 mr-3" :class="{ 'ml-3 mr-0': direction === 'rtl' }"></div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $serviceType->service_type }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $serviceType->count }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400 mr-2" :class="{ 'ml-2 mr-0': direction === 'rtl' }">
                                            ({{ $stats['total_carriers'] > 0 ? number_format(($serviceType->count / $stats['total_carriers']) * 100, 1) : 0 }}%)
                                        </span>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $stats['total_carriers'] > 0 ? ($serviceType->count / $stats['total_carriers']) * 100 : 0 }}%"></div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">{{ __('app.no_service_types_found') }}</p>
                    @endif
                </div>
            </div>

            <!-- Recent Carriers -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('app.recent_carriers') }}</h3>
                </div>
                <div class="card-body">
                    @if($stats['recent_carriers']->count() > 0)
                        <div class="space-y-4">
                            @foreach($stats['recent_carriers'] as $carrier)
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                    <div class="flex items-center">
                                        @if($carrier->logo_url)
                                            <img src="{{ $carrier->logo_url }}" alt="{{ $carrier->name_ar }}" class="h-8 w-8 rounded object-cover">
                                        @else
                                            <div class="h-8 w-8 rounded flex items-center justify-center" style="background-color: {{ $carrier->color }}">
                                                <span class="text-white text-xs font-medium">{{ substr($carrier->name_ar, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div class="mr-3" :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $carrier->name_ar }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $carrier->service_type }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $carrier->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ $carrier->is_active ? __('app.active') : __('app.inactive') }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $carrier->created_at->format('M d') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">{{ __('app.no_recent_carriers') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detailed Statistics -->
        <div class="card mt-8">
            <div class="card-header">
                <h3 class="card-title">{{ __('app.detailed_statistics') }}</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Tabs Distribution -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('app.tabs_distribution') }}</h4>
                        @php
                            $allTabs = [];
                            foreach(\App\Models\Carrier::all() as $carrier) {
                                $allTabs = array_merge($allTabs, $carrier->tabs);
                            }
                            $tabCounts = array_count_values($allTabs);
                            arsort($tabCounts);
                        @endphp
                        @if(count($tabCounts) > 0)
                            <div class="space-y-2">
                                @foreach(array_slice($tabCounts, 0, 5) as $tab => $count)
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $tab }}</span>
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">{{ __('app.no_tabs_found') }}</p>
                        @endif
                    </div>

                    <!-- Prefixes Distribution -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('app.prefixes_distribution') }}</h4>
                        @php
                            $allPrefixes = [];
                            foreach(\App\Models\Carrier::all() as $carrier) {
                                $allPrefixes = array_merge($allPrefixes, $carrier->prefixes);
                            }
                            $prefixCounts = array_count_values($allPrefixes);
                            arsort($prefixCounts);
                        @endphp
                        @if(count($prefixCounts) > 0)
                            <div class="space-y-2">
                                @foreach(array_slice($prefixCounts, 0, 5) as $prefix => $count)
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $prefix }}</span>
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $count }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">{{ __('app.no_prefixes_found') }}</p>
                        @endif
                    </div>

                    <!-- Activity Summary -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('app.activity_summary') }}</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('app.carriers_created_today') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ \App\Models\Carrier::whereDate('created_at', today())->count() }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('app.carriers_updated_today') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ \App\Models\Carrier::whereDate('updated_at', today())->count() }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('app.carriers_created_this_week') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ \App\Models\Carrier::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('app.carriers_created_this_month') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ \App\Models\Carrier::whereMonth('created_at', now()->month)->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
