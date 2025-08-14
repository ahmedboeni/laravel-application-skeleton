@extends('layouts.app')

@section('title', __('app.edit_carrier'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.edit_carrier') }}: {{ $carrier->name_ar }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.edit_carrier_description') }}
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.carriers.show', $carrier) }}" class="btn btn-secondary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ __('app.view_carrier') }}
                    </a>
                    <a href="{{ route('admin.carriers.index') }}" class="btn btn-secondary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back_to_carriers') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('app.carrier_information') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.carriers.update', $carrier) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="space-y-6">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.basic_information') }}</h4>
                            
                            <!-- Name Arabic -->
                            <div>
                                <label for="name_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.name_arabic') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $carrier->name_ar) }}" 
                                       class="form-input w-full @error('name_ar') border-red-500 @enderror" 
                                       placeholder="{{ __('app.enter_arabic_name') }}" required>
                                @error('name_ar')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Name English -->
                            <div>
                                <label for="name_en" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.name_english') }}
                                </label>
                                <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $carrier->name_en) }}" 
                                       class="form-input w-full @error('name_en') border-red-500 @enderror" 
                                       placeholder="{{ __('app.enter_english_name') }}">
                                @error('name_en')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Service Type -->
                            <div>
                                <label for="service_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.service_type') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="service_type" id="service_type" value="{{ old('service_type', $carrier->service_type) }}" 
                                       class="form-input w-full @error('service_type') border-red-500 @enderror" 
                                       placeholder="{{ __('app.enter_service_type') }}" required>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.service_type_help') }}</p>
                                @error('service_type')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Color -->
                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.color') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                    <input type="color" name="color" id="color" value="{{ old('color', $carrier->color) }}" 
                                           class="h-10 w-20 rounded border border-gray-300 dark:border-gray-600">
                                    <input type="text" value="{{ old('color', $carrier->color) }}" 
                                           class="form-input flex-1 @error('color') border-red-500 @enderror" 
                                           placeholder="#007bff" onchange="document.getElementById('color').value = this.value">
                                </div>
                                @error('color')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Logo URL -->
                            <div>
                                <label for="logo_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.logo_url') }}
                                </label>
                                <input type="url" name="logo_url" id="logo_url" value="{{ old('logo_url', $carrier->logo_url) }}" 
                                       class="form-input w-full @error('logo_url') border-red-500 @enderror" 
                                       placeholder="{{ __('app.enter_logo_url') }}">
                                @if($carrier->logo_url)
                                    <div class="mt-2">
                                        <img src="{{ $carrier->logo_url }}" alt="{{ $carrier->name_ar }}" class="h-12 w-12 rounded object-cover">
                                    </div>
                                @endif
                                @error('logo_url')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Configuration -->
                        <div class="space-y-6">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.configuration') }}</h4>
                            
                            <!-- Available Tabs -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.available_tabs') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="space-y-2">
                                    @php
                                        $defaultTabs = ['فحص الرصيد', 'شحن الرصيد', 'الباقات', 'العروض', 'سداد الفواتير'];
                                        
                                        // تحويل available_tabs من مصفوفة معقدة إلى مصفوفة بسيطة
                                        $carrierTabs = [];
                                        if ($carrier->available_tabs) {
                                            foreach ($carrier->available_tabs as $tab) {
                                                if (is_array($tab) && isset($tab['key'])) {
                                                    $carrierTabs[] = $tab['key'];
                                                } else {
                                                    $carrierTabs[] = $tab;
                                                }
                                            }
                                        }
                                        
                                        $selectedTabs = old('available_tabs', $carrierTabs);
                                    @endphp
                                    @foreach($defaultTabs as $tab)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="available_tabs[]" value="{{ $tab }}" 
                                                   {{ in_array($tab, $selectedTabs) ? 'checked' : '' }}
                                                   class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                            <span class="mr-2" :class="{ 'ml-2 mr-0': direction === 'rtl' }">{{ $tab }}</span>
                                        </label>
                                    @endforeach
                                    @if($carrier->available_tabs)
                                        @foreach($carrier->available_tabs as $tab)
                                            @if(!in_array($tab['key'], $defaultTabs))
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="available_tabs[]" value="{{ $tab['key'] }}" 
                                                           {{ in_array($tab['key'], $selectedTabs) ? 'checked' : '' }}
                                                           class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                                    <span class="mr-2" :class="{ 'ml-2 mr-0': direction === 'rtl' }">{{ $tab['name_ar'] }}</span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">(تبويب مخصص)</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="mt-2">
                                        <input type="text" id="custom_tab" 
                                               class="form-input w-full" 
                                               placeholder="{{ __('app.add_custom_tab') }}"
                                               onkeypress="addCustomTab(event)">
                                    </div>
                                </div>
                                @error('available_tabs')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- API Configuration -->
                            <div>
                                <label for="api_config" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.api_configuration') }}
                                </label>
                                <textarea name="api_config" id="api_config" rows="4" 
                                          class="form-input w-full @error('api_config') border-red-500 @enderror" 
                                          placeholder='{"timeout": 30, "retry_count": 3, "base_url": ""}'>{{ old('api_config', json_encode($carrier->api_config ?? [], JSON_PRETTY_PRINT)) }}</textarea>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">إعدادات API للشركة بصيغة JSON</p>
                                @error('api_config')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Validation Rules -->
                            <div>
                                <label for="validation_rules" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.validation_rules') }}
                                </label>
                                <textarea name="validation_rules" id="validation_rules" rows="4" 
                                          class="form-input w-full @error('validation_rules') border-red-500 @enderror" 
                                          placeholder='{"phone": {"min_length": 9, "max_length": 9}, "amount": {"min": 100, "max": 10000}}'>{{ old('validation_rules', json_encode($carrier->validation_rules ?? [], JSON_PRETTY_PRINT)) }}</textarea>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">قواعد التحقق من البيانات بصيغة JSON</p>
                                @error('validation_rules')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Prefixes -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.prefixes') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="space-y-2">
                                    @php
                                        $defaultPrefixes = ['77', '71', '70', '73', '78'];
                                        
                                        // تحويل prefixes من مصفوفة معقدة إلى مصفوفة بسيطة
                                        $carrierPrefixes = [];
                                        if ($carrier->prefixes) {
                                            foreach ($carrier->prefixes as $prefix) {
                                                if (is_array($prefix) && isset($prefix['key'])) {
                                                    $carrierPrefixes[] = $prefix['key'];
                                                } else {
                                                    $carrierPrefixes[] = $prefix;
                                                }
                                            }
                                        }
                                        
                                        $selectedPrefixes = old('prefixes', $carrierPrefixes);
                                    @endphp
                                    @foreach($defaultPrefixes as $prefix)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="prefixes[]" value="{{ $prefix }}" 
                                                   {{ in_array($prefix, $selectedPrefixes) ? 'checked' : '' }}
                                                   class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                            <span class="mr-2" :class="{ 'ml-2 mr-0': direction === 'rtl' }">{{ $prefix }}</span>
                                        </label>
                                    @endforeach
                                    @if($carrier->prefixes)
                                        @foreach($carrier->prefixes as $prefix)
                                            @if(!in_array($prefix, $defaultPrefixes))
                                                <label class="flex items-center">
                                                    <input type="checkbox" name="prefixes[]" value="{{ $prefix }}" 
                                                           {{ in_array($prefix, $selectedPrefixes) ? 'checked' : '' }}
                                                           class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                                    <span class="mr-2" :class="{ 'ml-2 mr-0': direction === 'rtl' }">{{ $prefix }}</span>
                                                </label>
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="mt-2">
                                        <input type="text" id="custom_prefix" 
                                               class="form-input w-full" 
                                               placeholder="{{ __('app.add_custom_prefix') }}"
                                               onkeypress="addCustomPrefix(event)">
                                    </div>
                                </div>
                                @error('prefixes')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Sort Order -->
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.sort_order') }}
                                </label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $carrier->sort_order) }}" 
                                       class="form-input w-full @error('sort_order') border-red-500 @enderror" 
                                       min="0" placeholder="0">
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1" 
                                           {{ old('is_active', $carrier->is_active) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                    <span class="mr-2" :class="{ 'ml-2 mr-0': direction === 'rtl' }">{{ __('app.is_active') }}</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.carriers.index') }}" class="btn btn-secondary">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('app.update_carrier') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function addCustomTab(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        const input = event.target;
        const value = input.value.trim();
        
        if (value) {
            const container = input.parentElement.parentElement;
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'tabs[]';
            checkbox.value = value;
            checkbox.checked = true;
            checkbox.className = 'rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50';
            
            const label = document.createElement('label');
            label.className = 'flex items-center';
            label.appendChild(checkbox);
            
            const span = document.createElement('span');
            span.className = 'mr-2';
            span.textContent = value;
            label.appendChild(span);
            
            container.insertBefore(label, input.parentElement);
            input.value = '';
        }
    }
}

function addCustomPrefix(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        const input = event.target;
        const value = input.value.trim();
        
        if (value) {
            const container = input.parentElement.parentElement;
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'prefixes[]';
            checkbox.value = value;
            checkbox.checked = true;
            checkbox.className = 'rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50';
            
            const label = document.createElement('label');
            label.className = 'flex items-center';
            label.appendChild(checkbox);
            
            const span = document.createElement('span');
            span.className = 'mr-2';
            span.textContent = value;
            label.appendChild(span);
            
            container.insertBefore(label, input.parentElement);
            input.value = '';
        }
    }
}
</script>
@endsection
