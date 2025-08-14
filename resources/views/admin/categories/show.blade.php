@extends('layouts.app')

@section('title', __('app.category_details'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.category_details') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.category_details_description', ['default' => 'عرض تفاصيل الفئة والخدمات المرتبطة بها']) }}
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.categories.edit', $category) }}" 
                       class="btn btn-warning">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('app.edit') }}
                    </a>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="btn btn-outline-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Category Information -->
            <div class="lg:col-span-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.category_information') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-6">
                            <!-- Category Header -->
                            <div class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-lg flex items-center justify-center" style="background-color: {{ $category->color }}; color: white;">
                                        @if($category->icon)
                                            <i class="fas fa-{{ $category->icon }} text-xl"></i>
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $category->name_ar }}</h4>
                                    @if($category->name_en)
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->name_en }}</p>
                                    @endif
                                    <div class="mt-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $category->is_active ? __('app.active') : __('app.inactive') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Type -->
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.category_type') }}</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->type ?: __('app.none') }}</p>
                                </div>

                                <!-- Icon -->
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.category_icon') }}</label>
                                    <div class="mt-1 flex items-center">
                                        @if($category->icon)
                                            <i class="fas fa-{{ $category->icon }} text-xl text-gray-600 dark:text-gray-400 mr-2"></i>
                                            <span class="text-sm text-gray-900 dark:text-white">{{ $category->icon }}</span>
                                        @else
                                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.none') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Color -->
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.category_color') }}</label>
                                    <div class="mt-1 flex items-center">
                                        <div class="w-6 h-6 rounded border border-gray-300 mr-2" style="background-color: {{ $category->color }}"></div>
                                        <span class="text-sm text-gray-900 dark:text-white">{{ $category->color }}</span>
                                    </div>
                                </div>

                                <!-- Services Count -->
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.category_services_count') }}</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->services->count() }}</p>
                                </div>

                                <!-- Created At -->
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.category_created_at') }}</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->created_at->format('Y-m-d H:i:s') }}</p>
                                </div>

                                <!-- Updated At -->
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.category_updated_at') }}</label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $category->updated_at->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Services -->
                <div class="card mt-6">
                    <div class="card-header">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.category_services') }}</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $category->services->count() }} {{ __('app.services') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($category->services->count() > 0)
                            <div class="space-y-4">
                                @foreach($category->services as $service)
                                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="h-8 w-8 rounded-md bg-primary-100 flex items-center justify-center">
                                                <svg class="h-4 w-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $service->title_ar }}
                                            </p>
                                            @if($service->title_en)
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $service->title_en }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                        <div class="text-right" :class="{ 'text-left': direction === 'rtl' }">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ number_format($service->price, 2) }} {{ __('app.currency') }}
                                            </p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $service->is_active ? __('app.active') : __('app.inactive') }}
                                            </span>
                                        </div>
                                        <a href="{{ route('admin.services.show', $service) }}" 
                                           class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                            {{ __('app.view') }} →
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_category_services') }}</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.empty_state_message') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Category Preview -->
            <div class="lg:col-span-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.category_preview') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            <!-- Category Card Preview -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                                <div class="p-4" style="background-color: {{ $category->color }}; color: white;">
                                    <div class="flex items-center">
                                        @if($category->icon)
                                            <i class="fas fa-{{ $category->icon }} text-xl mr-3"></i>
                                        @else
                                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        @endif
                                        <h4 class="text-lg font-semibold">{{ $category->name_ar }}</h4>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="space-y-2">
                                        @if($category->name_en)
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.category_name_en') }}:</span>
                                            <span class="text-sm text-gray-900 dark:text-white">{{ $category->name_en }}</span>
                                        </div>
                                        @endif
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.category_services_count') }}:</span>
                                            <span class="text-sm text-gray-900 dark:text-white">{{ $category->services->count() }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.category_status') }}:</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $category->is_active ? __('app.active') : __('app.inactive') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Stats -->
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3">{{ __('app.quick_stats') }}</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.total_services') }}</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->services->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.active_services') }}</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->services->where('is_active', true)->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.created') }}</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->created_at->format('Y-m-d') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 