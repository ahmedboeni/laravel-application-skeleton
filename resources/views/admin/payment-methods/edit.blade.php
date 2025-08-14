@extends('layouts.app')

@section('title', __('app.edit_payment_method'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.edit_payment_method') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.edit_payment_method_description') }}
                    </p>
                </div>
                <a href="{{ route('admin.payment-methods.index') }}" 
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
                <form action="{{ route('admin.payment-methods.update', $paymentMethod) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name in Arabic -->
                        <div class="form-group">
                            <label for="name_ar" class="form-label">
                                {{ __('app.payment_method_name_ar') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name_ar" 
                                   name="name_ar" 
                                   value="{{ old('name_ar', $paymentMethod->name_ar) }}"
                                   class="form-input @error('name_ar') border-red-500 @enderror"
                                   required>
                            @error('name_ar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name in English -->
                        <div class="form-group">
                            <label for="name_en" class="form-label">
                                {{ __('app.payment_method_name_en') }}
                            </label>
                            <input type="text" 
                                   id="name_en" 
                                   name="name_en" 
                                   value="{{ old('name_en', $paymentMethod->name_en) }}"
                                   class="form-input @error('name_en') border-red-500 @enderror">
                            @error('name_en')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="form-group">
                            <label for="type" class="form-label">
                                {{ __('app.payment_method_type') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="type" 
                                    name="type" 
                                    class="form-select @error('type') border-red-500 @enderror"
                                    required>
                                <option value="visa" {{ old('type', $paymentMethod->type) == 'visa' ? 'selected' : '' }}>فيزا</option>
                                <option value="mastercard" {{ old('type', $paymentMethod->type) == 'mastercard' ? 'selected' : '' }}>ماستركارد</option>
                                <option value="bank" {{ old('type', $paymentMethod->type) == 'bank' ? 'selected' : '' }}>تحويل بنكي</option>
                                <option value="cash" {{ old('type', $paymentMethod->type) == 'cash' ? 'selected' : '' }}>نقدية</option>
                                <option value="crypto" {{ old('type', $paymentMethod->type) == 'crypto' ? 'selected' : '' }}>كريبتو</option>
                                <option value="mobile" {{ old('type', $paymentMethod->type) == 'mobile' ? 'selected' : '' }}>دفع عبر الهاتف</option>
                                <option value="paypal" {{ old('type', $paymentMethod->type) == 'paypal' ? 'selected' : '' }}>باي بال</option>
                                <option value="wallet" {{ old('type', $paymentMethod->type) == 'wallet' ? 'selected' : '' }}>محفظة رقمية</option>
                                <option value="gift" {{ old('type', $paymentMethod->type) == 'gift' ? 'selected' : '' }}>بطاقة هدايا</option>
                                <option value="digital" {{ old('type', $paymentMethod->type) == 'digital' ? 'selected' : '' }}>نقود إلكترونية</option>
                                <option value="other" {{ old('type', $paymentMethod->type) == 'other' ? 'selected' : '' }}>أخرى</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div class="form-group">
                            <label for="icon" class="form-label">
                                {{ __('app.payment_method_icon') }}
                            </label>
                            <input type="text" 
                                   id="icon" 
                                   name="icon" 
                                   value="{{ old('icon', $paymentMethod->icon) }}"
                                   class="form-input @error('icon') border-red-500 @enderror"
                                   placeholder="مثال: credit-card, university, bitcoin">
                            @error('icon')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div class="form-group">
                            <label for="color" class="form-label">
                                {{ __('app.payment_method_color') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="color" 
                                   id="color" 
                                   name="color" 
                                   value="{{ old('color', $paymentMethod->color) }}"
                                   class="form-input h-12 @error('color') border-red-500 @enderror"
                                   required>
                            @error('color')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="form-group mt-6">
                        <label class="form-label">{{ __('app.payment_method_input_fields') }}</label>
                        <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-800">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @php
                                    $currentFields = old('input_field_type', $paymentMethod->input_field_type ?? ['none']);
                                    if (!is_array($currentFields)) {
                                        $currentFields = ['none'];
                                    }
                                @endphp
                                
                                <!-- No Fields Required -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="none" 
                                           id="field_none" 
                                           {{ in_array('none', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_none">
                                        <i class="fas fa-times text-muted"></i> {{ __('app.no_fields_required') }}
                                    </label>
                                </div>

                                <!-- Sender Name -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="sender_name" 
                                           id="field_sender_name"
                                           {{ in_array('sender_name', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_sender_name">
                                        <i class="fas fa-user text-info"></i> {{ __('app.sender_name') }}
                                    </label>
                                </div>

                                <!-- Sender Phone -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="sender_phone" 
                                           id="field_sender_phone"
                                           {{ in_array('sender_phone', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_sender_phone">
                                        <i class="fas fa-phone text-success"></i> {{ __('app.sender_phone') }}
                                    </label>
                                </div>

                                <!-- Card Number -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="card_number" 
                                           id="field_card_number"
                                           {{ in_array('card_number', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_card_number">
                                        <i class="fas fa-credit-card text-primary"></i> {{ __('app.card_number') }}
                                    </label>
                                </div>

                                <!-- Bank Name -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="bank_name" 
                                           id="field_bank_name"
                                           {{ in_array('bank_name', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_bank_name">
                                        <i class="fas fa-university text-primary"></i> {{ __('app.bank_name') }}
                                    </label>
                                </div>

                                <!-- Account Number -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="account_number" 
                                           id="field_account_number"
                                           {{ in_array('account_number', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_account_number">
                                        <i class="fas fa-hashtag text-info"></i> {{ __('app.account_number') }}
                                    </label>
                                </div>

                                <!-- Transaction ID -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="transaction_id" 
                                           id="field_transaction_id"
                                           {{ in_array('transaction_id', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_transaction_id">
                                        <i class="fas fa-receipt text-warning"></i> {{ __('app.transaction_id') }}
                                    </label>
                                </div>

                                <!-- Wallet Address -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="wallet_address" 
                                           id="field_wallet_address"
                                           {{ in_array('wallet_address', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_wallet_address">
                                        <i class="fab fa-bitcoin text-warning"></i> {{ __('app.wallet_address') }}
                                    </label>
                                </div>

                                <!-- Mobile Number -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="mobile_number" 
                                           id="field_mobile_number"
                                           {{ in_array('mobile_number', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_mobile_number">
                                        <i class="fas fa-mobile-alt text-success"></i> {{ __('app.mobile_number') }}
                                    </label>
                                </div>

                                <!-- Amount -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="amount" 
                                           id="field_amount"
                                           {{ in_array('amount', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_amount">
                                        <i class="fas fa-dollar-sign text-success"></i> {{ __('app.amount') }}
                                    </label>
                                </div>

                                <!-- Receipt Upload -->
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="input_field_type[]" 
                                           value="receipt_upload" 
                                           id="field_receipt_upload"
                                           {{ in_array('receipt_upload', $currentFields) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="field_receipt_upload">
                                        <i class="fas fa-upload text-purple-500"></i> {{ __('app.receipt_upload') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('input_field_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="form-group mt-6">
                        <div class="form-check">
                            <input type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', $paymentMethod->is_active) ? 'checked' : '' }}
                                   class="form-check-input">
                            <label class="form-check-label" for="is_active">
                                {{ __('app.active') }}
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.payment-methods.index') }}" 
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle checkbox interactions
    const noneCheckbox = document.getElementById('field_none');
    const otherCheckboxes = document.querySelectorAll('input[name="input_field_type[]"]:not([value="none"])');
    
    if (noneCheckbox) {
        noneCheckbox.addEventListener('change', function() {
            if (this.checked) {
                otherCheckboxes.forEach(cb => cb.checked = false);
            }
        });
    }
    
    otherCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked && noneCheckbox) {
                noneCheckbox.checked = false;
            }
        });
    });
});
</script>
@endsection 