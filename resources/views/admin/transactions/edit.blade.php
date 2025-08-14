@extends('layouts.app')

@section('title', __('app.edit_transaction'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.edit_transaction') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.edit_transaction_description') }}
                    </p>
                </div>
                <a href="{{ route('admin.transactions.index') }}" 
                   class="btn btn-outline-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('app.back_to_list') }}
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.transactions.update', $transaction) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User -->
                        <div class="form-group">
                            <label for="user_id" class="form-label">
                                {{ __('app.user') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="user_id" 
                                    name="user_id" 
                                    class="form-select @error('user_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_user') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $transaction->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Amount -->
                        <div class="form-group">
                            <label for="amount" class="form-label">
                                {{ __('app.amount') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="amount" 
                                   name="amount" 
                                   value="{{ old('amount', $transaction->amount) }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input @error('amount') border-red-500 @enderror"
                                   required>
                            @error('amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Currency -->
                        <div class="form-group">
                            <label for="currency" class="form-label">
                                {{ __('app.currency') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="currency" 
                                    name="currency" 
                                    class="form-select @error('currency') border-red-500 @enderror"
                                    required>
                                <option value="USD" {{ old('currency', $transaction->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                <option value="EUR" {{ old('currency', $transaction->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                                <option value="GBP" {{ old('currency', $transaction->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                                <option value="SAR" {{ old('currency', $transaction->currency) == 'SAR' ? 'selected' : '' }}>SAR</option>
                                <option value="AED" {{ old('currency', $transaction->currency) == 'AED' ? 'selected' : '' }}>AED</option>
                            </select>
                            @error('currency')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Method -->
                        <div class="form-group">
                            <label for="payment_method_id" class="form-label">
                                {{ __('app.payment_method') }}
                            </label>
                            <select id="payment_method_id" 
                                    name="payment_method_id" 
                                    class="form-select @error('payment_method_id') border-red-500 @enderror">
                                <option value="">{{ __('app.select_payment_method') }}</option>
                                @foreach($paymentMethods as $method)
                                    <option value="{{ $method->id }}" {{ old('payment_method_id', $transaction->payment_method_id) == $method->id ? 'selected' : '' }}>
                                        {{ $method->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_method_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status" class="form-label">
                                {{ __('app.status') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="status" 
                                    name="status" 
                                    class="form-select @error('status') border-red-500 @enderror"
                                    required>
                                <option value="pending" {{ old('status', $transaction->status) == 'pending' ? 'selected' : '' }}>{{ __('app.pending') }}</option>
                                <option value="completed" {{ old('status', $transaction->status) == 'completed' ? 'selected' : '' }}>{{ __('app.completed') }}</option>
                                <option value="failed" {{ old('status', $transaction->status) == 'failed' ? 'selected' : '' }}>{{ __('app.failed') }}</option>
                                <option value="cancelled" {{ old('status', $transaction->status) == 'cancelled' ? 'selected' : '' }}>{{ __('app.cancelled') }}</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Payment Data -->
                    <div class="form-group mt-6">
                        <label for="payment_data" class="form-label">
                            {{ __('app.payment_data') }}
                        </label>
                        <textarea id="payment_data" 
                                  name="payment_data" 
                                  rows="4"
                                  class="form-textarea @error('payment_data') border-red-500 @enderror"
                                  placeholder="{{ __('app.payment_data_placeholder') }}">{{ old('payment_data', is_array($transaction->payment_data) ? json_encode($transaction->payment_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $transaction->payment_data) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">{{ __('app.payment_data_help') }}</p>
                        @error('payment_data')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.transactions.index') }}" 
                           class="btn btn-outline-secondary">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('app.update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 