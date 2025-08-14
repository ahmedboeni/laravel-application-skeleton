@extends('layouts.app')

@section('title', __('app.carrier_details'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.carrier_details') }}: {{ $carrier->name_ar }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.carrier_details_description') }}
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.carriers.edit', $carrier) }}" class="btn btn-primary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('app.edit_carrier') }}
                    </a>
                    <a href="{{ route('admin.carriers.index') }}" class="btn btn-secondary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back_to_carriers') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Carrier Information -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Basic Information -->
            <div class="lg:col-span-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.basic_information') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Arabic -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('app.name_arabic') }}
                                </label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $carrier->name_ar }}
                                </p>
                            </div>

                            <!-- Name English -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('app.name_english') }}
                                </label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $carrier->name_en ?: __('app.not_specified') }}
                                </p>
                            </div>

                            <!-- Service Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('app.service_type') }}
                                </label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $carrier->service_type }}
                                </span>
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('app.status') }}
                                </label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $carrier->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ $carrier->is_active ? __('app.active') : __('app.inactive') }}
                                </span>
                            </div>

                            <!-- Sort Order -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('app.sort_order') }}
                                </label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $carrier->sort_order }}
                                </p>
                            </div>

                            <!-- Created At -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('app.created_at') }}
                                </label>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $carrier->created_at->format('Y-m-d H:i:s') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Configuration -->
                <div class="card mt-6">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.tabs_configuration') }}</h3>
                    </div>
                    <div class="card-body">
                        @if(count($carrier->tabs) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($carrier->tabs as $tab)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        {{ $tab }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">{{ __('app.no_tabs_configured') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Prefixes Configuration -->
                <div class="card mt-6">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.prefixes_configuration') }}</h3>
                    </div>
                    <div class="card-body">
                        @if(count($carrier->prefixes) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($carrier->prefixes as $prefix)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        {{ $prefix }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">{{ __('app.no_prefixes_configured') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Carrier Logo & Color -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.carrier_identity') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            @if($carrier->logo_url)
                                <img src="{{ $carrier->logo_url }}" alt="{{ $carrier->name_ar }}" 
                                     class="mx-auto h-24 w-24 rounded-lg object-cover mb-4">
                            @else
                                <div class="mx-auto h-24 w-24 rounded-lg flex items-center justify-center mb-4" 
                                     style="background-color: {{ $carrier->color }}">
                                    <span class="text-white text-2xl font-bold">{{ substr($carrier->name_ar, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <div class="flex items-center justify-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                <div class="h-6 w-6 rounded border border-gray-300" style="background-color: {{ $carrier->color }}"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $carrier->color }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.quick_actions') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-3">
                            <a href="{{ route('admin.carriers.edit', $carrier) }}" class="btn btn-primary w-full">
                                <svg class="w-4 h-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                {{ __('app.edit_carrier') }}
                            </a>
                            
                            <form action="{{ route('admin.carriers.toggle-status', $carrier) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="btn btn-warning w-full">
                                    <svg class="w-4 h-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $carrier->is_active ? __('app.deactivate_carrier') : __('app.activate_carrier') }}
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.carriers.destroy', $carrier) }}" method="POST" class="w-full" onsubmit="return confirm('{{ __('app.confirm_delete_carrier') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-full">
                                    <svg class="w-4 h-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    {{ __('app.delete_carrier') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Carrier Statistics -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('app.carrier_statistics') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('app.total_tabs') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ count($carrier->tabs) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('app.total_prefixes') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ count($carrier->prefixes) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('app.last_updated') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $carrier->updated_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
