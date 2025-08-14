@extends('layouts.app')

@section('title', __('app.service_details'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.service_details') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.service_details_description', ['default' => 'عرض تفاصيل الخدمة والخيارات المرتبطة بها']) }}
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.services.edit', $service) }}" 
                       class="btn btn-outline-warning">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('app.edit') }}
                    </a>
                    <a href="{{ route('admin.services.index') }}" 
                       class="btn btn-outline-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Service Information -->
        <div class="card mb-8">
            <div class="card-header">
                <div class="flex items-center">
                    @if($service->image)
                        <img src="{{ $service->image }}" alt="{{ $service->name_ar }}" class="h-12 w-12 rounded-lg object-cover mr-4">
                    @else
                        <div class="h-12 w-12 rounded-lg bg-gray-200 dark:bg-gray-600 flex items-center justify-center mr-4">
                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $service->name_ar }}</h3>
                        @if($service->name_en)
                            <p class="text-gray-600 dark:text-gray-400">{{ $service->name_en }}</p>
                        @endif
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $service->is_active ? __('app.active') : __('app.inactive') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('app.service_information') }}</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.service_category') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $service->category->name_ar ?? __('app.not_specified') }}</dd>
                            </div>
                            @if($service->type)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.service_type') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $service->type }}</dd>
                            </div>
                            @endif
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.service_price') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ number_format($service->price, 2) }} {{ __('app.currency') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.created_at') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $service->created_at->format('Y-m-d H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.updated_at') }}</dt>
                                <dd class="text-sm text-gray-900 dark:text-white">{{ $service->updated_at->format('Y-m-d H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('app.quick_stats') }}</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $service->options->count() }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.total_options') }}</div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $service->options->where('is_active', true)->count() }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.active_options_count') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($service->description)
                <div class="mt-6">
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('app.service_description') }}</h4>
                    <p class="text-gray-700 dark:text-gray-300">{{ $service->description }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Service Options -->
        <div class="card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.service_options') }}</h3>
                    <a href="{{ route('admin.service-options.create') }}?service_id={{ $service->id }}" 
                       class="btn btn-sm btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ __('app.add_service_option') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($service->options->count() > 0)
                    <div class="space-y-4">
                        @foreach($service->options as $option)
                        <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-lg bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                                    <div class="flex items-center">
                                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ $option->option_name }}</h4>
                                        <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $option->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $option->is_active ? __('app.active') : __('app.inactive') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-4 mt-1" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.option_type') }}: {{ $option->option_type }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.client_field') }}: {{ $option->client_field }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ __('app.price_type') }}: 
                                            @if($option->price_type === 'fixed')
                                                {{ __('app.price_fixed') }} ({{ number_format($option->price_fixed, 2) }})
                                            @else
                                                {{ __('app.price_percent') }} ({{ $option->price_percent }}%)
                                            @endif
                                        </span>
                                        @if($option->quantity)
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.option_quantity') }}: {{ $option->quantity }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                <a href="{{ route('admin.service-options.show', $option) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ __('app.view') }}
                                </a>
                                <a href="{{ route('admin.service-options.edit', $option) }}" 
                                   class="btn btn-sm btn-outline-warning">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    {{ __('app.edit') }}
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_options') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.empty_state_message') }}</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.service-options.create') }}?service_id={{ $service->id }}" class="btn btn-primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ __('app.add_service_option') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 