@extends('layouts.app')

@section('title', __('app.payment_methods'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.payment_methods') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.manage_payment_methods_description', ['default' => 'إدارة طرق الدفع في النظام']) }}
                    </p>
                </div>
                <a href="{{ route('admin.payment-methods.create') }}" 
                   class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('app.add_payment_method') }}
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Payment Methods -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_payment_methods') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Payment Methods -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.active_payment_methods') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['active'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inactive Payment Methods -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.inactive_payment_methods') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['inactive'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($paymentMethods->count() > 0)
                @foreach($paymentMethods as $method)
                <div class="card shadow h-100">
                    <div class="card-header py-3" style="background-color: {{ $method->color }}; color: white;">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-{{ $method->icon }}"></i>
                            {{ $method->name_ar }}
                            <span class="badge bg-{{ $method->status_class }} float-start">
                                {{ $method->status_text }}
                            </span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <p class="card-text">
                                <strong>{{ __('app.name_en') }}:</strong> {{ $method->name_en ?: __('app.not_specified') }}<br>
                                <strong>{{ __('app.type') }}:</strong> {{ $method->type }}<br>
                                <strong>{{ __('app.icon') }}:</strong> {{ $method->icon ?: __('app.not_specified') }}<br>
                                <strong>{{ __('app.color') }}:</strong> 
                                <span class="badge" style="background-color: {{ $method->color }};">
                                    {{ $method->color }}
                                </span><br>
                                <strong>{{ __('app.required_fields') }}:</strong><br>
                                <small class="text-muted">
                                    @if($method->input_field_type && is_array($method->input_field_type))
                                        @foreach($method->input_field_type as $field)
                                            • {{ $method->getFieldLabel($field) }}<br>
                                        @endforeach
                                    @else
                                        {{ __('app.no_fields_required') }}
                                    @endif
                                </small>
                            </p>
                        </div>
                        
                        <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                            <a href="{{ route('admin.payment-methods.edit', $method) }}" 
                               class="btn btn-sm btn-outline-primary">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                {{ __('app.edit') }}
                            </a>
                            
                            <form action="{{ route('admin.payment-methods.toggle-status', $method) }}" 
                                  method="POST" 
                                  class="inline">
                                @csrf
                                <button type="submit" 
                                        class="btn btn-sm {{ $method->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                        onclick="return confirm('{{ $method->is_active ? __('app.confirm_deactivate') : __('app.confirm_activate') }}')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($method->is_active)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        @endif
                                    </svg>
                                    {{ $method->is_active ? __('app.deactivate') : __('app.activate') }}
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.payment-methods.destroy', $method) }}" 
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
                </div>
                @endforeach
            @else
                <div class="col-span-full">
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_payment_methods') }}</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.empty_state_message') }}</p>
                <div class="mt-6">
                            <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ __('app.add_payment_method') }}
                    </a>
                </div>
            </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 