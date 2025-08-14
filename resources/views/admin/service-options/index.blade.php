@extends('layouts.app')

@section('title', __('app.service_options'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.service_options') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.manage_service_options_description', ['default' => 'إدارة خيارات الخدمات في النظام']) }}
                    </p>
                </div>
                <a href="{{ route('admin.service-options.create') }}" 
                   class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('app.add_service_option') }}
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Options -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_options') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $options->total() ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Options -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-success-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.active_options_count') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $options->where('is_active', true)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inactive Options -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.inactive_options_count') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $options->where('is_active', false)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services with Options -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-danger-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.services_with_options') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $options->unique('service_id')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Options List -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.service_options') }}</h3>
            </div>
            <div class="card-body">
                @if($options->count() > 0)
                    <div class="space-y-4">
                        @foreach($options as $option)
                        <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-lg bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $option->service->name_ar ?? __('app.service_not_found') }}</span>
                                        @if($option->service->carrier)
                                            <span class="text-sm text-gray-500 dark:text-gray-400">شركة: {{ $option->service->carrier->name_ar }}</span>
                                        @endif
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.option_type') }}: {{ $option->option_type }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.client_field') }}: {{ $option->client_field }}</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            @if($option->price_type === 'fixed')
                                                {{ __('app.price_fixed') }}: {{ number_format($option->price_fixed, 2) }}
                                            @else
                                                {{ __('app.price_percent') }}: {{ $option->price_percent }}%
                                            @endif
                                        </span>
                                        @if($option->providerMapping)
                                            <span class="text-sm text-gray-500 dark:text-gray-400">مزود: {{ $option->providerMapping->provider->name ?? 'غير محدد' }}</span>
                                        @endif
                                        @if($option->sort_order > 0)
                                            <span class="text-sm text-gray-500 dark:text-gray-400">ترتيب: {{ $option->sort_order }}</span>
                                        @endif
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $option->created_at->format('Y-m-d') }}</span>
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
                                <form action="{{ route('admin.service-options.destroy', $option) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('{{ __('app.delete_confirmation') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        {{ __('app.delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $options->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_options') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.empty_state_message') }}</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.service-options.create') }}" class="btn btn-primary">
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