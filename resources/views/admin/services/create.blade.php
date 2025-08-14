@extends('layouts.app')

@section('title', __('app.add_service'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.add_service') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.create_new_service_description', ['default' => 'إنشاء خدمة جديدة في النظام']) }}
                    </p>
                </div>
                <a href="{{ route('admin.services.index') }}" 
                   class="btn btn-outline-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('app.back') }}
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.service_information') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Arabic Name -->
                        <div class="col-span-1">
                            <label for="name_ar" class="form-label">
                                {{ __('app.service_name_ar') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name_ar" 
                                   name="name_ar" 
                                   value="{{ old('name_ar') }}"
                                   class="form-input @error('name_ar') border-red-500 @enderror"
                                   placeholder="{{ __('app.service_name_ar_placeholder', ['default' => 'اسم الخدمة بالعربية']) }}"
                                   required>
                            @error('name_ar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- English Name -->
                        <div class="col-span-1">
                            <label for="name_en" class="form-label">
                                {{ __('app.service_name_en') }}
                            </label>
                            <input type="text" 
                                   id="name_en" 
                                   name="name_en" 
                                   value="{{ old('name_en') }}"
                                   class="form-input @error('name_en') border-red-500 @enderror"
                                   placeholder="{{ __('app.service_name_en_placeholder', ['default' => 'Service name in English']) }}">
                            @error('name_en')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-span-1">
                            <label for="category_id" class="form-label">
                                {{ __('app.service_category') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="category_id" 
                                    name="category_id" 
                                    class="form-select @error('category_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_category', ['default' => 'اختر الفئة']) }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="col-span-1">
                            <label for="type" class="form-label">
                                {{ __('app.service_type') }}
                            </label>
                            <input type="text" 
                                   id="type" 
                                   name="type" 
                                   value="{{ old('type') }}"
                                   class="form-input @error('type') border-red-500 @enderror"
                                   placeholder="{{ __('app.service_type_placeholder', ['default' => 'مثال: UC, Diamonds, etc.']) }}">
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="col-span-1">
                            <label for="price" class="form-label">
                                {{ __('app.service_price') }}
                            </label>
                            <input type="number" 
                                   id="price" 
                                   name="price" 
                                   value="{{ old('price', 0) }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input @error('price') border-red-500 @enderror"
                                   placeholder="0.00">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image URL -->
                        <div class="col-span-1">
                            <label for="image" class="form-label">
                                {{ __('app.service_image') }}
                            </label>
                            <input type="url" 
                                   id="image" 
                                   name="image" 
                                   value="{{ old('image') }}"
                                   class="form-input @error('image') border-red-500 @enderror"
                                   placeholder="https://example.com/image.png">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-1">
                            <label class="form-label">
                                {{ __('app.service_status') }}
                            </label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" 
                                           name="is_active" 
                                           value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}
                                           class="form-checkbox">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                        {{ __('app.service_active') }}
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Carrier -->
                        <div class="col-span-1">
                            <label for="carrier_id" class="form-label">
                                {{ __('app.service_carrier') }}
                            </label>
                            <select id="carrier_id" 
                                    name="carrier_id" 
                                    class="form-select @error('carrier_id') border-red-500 @enderror">
                                <option value="">{{ __('app.select_carrier', ['default' => 'اختر الشركة']) }}</option>
                                @foreach($carriers ?? [] as $carrier)
                                    <option value="{{ $carrier->id }}" {{ old('carrier_id') == $carrier->id ? 'selected' : '' }}>
                                        {{ $carrier->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrier_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Type -->
                        <div class="col-span-1">
                            <label for="service_type" class="form-label">
                                {{ __('app.service_type_category') }}
                            </label>
                            <select id="service_type" 
                                    name="service_type" 
                                    class="form-select @error('service_type') border-red-500 @enderror">
                                <option value="">{{ __('app.select_service_type') }}</option>
                                @foreach(\App\Models\AppVariable::getByCategory('service_types') as $serviceType)
                                    <option value="{{ $serviceType->variable_key }}" 
                                            {{ old('service_type') == $serviceType->variable_key ? 'selected' : '' }}
                                            data-icon="{{ $serviceType->icon }}"
                                            data-color="{{ $serviceType->color }}">
                                        {{ $serviceType->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Min Amount -->
                        <div class="col-span-1">
                            <label for="min_amount" class="form-label">
                                {{ __('app.min_amount') }}
                            </label>
                            <input type="number" 
                                   id="min_amount" 
                                   name="min_amount" 
                                   value="{{ old('min_amount', 0) }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input @error('min_amount') border-red-500 @enderror"
                                   placeholder="0.00">
                            @error('min_amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Max Amount -->
                        <div class="col-span-1">
                            <label for="max_amount" class="form-label">
                                {{ __('app.max_amount') }}
                            </label>
                            <input type="number" 
                                   id="max_amount" 
                                   name="max_amount" 
                                   value="{{ old('max_amount', 0) }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input @error('max_amount') border-red-500 @enderror"
                                   placeholder="0.00">
                            @error('max_amount')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div class="col-span-1">
                            <label for="sort_order" class="form-label">
                                {{ __('app.sort_order') }}
                            </label>
                            <input type="number" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', 0) }}"
                                   min="0"
                                   class="form-input @error('sort_order') border-red-500 @enderror"
                                   placeholder="0">
                            @error('sort_order')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Client Fields -->
                    <div class="mt-6">
                        <label class="form-label">
                            {{ __('app.client_fields') }}
                        </label>
                        <div class="space-y-3">
                            <div class="flex flex-wrap gap-2">
                                @foreach(\App\Models\AppVariable::getByCategory('common_client_fields') as $field)
                                    @php
                                        $fieldData = json_decode($field->variable_value, true);
                                    @endphp
                                    <button type="button" 
                                            onclick="addClientField('{{ $field->variable_key }}', '{{ $field->display_name }}', '{{ $fieldData['type'] ?? 'text' }}', {{ $fieldData['required'] ? 'true' : 'false' }})"
                                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        {{ $field->display_name }}
                                    </button>
                                @endforeach
                            </div>
                            
                            <!-- Selected Fields Display -->
                            <div id="selected-client-fields" class="space-y-2 min-h-[100px] p-3 border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600">
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center">اضغط على الأزرار أعلاه لإضافة الحقول المطلوبة</p>
                            </div>
                            
                            <!-- Hidden JSON Input -->
                            <input type="hidden" id="client_fields" name="client_fields" value="{{ old('client_fields') }}">
                        </div>
                        @error('client_fields')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Metadata -->
                    <div class="mt-6">
                        <label class="form-label">
                            {{ __('app.metadata') }}
                        </label>
                        <div class="space-y-4">
                            <!-- Tags Section -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العلامات (Tags)</label>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach(\App\Models\AppVariable::getByCategory('service_tags') as $tag)
                                        <button type="button" 
                                                onclick="toggleTag('{{ $tag->variable_key }}', '{{ $tag->display_name }}', '{{ $tag->color }}')"
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border"
                                                style="color: {{ $tag->color }}; border-color: {{ $tag->color }};"
                                                data-tag="{{ $tag->variable_key }}">
                                            {{ $tag->display_name }}
                                        </button>
                                    @endforeach
                                </div>
                                <div id="selected-tags" class="flex flex-wrap gap-1"></div>
                            </div>

                            <!-- Features Section -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الميزات (Features)</label>
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach(\App\Models\AppVariable::getByCategory('service_features') as $feature)
                                        <button type="button" 
                                                onclick="toggleFeature('{{ $feature->variable_key }}', '{{ $feature->display_name }}')"
                                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700"
                                                data-feature="{{ $feature->variable_key }}">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            {{ $feature->display_name }}
                                        </button>
                                    @endforeach
                                </div>
                                <div id="selected-features" class="flex flex-wrap gap-1"></div>
                            </div>

                            <!-- Notes Section -->
                            <div>
                                <label for="metadata_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ملاحظات</label>
                                <textarea id="metadata_notes" 
                                          rows="2"
                                          class="form-textarea"
                                          placeholder="ملاحظات إضافية عن الخدمة..."></textarea>
                            </div>
                            
                            <!-- Hidden JSON Input -->
                            <input type="hidden" id="metadata" name="metadata" value="{{ old('metadata') }}">
                        </div>
                        @error('metadata')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label for="description" class="form-label">
                            {{ __('app.service_description') }}
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="form-textarea @error('description') border-red-500 @enderror"
                                  placeholder="{{ __('app.service_description_placeholder', ['default' => 'وصف الخدمة...']) }}">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.services.index') }}" 
                           class="btn btn-outline-secondary">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('app.save') }}
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
// متغيرات لتخزين البيانات المختارة
let selectedClientFields = {};
let selectedTags = [];
let selectedFeatures = [];

// دالة إضافة حقل عميل
function addClientField(key, label, type, required) {
    selectedClientFields[key] = {
        label: label,
        type: type,
        required: required
    };
    updateClientFieldsDisplay();
    updateClientFieldsInput();
}

// دالة إزالة حقل عميل
function removeClientField(key) {
    delete selectedClientFields[key];
    updateClientFieldsDisplay();
    updateClientFieldsInput();
}

// تحديث عرض الحقول المختارة
function updateClientFieldsDisplay() {
    const container = document.getElementById('selected-client-fields');
    
    if (Object.keys(selectedClientFields).length === 0) {
        container.innerHTML = '<p class="text-sm text-gray-500 dark:text-gray-400 text-center">اضغط على الأزرار أعلاه لإضافة الحقول المطلوبة</p>';
        return;
    }
    
    let html = '';
    for (const [key, field] of Object.entries(selectedClientFields)) {
        html += `
            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <div class="flex items-center space-x-3" dir="ltr">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${field.required ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200'}">
                        ${field.required ? 'مطلوب' : 'اختياري'}
                    </span>
                    <span class="font-medium text-gray-900 dark:text-white">${field.label}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">(${field.type})</span>
                </div>
                <button type="button" onclick="removeClientField('${key}')" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;
    }
    container.innerHTML = html;
}

// تحديث الحقل المخفي للـ JSON
function updateClientFieldsInput() {
    document.getElementById('client_fields').value = JSON.stringify(selectedClientFields);
}

// دالة تبديل العلامة
function toggleTag(key, label, color) {
    const index = selectedTags.findIndex(tag => tag.key === key);
    
    if (index > -1) {
        selectedTags.splice(index, 1);
        document.querySelector(`[data-tag="${key}"]`).style.backgroundColor = '';
    } else {
        selectedTags.push({ key, label, color });
        document.querySelector(`[data-tag="${key}"]`).style.backgroundColor = color + '20';
    }
    
    updateTagsDisplay();
    updateMetadataInput();
}

// دالة تبديل الميزة
function toggleFeature(key, label) {
    const index = selectedFeatures.findIndex(feature => feature.key === key);
    const button = document.querySelector(`[data-feature="${key}"]`);
    
    if (index > -1) {
        selectedFeatures.splice(index, 1);
        button.classList.remove('bg-primary-100', 'text-primary-800', 'border-primary-300');
        button.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
    } else {
        selectedFeatures.push({ key, label });
        button.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
        button.classList.add('bg-primary-100', 'text-primary-800', 'border-primary-300');
    }
    
    updateFeaturesDisplay();
    updateMetadataInput();
}

// تحديث عرض العلامات المختارة
function updateTagsDisplay() {
    const container = document.getElementById('selected-tags');
    let html = '';
    
    selectedTags.forEach(tag => {
        html += `
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white" style="background-color: ${tag.color};">
                ${tag.label}
            </span>
        `;
    });
    
    container.innerHTML = html;
}

// تحديث عرض الميزات المختارة
function updateFeaturesDisplay() {
    const container = document.getElementById('selected-features');
    let html = '';
    
    selectedFeatures.forEach(feature => {
        html += `
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                ${feature.label}
            </span>
        `;
    });
    
    container.innerHTML = html;
}

// تحديث حقل الـ metadata المخفي
function updateMetadataInput() {
    const notes = document.getElementById('metadata_notes').value;
    const metadata = {
        tags: selectedTags.map(tag => tag.key),
        features: selectedFeatures.map(feature => feature.key),
        notes: notes
    };
    
    document.getElementById('metadata').value = JSON.stringify(metadata);
}

// مراقبة تغيير الملاحظات
document.addEventListener('DOMContentLoaded', function() {
    const notesField = document.getElementById('metadata_notes');
    if (notesField) {
        notesField.addEventListener('input', updateMetadataInput);
    }
});
</script>
@endpush 