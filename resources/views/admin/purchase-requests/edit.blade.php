@extends('layouts.app')

@section('title', __('app.edit_purchase_request'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.edit_purchase_request') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.edit_purchase_request_description') }}
                    </p>
                </div>
                <a href="{{ route('admin.purchase-requests.index') }}" 
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
                <form action="{{ route('admin.purchase-requests.update', $purchaseRequest) }}" method="POST">
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
                                    <option value="{{ $user->id }}" {{ old('user_id', $purchaseRequest->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service -->
                        <div class="form-group">
                            <label for="service_id" class="form-label">
                                {{ __('app.service') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="service_id" 
                                    name="service_id" 
                                    class="form-select @error('service_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_service') }}</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id', $purchaseRequest->service_id) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Option -->
                        <div class="form-group">
                            <label for="service_option_id" class="form-label">
                                {{ __('app.service_option') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="service_option_id" 
                                    name="service_option_id" 
                                    class="form-select @error('service_option_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_service_option') }}</option>
                                @foreach($serviceOptions as $option)
                                    <option value="{{ $option->id }}" 
                                            data-service="{{ $option->service_id }}"
                                            {{ old('service_option_id', $purchaseRequest->service_option_id) == $option->id ? 'selected' : '' }}>
                                        {{ $option->option_name }} - {{ $option->service->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_option_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Amount USD -->
                        <div class="form-group">
                            <label for="amount_usd" class="form-label">
                                {{ __('app.amount_usd') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="amount_usd" 
                                   name="amount_usd" 
                                   value="{{ old('amount_usd', $purchaseRequest->amount_usd) }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input @error('amount_usd') border-red-500 @enderror"
                                   required>
                            @error('amount_usd')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Identifier -->
                        <div class="form-group">
                            <label for="identifier" class="form-label">
                                {{ __('app.identifier') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="identifier" 
                                   name="identifier" 
                                   value="{{ old('identifier', $purchaseRequest->identifier) }}"
                                   class="form-input @error('identifier') border-red-500 @enderror"
                                   required>
                            @error('identifier')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Extra Info -->
                        <div class="form-group">
                            <label for="extra_info" class="form-label">
                                {{ __('app.extra_info') }}
                            </label>
                            <input type="text" 
                                   id="extra_info" 
                                   name="extra_info" 
                                   value="{{ old('extra_info', $purchaseRequest->extra_info) }}"
                                   class="form-input @error('extra_info') border-red-500 @enderror">
                            @error('extra_info')
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
                                <option value="pending" {{ old('status', $purchaseRequest->status) == 'pending' ? 'selected' : '' }}>{{ __('app.pending') }}</option>
                                <option value="approved" {{ old('status', $purchaseRequest->status) == 'approved' ? 'selected' : '' }}>{{ __('app.approved') }}</option>
                                <option value="rejected" {{ old('status', $purchaseRequest->status) == 'rejected' ? 'selected' : '' }}>{{ __('app.rejected') }}</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Provider Actions Section -->
                    @if($purchaseRequest->status === 'pending')
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-8">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                            إجراءات المزود
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- إعادة إرسال الطلب -->
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                                <h4 class="font-medium text-blue-900 dark:text-blue-100 mb-2">
                                    إعادة إرسال الطلب للمزود
                                </h4>
                                <p class="text-sm text-blue-700 dark:text-blue-300 mb-3">
                                    إعادة إرسال الطلب المعلق إلى المزود
                                </p>
                                <button type="button" 
                                        onclick="resubmitOrder({{ $purchaseRequest->id }})"
                                        class="btn btn-primary btn-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    إعادة إرسال الطلب
                                </button>
                            </div>
                            
                            <!-- عرض استجابة المزود -->
                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                                <h4 class="font-medium text-green-900 dark:text-green-100 mb-2">
                                    عرض استجابة المزود
                                </h4>
                                <p class="text-sm text-green-700 dark:text-green-300 mb-3">
                                    عرض آخر استجابة من المزود لهذا الطلب
                                </p>
                                <button type="button" 
                                        onclick="getProviderResponse({{ $purchaseRequest->id }})"
                                        class="btn btn-success btn-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    عرض الاستجابة
                                </button>
                            </div>
                        </div>
                        
                        <!-- Provider Response Display -->
                        <div id="providerResponseDisplay" class="mt-4 hidden">
                            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">
                                    استجابة المزود
                                </h4>
                                <div id="providerResponseContent" class="text-sm text-gray-700 dark:text-gray-300">
                                    <!-- سيتم ملء هذا القسم بالبيانات -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.purchase-requests.index') }}" 
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
    const serviceSelect = document.getElementById('service_id');
    const serviceOptionSelect = document.getElementById('service_option_id');
    const serviceOptions = @json($serviceOptions);
    
    // Filter service options based on selected service
    serviceSelect.addEventListener('change', function() {
        const selectedServiceId = this.value;
        serviceOptionSelect.innerHTML = '<option value="">{{ __('app.select_service_option') }}</option>';
        
        if (selectedServiceId) {
            serviceOptions.forEach(option => {
                if (option.service_id == selectedServiceId) {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.id;
                    optionElement.textContent = option.option_name + ' - ' + option.service.name_ar;
                    serviceOptionSelect.appendChild(optionElement);
                }
            });
        }
    });
});

// دالة إعادة إرسال الطلب
function resubmitOrder(orderId) {
    if (!confirm('هل أنت متأكد من إعادة إرسال هذا الطلب للمزود؟')) {
        return;
    }
    
    // إظهار مؤشر التحميل
    const button = event.target.closest('button');
    const originalText = button.innerHTML;
    button.innerHTML = '<svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>جاري الإرسال...';
    button.disabled = true;
    
    fetch('{{ route("admin.providers.resubmit-order") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            order_id: orderId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // إظهار رسالة النجاح
            showAlert('success', data.message);
            
            // تحديث الصفحة بعد ثانيتين
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            // إظهار رسالة الخطأ
            showAlert('error', data.message);
            
            // إظهار استجابة المزود إذا كانت متوفرة
            if (data.provider_response) {
                showProviderResponse(data.provider_response);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'حدث خطأ أثناء إعادة إرسال الطلب');
    })
    .finally(() => {
        // إعادة الزر إلى حالته الأصلية
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

// دالة عرض استجابة المزود
function getProviderResponse(orderId) {
    fetch('{{ route("admin.providers.get-provider-response") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            order_id: orderId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showProviderResponse(data.provider_response);
        } else {
            showAlert('error', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'حدث خطأ أثناء جلب استجابة المزود');
    });
}

// دالة عرض استجابة المزود في الواجهة
function showProviderResponse(response) {
    const display = document.getElementById('providerResponseDisplay');
    const content = document.getElementById('providerResponseContent');
    
    if (response) {
        let html = '<div class="space-y-2">';
        
        // عرض البيانات الأساسية
        if (response.success !== undefined) {
            html += `<p><strong>الحالة:</strong> <span class="${response.success ? 'text-green-600' : 'text-red-600'}">${response.success ? 'نجح' : 'فشل'}</span></p>`;
        }
        
        if (response.message) {
            html += `<p><strong>الرسالة:</strong> ${response.message}</p>`;
        }
        
        if (response.data) {
            html += '<p><strong>البيانات:</strong></p>';
            html += '<pre class="bg-gray-100 dark:bg-gray-700 p-2 rounded text-xs overflow-x-auto">' + JSON.stringify(response.data, null, 2) + '</pre>';
        }
        
        // عرض البيانات الكاملة إذا لم تكن البيانات الأساسية متوفرة
        if (!response.success && !response.message && !response.data) {
            html += '<pre class="bg-gray-100 dark:bg-gray-700 p-2 rounded text-xs overflow-x-auto">' + JSON.stringify(response, null, 2) + '</pre>';
        }
        
        html += '</div>';
        content.innerHTML = html;
        display.classList.remove('hidden');
    } else {
        content.innerHTML = '<p class="text-gray-500">لا توجد استجابة من المزود</p>';
        display.classList.remove('hidden');
    }
}

// دالة إظهار التنبيهات
function showAlert(type, message) {
    // إنشاء عنصر التنبيه
    const alert = document.createElement('div');
    alert.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    alert.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${type === 'success' ? 'M5 13l4 4L19 7' : 'M6 18L18 6M6 6l12 12'}"></path>
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    // إضافة التنبيه للصفحة
    document.body.appendChild(alert);
    
    // إزالة التنبيه بعد 5 ثوان
    setTimeout(() => {
        alert.remove();
    }, 5000);
}
</script>
@endsection 