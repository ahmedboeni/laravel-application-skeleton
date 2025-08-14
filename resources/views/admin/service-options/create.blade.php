@extends('layouts.app')

@section('title', __('app.add_service_option'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.add_service_option') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.create_new_service_option_description', ['default' => 'إنشاء خيار خدمة جديد في النظام']) }}
                    </p>
                </div>
                <a href="{{ route('admin.service-options.index') }}" 
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
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.service_option_information') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.service-options.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Service -->
                        <div class="col-span-1">
                            <label for="service_id" class="form-label">
                                {{ __('app.service') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="service_id" 
                                    name="service_id" 
                                    class="form-select @error('service_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_service', ['default' => 'اختر الخدمة']) }}</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id', request('service_id')) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name_ar }} - {{ $service->category->name_ar ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provider Mapping -->
                        <div class="col-span-1">
                            <label for="provider_mapping_id" class="form-label">
                                {{ __('app.provider_mapping') }}
                            </label>
                            <select id="provider_mapping_id" 
                                    name="provider_mapping_id" 
                                    class="form-select @error('provider_mapping_id') border-red-500 @enderror">
                                <option value="">{{ __('app.select_provider_mapping', ['default' => 'اختر ربط المزود']) }}</option>
                                @foreach($providerMappings ?? [] as $mapping)
                                    <option value="{{ $mapping->id }}" {{ old('provider_mapping_id') == $mapping->id ? 'selected' : '' }}>
                                        {{ $mapping->service->name_ar ?? 'غير محدد' }} - {{ $mapping->provider->name ?? 'غير محدد' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provider_mapping_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Option Type -->
                        <div class="col-span-1">
                            <label for="option_type" class="form-label">
                                {{ __('app.option_type') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="option_type" 
                                   name="option_type" 
                                   value="{{ old('option_type') }}"
                                   min="1"
                                   step="1"
                                   class="form-input @error('option_type') border-red-500 @enderror"
                                   placeholder="{{ __('app.option_type_placeholder', ['default' => 'رقم الربط مع المزود']) }}"
                                   required>
                            @error('option_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Option Name -->
                        <div class="col-span-1">
                            <label for="option_name" class="form-label">
                                {{ __('app.option_name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="option_name" 
                                   name="option_name" 
                                   value="{{ old('option_name') }}"
                                   class="form-input @error('option_name') border-red-500 @enderror"
                                   placeholder="{{ __('app.option_name_placeholder', ['default' => 'مثال: شدات ببجي، جواهر فري فاير']) }}"
                                   required>
                            @error('option_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Client Field -->
                        <div class="col-span-1">
                            <label for="client_field" class="form-label">
                                {{ __('app.client_field') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="client_field" 
                                    name="client_field" 
                                    class="form-select @error('client_field') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_client_field', ['default' => 'اختر حقل العميل']) }}</option>
                                @foreach(\App\Models\AppVariable::getByCategory('client_fields') as $clientField)
                                    <option value="{{ $clientField->variable_key }}" 
                                            {{ old('client_field') == $clientField->variable_key ? 'selected' : '' }}>
                                        {{ $clientField->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client_field')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Type -->
                        <div class="col-span-1">
                            <label for="price_type" class="form-label">
                                {{ __('app.price_type') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="price_type" 
                                    name="price_type" 
                                    class="form-select @error('price_type') border-red-500 @enderror"
                                    required
                                    onchange="togglePriceFields()">
                                <option value="">{{ __('app.select_price_type', ['default' => 'اختر نوع السعر']) }}</option>
                                @foreach(\App\Models\AppVariable::getByCategory('price_types') as $priceType)
                                    <option value="{{ $priceType->variable_key }}" 
                                            {{ old('price_type') == $priceType->variable_key ? 'selected' : '' }}>
                                        {{ $priceType->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('price_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="col-span-1" id="quantity_div">
                            <label for="quantity" class="form-label">
                                {{ __('app.option_quantity') }}
                            </label>
                            <input type="text" 
                                   id="quantity" 
                                   name="quantity" 
                                   value="{{ old('quantity') }}"
                                   class="form-input @error('quantity') border-red-500 @enderror"
                                   placeholder="{{ __('app.option_quantity_placeholder', ['default' => 'مثال: 1000، 2000']) }}">
                            @error('quantity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Price Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Fixed Price -->
                        <div class="col-span-1" id="fixed_price_div">
                            <label for="price_fixed" class="form-label">
                                {{ __('app.price_fixed') }} ({{ __('app.currency') }})
                            </label>
                            <input type="number" 
                                   id="price_fixed" 
                                   name="price_fixed" 
                                   value="{{ old('price_fixed') }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input @error('price_fixed') border-red-500 @enderror"
                                   placeholder="0.00">
                            @error('price_fixed')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Percent Price -->
                        <div class="col-span-1" id="percent_price_div" style="display: none;">
                            <label for="price_percent" class="form-label">
                                {{ __('app.price_percent') }} (%)
                            </label>
                            <input type="number" 
                                   id="price_percent" 
                                   name="price_percent" 
                                   value="{{ old('price_percent') }}"
                                   step="0.01"
                                   min="0"
                                   max="100"
                                   class="form-input @error('price_percent') border-red-500 @enderror"
                                   placeholder="0.00">
                            @error('price_percent')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provider Price -->
                        <div class="col-span-1" id="provider_price_div">
                            <label for="provider_price" class="form-label">
                                {{ __('app.provider_price') }} ({{ __('app.currency') }})
                            </label>
                            <input type="number" 
                                   id="provider_price" 
                                   name="provider_price" 
                                   value="{{ old('provider_price') }}"
                                   step="0.001"
                                   min="0.001"
                                   class="form-input @error('provider_price') border-red-500 @enderror"
                                   placeholder="0.887">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                {{ __('app.provider_price_help', ['default' => 'سعر الخدمة من المزود (لحساب الربح والعمولة)']) }}
                            </p>
                            @error('provider_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Extra Info -->
                    <div class="mt-6">
                        <label for="extra_info" class="form-label">
                            {{ __('app.extra_info') }}
                        </label>
                        <input type="text" 
                               id="extra_info" 
                               name="extra_info" 
                               value="{{ old('extra_info') }}"
                               class="form-input @error('extra_info') border-red-500 @enderror"
                               placeholder="{{ __('app.extra_info_placeholder', ['default' => 'معلومات إضافية...']) }}">
                        @error('extra_info')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div class="mt-6">
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
                        <p class="text-sm text-gray-500 mt-1">ترتيب عرض الخيار (الأرقام الأصغر تظهر أولاً)</p>
                    </div>

                    <!-- Status -->
                    <div class="mt-6">
                        <label class="form-label">
                            {{ __('app.service_option_status') }}
                        </label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="form-checkbox">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    {{ __('app.service_option_active', ['default' => 'خيار الخدمة مفعل']) }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.service-options.index') }}" 
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

@push('scripts')
<script>
function togglePriceFields() {
    const type = document.getElementById('price_type').value;
    const fixedDiv = document.getElementById('fixed_price_div');
    const percentDiv = document.getElementById('percent_price_div');
    const quantityField = document.getElementById('quantity');
    const quantityDiv = document.getElementById('quantity_div');
    const providerPriceDiv = document.getElementById('provider_price_div');
    const providerPriceField = document.getElementById('provider_price');
    
    if (type === 'fixed') {
        fixedDiv.style.display = 'block';
        percentDiv.style.display = 'none';
        document.getElementById('price_fixed').required = true;
        document.getElementById('price_percent').required = false;
        // Show quantity field for fixed pricing
        if (quantityDiv) quantityDiv.style.display = 'block';
        if (quantityField) quantityField.required = true;
        // Show provider price field for fixed pricing
        if (providerPriceDiv) providerPriceDiv.style.display = 'block';
        if (providerPriceField) providerPriceField.required = true;
    } else if (type === 'percent') {
        fixedDiv.style.display = 'none';
        percentDiv.style.display = 'block';
        document.getElementById('price_fixed').required = false;
        document.getElementById('price_percent').required = true;
        // Hide quantity field for percentage pricing
        if (quantityDiv) quantityDiv.style.display = 'none';
        if (quantityField) {
            quantityField.required = false;
            quantityField.value = '';
        }
        // Hide provider price field for percentage pricing
        if (providerPriceDiv) providerPriceDiv.style.display = 'none';
        if (providerPriceField) {
            providerPriceField.required = false;
            providerPriceField.value = '';
        }
    } else {
        fixedDiv.style.display = 'none';
        percentDiv.style.display = 'none';
        document.getElementById('price_fixed').required = false;
        document.getElementById('price_percent').required = false;
        if (quantityDiv) quantityDiv.style.display = 'none';
        if (providerPriceDiv) providerPriceDiv.style.display = 'none';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', togglePriceFields);
</script>
@endpush
@endsection 