@extends('layouts.app')

@section('title', __('app.payment_method_details'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.payment_method_details') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.payment_method_information') }}
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.payment-methods.edit', $paymentMethod) }}" 
                       class="btn btn-outline-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('app.edit') }}
                    </a>
                    <a href="{{ route('admin.payment-methods.index') }}" 
                       class="btn btn-outline-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Payment Method Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2">
                <div class="card">
                    <div class="card-header" style="background-color: {{ $paymentMethod->color }}; color: white;">
                        <h3 class="text-lg font-semibold">
                            <i class="fas fa-{{ $paymentMethod->icon }}"></i>
                            {{ $paymentMethod->name_ar }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                    {{ __('app.basic_information') }}
                                </h4>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.payment_method_name_ar') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $paymentMethod->name_ar }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.payment_method_name_en') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $paymentMethod->name_en ?: __('app.not_specified') }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.payment_method_type') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $paymentMethod->type }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.payment_method_icon') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            <i class="fas fa-{{ $paymentMethod->icon }}"></i>
                                            {{ $paymentMethod->icon ?: __('app.not_specified') }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.payment_method_color') }}
                                        </label>
                                        <div class="flex items-center mt-1">
                                            <div class="w-6 h-6 rounded border mr-2" style="background-color: {{ $paymentMethod->color }};"></div>
                                            <span class="text-sm text-gray-900 dark:text-white">{{ $paymentMethod->color }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Status Information -->
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                    {{ __('app.status_information') }}
                                </h4>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.payment_method_status') }}
                                        </label>
                                        <div class="mt-1">
                                            <span class="badge bg-{{ $paymentMethod->status_class }}">
                                                {{ $paymentMethod->status_text }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.created_at') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $paymentMethod->created_at->format('Y-m-d H:i:s') }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.updated_at') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $paymentMethod->updated_at->format('Y-m-d H:i:s') }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.sort_order') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $paymentMethod->sort_order }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Required Fields -->
                <div class="card mt-6">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ __('app.payment_method_input_fields') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($paymentMethod->input_field_type && is_array($paymentMethod->input_field_type) && count($paymentMethod->input_field_type) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($paymentMethod->input_field_type as $field)
                                    <div class="flex items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                        <div class="flex-shrink-0">
                                            @switch($field)
                                                @case('none')
                                                    <i class="fas fa-times text-muted"></i>
                                                    @break
                                                @case('sender_name')
                                                    <i class="fas fa-user text-info"></i>
                                                    @break
                                                @case('sender_phone')
                                                    <i class="fas fa-phone text-success"></i>
                                                    @break
                                                @case('card_number')
                                                    <i class="fas fa-credit-card text-primary"></i>
                                                    @break
                                                @case('bank_name')
                                                    <i class="fas fa-university text-primary"></i>
                                                    @break
                                                @case('account_number')
                                                    <i class="fas fa-hashtag text-info"></i>
                                                    @break
                                                @case('transaction_id')
                                                    <i class="fas fa-receipt text-warning"></i>
                                                    @break
                                                @case('wallet_address')
                                                    <i class="fab fa-bitcoin text-warning"></i>
                                                    @break
                                                @case('mobile_number')
                                                    <i class="fas fa-mobile-alt text-success"></i>
                                                    @break
                                                @case('amount')
                                                    <i class="fas fa-dollar-sign text-success"></i>
                                                    @break
                                                @case('receipt_upload')
                                                    <i class="fas fa-upload text-purple-500"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-tag text-gray-500"></i>
                                            @endswitch
                                        </div>
                                        <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $paymentMethod->getFieldLabel($field) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-times text-gray-400 text-4xl mb-4"></i>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ __('app.no_fields_required') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ __('app.quick_actions') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-3">
                            <a href="{{ route('admin.payment-methods.edit', $paymentMethod) }}" 
                               class="btn btn-outline-primary w-full">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                {{ __('app.edit_payment_method') }}
                            </a>
                            
                            <form action="{{ route('admin.payment-methods.toggle-status', $paymentMethod) }}" 
                                  method="POST" 
                                  class="inline w-full">
                                @csrf
                                <button type="submit" 
                                        class="btn w-full {{ $paymentMethod->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                        onclick="return confirm('{{ $paymentMethod->is_active ? __('app.confirm_deactivate') : __('app.confirm_activate') }}')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($paymentMethod->is_active)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        @endif
                                    </svg>
                                    {{ $paymentMethod->is_active ? __('app.deactivate') : __('app.activate') }}
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.payment-methods.destroy', $paymentMethod) }}" 
                                  method="POST" 
                                  class="inline w-full"
                                  onsubmit="return confirm('{{ __('app.delete_confirmation') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-full">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    {{ __('app.delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Related Transactions -->
                <div class="card mt-6">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ __('app.related_transactions') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        @php
                            $transactions = $paymentMethod->transactions()->latest()->take(5)->get();
                        @endphp
                        
                        @if($transactions->count() > 0)
                            <div class="space-y-3">
                                @foreach($transactions as $transaction)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $transaction->user->name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $transaction->formatted_amount }}
                                            </p>
                                        </div>
                                        <span class="badge bg-{{ $transaction->status_class }}">
                                            {{ $transaction->status_text }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if($paymentMethod->transactions()->count() > 5)
                                <div class="mt-4 text-center">
                                    <a href="{{ route('admin.transactions.index') }}?payment_method={{ $paymentMethod->id }}" 
                                       class="text-sm text-primary-600 hover:text-primary-500">
                                        {{ __('app.view_all_transactions') }}
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-receipt text-gray-400 text-2xl mb-2"></i>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('app.no_related_transactions') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 