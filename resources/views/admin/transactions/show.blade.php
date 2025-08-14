@extends('layouts.app')

@section('title', __('app.transaction_details'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.transaction_details') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.transaction_information') }}
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.transactions.edit', $transaction) }}" 
                       class="btn btn-outline-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        {{ __('app.edit') }}
                    </a>
                    <a href="{{ route('admin.transactions.index') }}" 
                       class="btn btn-outline-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Transaction Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ __('app.transaction_information') }}
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
                                            {{ __('app.transaction_id') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            #{{ $transaction->id }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.user') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $transaction->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $transaction->user->email }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.amount') }}
                                        </label>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">
                                            {{ $transaction->formatted_amount }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.currency') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $transaction->currency }}
                                        </p>
                                    </div>
                                    
                                    @if($transaction->paymentMethod)
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.payment_method') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $transaction->paymentMethod->name_ar }}
                                        </p>
                                    </div>
                                    @endif
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
                                            {{ __('app.status') }}
                                        </label>
                                        <div class="mt-1">
                                            <span class="badge bg-{{ $transaction->status_class }}">
                                                {{ $transaction->status_text }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.created_at') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $transaction->formatted_date }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('app.updated_at') }}
                                        </label>
                                        <p class="text-sm text-gray-900 dark:text-white mt-1">
                                            {{ $transaction->updated_at->format('Y-m-d H:i:s') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Data -->
                @if($transaction->payment_data)
                <div class="card mt-6">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ __('app.payment_data') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                            <pre class="text-sm text-gray-900 dark:text-white whitespace-pre-wrap">{{ is_array($transaction->payment_data) ? json_encode($transaction->payment_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $transaction->payment_data }}</pre>
                        </div>
                    </div>
                </div>
                @endif
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
                            <a href="{{ route('admin.transactions.edit', $transaction) }}" 
                               class="btn btn-outline-primary w-full">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                {{ __('app.edit_transaction') }}
                            </a>
                            
                            <form action="{{ route('admin.transactions.destroy', $transaction) }}" 
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
                
                <!-- User Information -->
                <div class="card mt-6">
                    <div class="card-header">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ __('app.user_information') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-3">
                            <div>
                                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ __('app.name') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-white">
                                    {{ $transaction->user->name }}
                                </p>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ __('app.email') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-white">
                                    {{ $transaction->user->email }}
                                </p>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    {{ __('app.balance') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-white">
                                    ${{ number_format($transaction->user->balance, 2) }}
                                </p>
                            </div>
                            
                            <div class="pt-3">
                                <a href="{{ route('admin.users.show', $transaction->user) }}" 
                                   class="btn btn-outline-primary w-full">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ __('app.view_user_profile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 