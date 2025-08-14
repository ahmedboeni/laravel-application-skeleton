@extends('layouts.app')

@section('title', 'تعديل العرض التسويقي')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        تعديل العرض التسويقي
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        تعديل معلومات العرض التسويقي
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.marketing-offers.show', $offer->id) }}" class="btn btn-secondary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        عرض التفاصيل
                    </a>
                    <a href="{{ route('admin.marketing-offers.index') }}" class="btn btn-secondary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        العودة للقائمة
                    </a>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">معلومات العرض</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.marketing-offers.update', $offer->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                عنوان العرض <span class="text-danger-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $offer->title) }}" 
                                   class="form-input" placeholder="أدخل عنوان العرض" required>
                            @error('title')
                                <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                كود الخصم (اختياري)
                            </label>
                            <input type="text" name="code" id="code" value="{{ old('code', $offer->code) }}" 
                                   class="form-input" placeholder="مثال: SUMMER2024">
                            @error('code')
                                <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            وصف العرض <span class="text-danger-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="3" 
                                  class="form-textarea" placeholder="أدخل وصف العرض" required>{{ old('description', $offer->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            رابط الصورة (اختياري)
                        </label>
                        <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $offer->image_url) }}" 
                               class="form-input" placeholder="https://example.com/image.jpg">
                        @error('image_url')
                            <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Discount Settings -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">إعدادات الخصم</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="discount_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    نوع الخصم <span class="text-danger-500">*</span>
                                </label>
                                <select name="discount_type" id="discount_type" class="form-select" required onchange="toggleDiscountFields()">
                                    <option value="">اختر نوع الخصم</option>
                                    <option value="percentage" {{ old('discount_type', $offer->discount_type) == 'percentage' ? 'selected' : '' }}>نسبة مئوية</option>
                                    <option value="fixed" {{ old('discount_type', $offer->discount_type) == 'fixed' ? 'selected' : '' }}>مبلغ ثابت</option>
                                    <option value="both" {{ old('discount_type', $offer->discount_type) == 'both' ? 'selected' : '' }}>كلاهما</option>
                                </select>
                                @error('discount_type')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="percentage_field" class="discount-field" style="display: none;">
                                <label for="discount_percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    نسبة الخصم (%)
                                </label>
                                <input type="number" name="discount_percentage" id="discount_percentage" 
                                       value="{{ old('discount_percentage', $offer->discount_percentage) }}" class="form-input" 
                                       placeholder="0.00" step="0.01" min="0" max="100">
                                @error('discount_percentage')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="fixed_field" class="discount-field" style="display: none;">
                                <label for="discount_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    مبلغ الخصم
                                </label>
                                <input type="number" name="discount_amount" id="discount_amount" 
                                       value="{{ old('discount_amount', $offer->discount_amount) }}" class="form-input" 
                                       placeholder="0.00" step="0.01" min="0">
                                @error('discount_amount')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label for="min_purchase_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    الحد الأدنى للشراء <span class="text-danger-500">*</span>
                                </label>
                                <input type="number" name="min_purchase_amount" id="min_purchase_amount" 
                                       value="{{ old('min_purchase_amount', $offer->min_purchase_amount) }}" class="form-input" 
                                       placeholder="0.00" step="0.01" min="0" required>
                                @error('min_purchase_amount')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="max_discount_amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    الحد الأقصى للخصم (اختياري)
                                </label>
                                <input type="number" name="max_discount_amount" id="max_discount_amount" 
                                       value="{{ old('max_discount_amount', $offer->max_discount_amount) }}" class="form-input" 
                                       placeholder="0.00" step="0.01" min="0">
                                @error('max_discount_amount')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Usage Settings -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">إعدادات الاستخدام</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="usage_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    حد الاستخدام (اختياري)
                                </label>
                                <input type="number" name="usage_limit" id="usage_limit" 
                                       value="{{ old('usage_limit', $offer->usage_limit) }}" class="form-input" 
                                       placeholder="عدد المرات" min="1">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">اتركه فارغاً للاستخدام غير المحدود</p>
                                @error('usage_limit')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    حالة العرض
                                </label>
                                <select name="is_active" id="is_active" class="form-select">
                                    <option value="1" {{ old('is_active', $offer->is_active) == '1' ? 'selected' : '' }}>نشط</option>
                                    <option value="0" {{ old('is_active', $offer->is_active) == '0' ? 'selected' : '' }}>غير نشط</option>
                                </select>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Validity Period -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">فترة الصلاحية</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="valid_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    تاريخ بداية الصلاحية (اختياري)
                                </label>
                                <input type="datetime-local" name="valid_from" id="valid_from" 
                                       value="{{ old('valid_from', $offer->valid_from ? $offer->valid_from->format('Y-m-d\TH:i') : '') }}" class="form-input">
                                @error('valid_from')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="valid_until" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    تاريخ انتهاء الصلاحية (اختياري)
                                </label>
                                <input type="datetime-local" name="valid_until" id="valid_until" 
                                       value="{{ old('valid_until', $offer->valid_until ? $offer->valid_until->format('Y-m-d\TH:i') : '') }}" class="form-input">
                                @error('valid_until')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Applicability Settings -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">إعدادات التطبيق</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="applicable_categories" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    الفئات المطبقة (اختياري)
                                </label>
                                <select name="applicable_categories[]" id="applicable_categories" class="form-select" multiple>
                                    @foreach($categories ?? [] as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ in_array($category->id, old('applicable_categories', $offer->applicable_categories ?? [])) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">اتركه فارغاً لجميع الفئات</p>
                                @error('applicable_categories')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="excluded_services" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    الخدمات المستثناة (اختياري)
                                </label>
                                <select name="excluded_services[]" id="excluded_services" class="form-select" multiple>
                                    @foreach($services ?? [] as $service)
                                        <option value="{{ $service->id }}" 
                                                {{ in_array($service->id, old('excluded_services', $offer->excluded_services ?? [])) ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">الخدمات التي لا ينطبق عليها العرض</p>
                                @error('excluded_services')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit" class="btn btn-primary">
                            <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            حفظ التعديلات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleDiscountFields() {
    const discountType = document.getElementById('discount_type').value;
    const percentageField = document.getElementById('percentage_field');
    const fixedField = document.getElementById('fixed_field');
    
    // Hide all fields first
    percentageField.style.display = 'none';
    fixedField.style.display = 'none';
    
    // Show relevant fields based on selection
    if (discountType === 'percentage' || discountType === 'both') {
        percentageField.style.display = 'block';
    }
    
    if (discountType === 'fixed' || discountType === 'both') {
        fixedField.style.display = 'block';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleDiscountFields();
});
</script>
@endpush 