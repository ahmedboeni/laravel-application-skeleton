@extends('layouts.app')

@section('title', 'إضافة ربط جديد')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        إضافة ربط جديد
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        ربط خدمة محلية مع خدمة مزود خارجي
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.service-provider-mappings.index') }}" class="btn btn-secondary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        العودة للقائمة
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">معلومات الربط</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.service-provider-mappings.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Local Service -->
                        <div class="col-span-1">
                            <label for="local_service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                الخدمة المحلية <span class="text-red-500">*</span>
                            </label>
                            <select name="local_service_id" id="local_service_id" 
                                    class="form-select @error('local_service_id') border-red-500 @enderror" required>
                                <option value="">اختر الخدمة</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('local_service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name_ar }}
                                        @if($service->category)
                                            - {{ $service->category->name_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('local_service_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Local Service Option -->
                        <div class="col-span-1">
                            <label for="local_service_option_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                خيار الخدمة <span class="text-red-500">*</span>
                            </label>
                            <select name="local_service_option_id" id="local_service_option_id" 
                                    class="form-select @error('local_service_option_id') border-red-500 @enderror" required>
                                <option value="">اختر خيار الخدمة</option>
                                @foreach($serviceOptions as $option)
                                    <option value="{{ $option->id }}" {{ old('local_service_option_id') == $option->id ? 'selected' : '' }}>
                                        {{ $option->option_name }}
                                        @if($option->service)
                                            - {{ $option->service->name_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('local_service_option_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provider -->
                        <div class="col-span-1">
                            <label for="provider_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                المزود <span class="text-red-500">*</span>
                            </label>
                            <select name="provider_id" id="provider_id" 
                                    class="form-select @error('provider_id') border-red-500 @enderror" required>
                                <option value="">اختر المزود</option>
                                @foreach($providers as $provider)
                                    <option value="{{ $provider->id }}" {{ old('provider_id') == $provider->id ? 'selected' : '' }}>
                                        {{ $provider->name }} ({{ $provider->type }})
                                    </option>
                                @endforeach
                            </select>
                            @error('provider_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provider Service ID -->
                        <div class="col-span-1">
                            <label for="provider_service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                معرف خدمة المزود <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="provider_service_id" id="provider_service_id" 
                                   value="{{ old('provider_service_id') }}"
                                   class="form-input @error('provider_service_id') border-red-500 @enderror" 
                                   placeholder="مثال: service_123" required>
                            @error('provider_service_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provider Package ID -->
                        <div class="col-span-1">
                            <label for="provider_package_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                معرف باقة المزود
                            </label>
                            <input type="text" name="provider_package_id" id="provider_package_id" 
                                   value="{{ old('provider_package_id') }}"
                                   class="form-input @error('provider_package_id') border-red-500 @enderror" 
                                   placeholder="مثال: package_123">
                            @error('provider_package_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Base Price -->
                        <div class="col-span-1">
                            <label for="base_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                السعر الأساسي <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="base_price" id="base_price" 
                                   value="{{ old('base_price') }}" step="0.01" min="0"
                                   class="form-input @error('base_price') border-red-500 @enderror" 
                                   placeholder="0.00" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">السعر الأساسي من المزود</p>
                            @error('base_price')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Priority -->
                        <div class="col-span-1">
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                الأولوية <span class="text-red-500">*</span>
                            </label>
                            <select name="priority" id="priority" 
                                    class="form-select @error('priority') border-red-500 @enderror" required>
                                <option value="">اختر الأولوية</option>
                                @foreach(\App\Models\AppVariable::getByCategory('provider_priorities') as $priority)
                                    <option value="{{ $priority->variable_value }}" 
                                            {{ old('priority') == $priority->variable_value ? 'selected' : '' }}>
                                        {{ $priority->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('priority')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">إعدادات التسعير</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Markup Percentage -->
                            <div class="col-span-1">
                                <label for="markup_percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    نسبة الربح (%)
                                </label>
                                <input type="number" name="markup_percentage" id="markup_percentage" 
                                       value="{{ old('markup_percentage', 0) }}" step="0.01" min="0" max="100"
                                       class="form-input @error('markup_percentage') border-red-500 @enderror" 
                                       placeholder="0.00">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">النسبة المئوية للربح</p>
                                @error('markup_percentage')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Markup Fixed -->
                            <div class="col-span-1">
                                <label for="markup_fixed" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    الربح الثابت
                                </label>
                                <input type="number" name="markup_fixed" id="markup_fixed" 
                                       value="{{ old('markup_fixed', 0) }}" step="0.01" min="0"
                                       class="form-input @error('markup_fixed') border-red-500 @enderror" 
                                       placeholder="0.00">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">مبلغ ثابت يُضاف للسعر</p>
                                @error('markup_fixed')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Configuration -->
                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">إعدادات إضافية</h4>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                ربط الحقول
                            </label>
                            <div class="space-y-3">
                                <div class="flex flex-wrap gap-2">
                                    @foreach(\App\Models\AppVariable::getByCategory('field_mapping_types') as $mapping)
                                        <button type="button" 
                                                onclick="addFieldMapping('{{ $mapping->variable_key }}', '{{ $mapping->display_name }}')"
                                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            {{ $mapping->display_name }}
                                        </button>
                                    @endforeach
                                </div>
                                
                                <!-- Selected Mappings Display -->
                                <div id="selected-field-mappings" class="space-y-2 min-h-[80px] p-3 border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center">اضغط على الأزرار أعلاه لإضافة ربط الحقول</p>
                                </div>
                                
                                <!-- Custom Mapping Input -->
                                <div class="flex items-center space-x-2">
                                    <input type="text" id="custom_source_field" placeholder="الحقل المحلي" class="form-input flex-1 text-sm">
                                    <span class="text-gray-500">→</span>
                                    <input type="text" id="custom_target_field" placeholder="حقل المزود" class="form-input flex-1 text-sm">
                                    <button type="button" onclick="addCustomMapping()" class="btn btn-sm btn-secondary">
                                        إضافة
                                    </button>
                                </div>
                                
                                <!-- Hidden JSON Input -->
                                <input type="hidden" name="field_mapping" id="field_mapping" value="{{ old('field_mapping') }}">
                            </div>
                            @error('field_mapping')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status Options -->
                    <div class="mt-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Mapping Status -->
                            <div class="col-span-1">
                                <label for="mapping_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    حالة الربط
                                </label>
                                <select name="mapping_status" id="mapping_status" 
                                        class="form-select @error('mapping_status') border-red-500 @enderror">
                                    @foreach(\App\Models\AppVariable::getByCategory('mapping_statuses') as $status)
                                        <option value="{{ $status->variable_key }}" 
                                                {{ old('mapping_status', 'active') == $status->variable_key ? 'selected' : '' }}
                                                data-color="{{ $status->color }}">
                                            {{ $status->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('mapping_status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                <label for="is_active" class="mr-2 text-sm text-gray-700 dark:text-gray-300" :class="{ 'ml-2 mr-0': direction === 'rtl' }">
                                    تفعيل الربط
                                </label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" name="auto_sync" id="auto_sync" value="1" 
                                       {{ old('auto_sync', false) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                <label for="auto_sync" class="mr-2 text-sm text-gray-700 dark:text-gray-300" :class="{ 'ml-2 mr-0': direction === 'rtl' }">
                                    مزامنة تلقائية
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.service-provider-mappings.index') }}" class="btn btn-secondary">
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            إنشاء الربط
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
// متغير لتخزين ربط الحقول
let selectedFieldMappings = {};

// دالة إضافة ربط حقل محدد مسبقاً
function addFieldMapping(mappingKey, displayName) {
    // استخراج الحقول من اسم العرض
    const parts = displayName.split(' → ');
    if (parts.length === 2) {
        const sourceField = parts[0].trim();
        const targetField = parts[1].trim();
        selectedFieldMappings[sourceField] = targetField;
        updateFieldMappingsDisplay();
        updateFieldMappingInput();
    }
}

// دالة إضافة ربط مخصص
function addCustomMapping() {
    const sourceField = document.getElementById('custom_source_field').value.trim();
    const targetField = document.getElementById('custom_target_field').value.trim();
    
    if (sourceField && targetField) {
        selectedFieldMappings[sourceField] = targetField;
        updateFieldMappingsDisplay();
        updateFieldMappingInput();
        
        // مسح الحقول
        document.getElementById('custom_source_field').value = '';
        document.getElementById('custom_target_field').value = '';
    }
}

// دالة إزالة ربط حقل
function removeFieldMapping(sourceField) {
    delete selectedFieldMappings[sourceField];
    updateFieldMappingsDisplay();
    updateFieldMappingInput();
}

// تحديث عرض ربط الحقول
function updateFieldMappingsDisplay() {
    const container = document.getElementById('selected-field-mappings');
    
    if (Object.keys(selectedFieldMappings).length === 0) {
        container.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400 text-center">اضغط على الأزرار أعلاه لإضافة ربط الحقول</p>';
        return;
    }
    
    let html = '';
    for (const [sourceField, targetField] of Object.entries(selectedFieldMappings)) {
        html += `
            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <div class="flex items-center space-x-3" dir="ltr">
                    <span class="font-medium text-gray-900 dark:text-white">${sourceField}</span>
                    <span class="text-gray-500">→</span>
                    <span class="font-medium text-primary-600 dark:text-primary-400">${targetField}</span>
                </div>
                <button type="button" onclick="removeFieldMapping('${sourceField}')" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
    }
    container.innerHTML = html;
}

// تحديث الحقل المخفي
function updateFieldMappingInput() {
    document.getElementById('field_mapping').value = JSON.stringify(selectedFieldMappings);
}

// إضافة مستمع للمفتاح Enter في حقول الربط المخصص
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('custom_source_field').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('custom_target_field').focus();
        }
    });
    
    document.getElementById('custom_target_field').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addCustomMapping();
        }
    });
});
</script>
@endpush
