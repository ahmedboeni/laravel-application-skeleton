@extends('layouts.app')

@section('title', __('app.service_option_details'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.service_option_details') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.service_option_details_description', ['default' => 'عرض تفاصيل خيار الخدمة']) }}
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.service-options.edit', $serviceOption) }}" 
                       class="btn btn-outline-warning">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('app.edit') }}
                    </a>
                    <a href="{{ route('admin.service-options.index') }}" 
                       class="btn btn-outline-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Service Option Information -->
        <div class="card mb-8">
            <div class="card-header">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-12 w-12 rounded-lg bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                            <svg class="h-6 w-6 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $serviceOption->option_name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $serviceOption->service->name_ar ?? __('app.service_not_found') }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $serviceOption->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $serviceOption->is_active ? __('app.active') : __('app.inactive') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('app.service_option_information') }}</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.service') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $serviceOption->service->name_ar ?? __('app.service_not_found') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.option_type') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $serviceOption->option_type }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.option_name') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $serviceOption->option_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.client_field') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $serviceOption->client_field }}</dd>
                            </div>
                            @if($serviceOption->quantity)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.option_quantity') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $serviceOption->quantity }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('app.pricing_information') }}</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.price_type') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">
                                    @if($serviceOption->price_type === 'fixed')
                                        {{ __('app.price_fixed') }}
                                    @else
                                        {{ __('app.price_percent') }}
                                    @endif
                                </dd>
                            </div>
                            @if($serviceOption->price_type === 'fixed')
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.price_fixed') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ number_format($serviceOption->price_fixed, 2) }} {{ __('app.currency') }}</dd>
                            </div>
                            @else
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.price_percent') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $serviceOption->price_percent }}%</dd>
                            </div>
                            @endif
                            @if($serviceOption->price_type === 'fixed' && $serviceOption->provider_price > 0)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.provider_price') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ number_format($serviceOption->provider_price, 3) }} {{ __('app.currency') }}</dd>
                            </div>
                            @endif
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.created_at') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $serviceOption->created_at->format('Y-m-d H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.updated_at') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $serviceOption->updated_at->format('Y-m-d H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                
                @if($serviceOption->extra_info)
                <div class="mt-6">
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('app.extra_info') }}</h4>
                    <p class="text-gray-700 dark:text-gray-300">{{ $serviceOption->extra_info }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Related Service Information -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.related_service') }}</h3>
            </div>
            <div class="card-body">
                @if($serviceOption->service)
                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            @if($serviceOption->service->image)
                                <img src="{{ $serviceOption->service->image }}" alt="{{ $serviceOption->service->name_ar }}" class="h-12 w-12 rounded-lg object-cover">
                            @else
                                <div class="h-12 w-12 rounded-lg bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ $serviceOption->service->name_ar }}</h4>
                            <div class="flex items-center space-x-4 mt-1" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                @if($serviceOption->service->name_en)
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $serviceOption->service->name_en }}</span>
                                @endif
                                @if($serviceOption->service->category)
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $serviceOption->service->category->name_ar }}</span>
                                @endif
                                @if($serviceOption->service->type)
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $serviceOption->service->type }}</span>
                                @endif
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ number_format($serviceOption->service->price, 2) }} {{ __('app.currency') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.services.show', $serviceOption->service) }}" 
                           class="btn btn-sm btn-outline-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            {{ __('app.view_service') }}
                        </a>
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.service_not_found') }}</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.service_deleted_or_not_exists') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 