@extends('layouts.app')

@section('title', __('app.edit_provider'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.edit_provider') }}: {{ $provider->name }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.edit_provider_description', ['default' => 'تعديل معلومات مزود الخدمة']) }}
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.providers.show', $provider->id) }}" 
                       class="btn btn-info">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ __('app.view_provider') }}
                    </a>
                    <a href="{{ route('admin.providers.index') }}" 
                       class="btn btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back_to_providers') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Edit Provider Form -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ __('app.provider_information') }}
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.providers.update', $provider->id) }}" method="POST" id="editProviderForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.provider_name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $provider->name) }}"
                                   class="form-input w-full @error('name') border-red-500 @enderror"
                                   placeholder="{{ __('app.enter_provider_name') }}"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.provider_type') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="type" 
                                    name="type" 
                                    class="form-select w-full @error('type') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_provider_type') }}</option>
                                @foreach(\App\Models\AppVariable::getByCategory('provider_types') as $providerType)
                                    <option value="{{ $providerType->variable_key }}" 
                                            {{ old('type', $provider->type) == $providerType->variable_key ? 'selected' : '' }}
                                            data-class="{{ $providerType->variable_value }}"
                                            data-icon="{{ $providerType->icon }}"
                                            data-color="{{ $providerType->color }}">
                                        {{ $providerType->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="provider_class" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.provider_class') }}
                            </label>
                            <select id="provider_class" 
                                    name="provider_class" 
                                    class="form-select w-full @error('provider_class') border-red-500 @enderror">
                                <option value="">{{ __('app.auto_detect_from_type') }}</option>
                                @foreach(\App\Models\AppVariable::getByCategory('provider_types') as $providerType)
                                    <option value="{{ $providerType->variable_value }}" 
                                            {{ old('provider_class', $provider->provider_class) == $providerType->variable_value ? 'selected' : '' }}>
                                        {{ $providerType->display_name }} ({{ $providerType->variable_value }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">
                                إذا تركت هذا الحقل فارغاً، سيتم تحديد الفئة تلقائياً بناءً على نوع المزود
                            </p>
                            @error('provider_class')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('app.priority') }}
                            </label>
                            <input type="number" 
                                   id="priority" 
                                   name="priority" 
                                   value="{{ old('priority', $provider->priority) }}"
                                   min="1" 
                                   max="100"
                                   class="form-input w-full @error('priority') border-red-500 @enderror">
                            @error('priority')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('app.description') }}
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  class="form-textarea w-full @error('description') border-red-500 @enderror"
                                  placeholder="{{ __('app.enter_provider_description') }}">{{ old('description', $provider->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telecom Provider Settings -->
                    <div id="telecomSettings" class="mb-6 {{ $provider->type == 'telecom' ? '' : 'hidden' }}">
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">
                            إعدادات Telecom
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="domain_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    اسم النطاق (Domain Name)
                                </label>
                                <input type="text" 
                                       id="domain_name" 
                                       name="settings[domain_name]" 
                                       value="{{ $provider->getSetting('domain_name') }}"
                                       class="form-input w-full"
                                       placeholder="api.telecom.com">
                            </div>

                            <div>
                                <label for="userid" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    معرف المستخدم (User ID)
                                </label>
                                <input type="text" 
                                       id="userid" 
                                       name="settings[userid]" 
                                       value="{{ $provider->getSetting('userid') }}"
                                       class="form-input w-full"
                                       placeholder="12345">
                            </div>

                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    اسم المستخدم (Username)
                                </label>
                                <input type="text" 
                                       id="username" 
                                       name="settings[username]" 
                                       value="{{ $provider->getSetting('username') }}"
                                       class="form-input w-full"
                                       placeholder="myuser">
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    كلمة المرور (Password)
                                </label>
                                <input type="password" 
                                       id="password" 
                                       name="settings[password]" 
                                       value="{{ $provider->getSetting('password') }}"
                                       class="form-input w-full"
                                       placeholder="mypassword">
                            </div>

                            <div>
                                <label for="webhook_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    رابط الويب هوك (Webhook URL)
                                </label>
                                <input type="url" 
                                       id="webhook_url" 
                                       name="settings[webhook_url]" 
                                       value="{{ $provider->getSetting('webhook_url') }}"
                                       class="form-input w-full"
                                       placeholder="https://yourdomain.com/webhook/telecom">
                            </div>

                            <div>
                                <label for="webhook_secret" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    سر الويب هوك (Webhook Secret)
                                </label>
                                <input type="text" 
                                       id="webhook_secret" 
                                       name="settings[webhook_secret]" 
                                       value="{{ $provider->getSetting('webhook_secret') }}"
                                       class="form-input w-full"
                                       placeholder="your_webhook_secret">
                            </div>
                        </div>
                    </div>

                    <!-- CCXT Specific Settings -->
                    <div id="ccxtSettings" class="mb-6 {{ $provider->type == 'ccxt' ? '' : 'hidden' }}">
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('app.ccxt_settings') }}
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="exchange_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.exchange_id') }}
                                </label>
                                <select id="exchange_id" 
                                        name="settings[exchange_id]" 
                                        class="form-select w-full">
                                    <option value="">{{ __('app.select_exchange') }}</option>
                                    @foreach(\App\Models\AppVariable::getByCategory('exchange_ids') as $exchange)
                                        <option value="{{ $exchange->variable_key }}" 
                                                {{ $provider->getSetting('exchange_id') == $exchange->variable_key ? 'selected' : '' }}>
                                            {{ $exchange->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="api_key" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.api_key') }}
                                </label>
                                <input type="text" 
                                       id="api_key" 
                                       name="settings[api_key]" 
                                       value="{{ $provider->getSetting('api_key') }}"
                                       class="form-input w-full"
                                       placeholder="{{ __('app.enter_api_key') }}">
                            </div>

                            <div>
                                <label for="api_secret" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.api_secret') }}
                                </label>
                                <input type="password" 
                                       id="api_secret" 
                                       name="settings[api_secret]" 
                                       value="{{ $provider->getSetting('api_secret') }}"
                                       class="form-input w-full"
                                       placeholder="{{ __('app.enter_api_secret') }}">
                            </div>

                            <div>
                                <label for="sandbox" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.sandbox_mode') }}
                                </label>
                                <select id="sandbox" 
                                        name="settings[sandbox]" 
                                        class="form-select w-full">
                                    <option value="false" {{ $provider->getSetting('sandbox') == 'false' ? 'selected' : '' }}>{{ __('app.production_mode') }}</option>
                                    <option value="true" {{ $provider->getSetting('sandbox') == 'true' ? 'selected' : '' }}>{{ __('app.sandbox_mode') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- API Provider Settings -->
                    <div id="apiSettings" class="mb-6 {{ $provider->type == 'api' ? '' : 'hidden' }}">
                        <h4 class="text-md font-medium text-gray-900 dark:text-white mb-4">
                            {{ __('app.api_settings') }}
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="api_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.api_url') }}
                                </label>
                                <input type="url" 
                                       id="api_url" 
                                       name="settings[api_url]" 
                                       value="{{ $provider->getSetting('api_url') }}"
                                       class="form-input w-full"
                                       placeholder="https://api.provider.com">
                            </div>

                            <div>
                                <label for="api_token" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.api_token') }}
                                </label>
                                <input type="text" 
                                       id="api_token" 
                                       name="settings[api_token]" 
                                       value="{{ $provider->getSetting('api_token') }}"
                                       class="form-input w-full"
                                       placeholder="{{ __('app.enter_api_token') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Status Settings -->
                    <div class="mb-6">
                        <div class="flex items-center space-x-4" :class="{ 'space-x-reverse': direction === 'rtl' }">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $provider->is_active) ? 'checked' : '' }}
                                       class="form-checkbox h-4 w-4 text-blue-600">
                                <label for="is_active" class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('app.active') }}
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="is_default" 
                                       name="is_default" 
                                       value="1"
                                       {{ old('is_default', $provider->is_default) ? 'checked' : '' }}
                                       class="form-checkbox h-4 w-4 text-blue-600">
                                <label for="is_default" class="mr-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('app.default_provider') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.providers.index') }}" 
                           class="btn btn-secondary">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit" 
                                class="btn btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('app.update_provider') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const providerClassSelect = document.getElementById('provider_class');
    const telecomSettings = document.getElementById('telecomSettings');
    const ccxtSettings = document.getElementById('ccxtSettings');
    const apiSettings = document.getElementById('apiSettings');

    function toggleSettings() {
        const selectedType = typeSelect.value;
        const selectedOption = typeSelect.options[typeSelect.selectedIndex];
        
        // تحديث provider_class تلقائياً إذا كان فارغاً
        if (selectedType && selectedOption.dataset.class && !providerClassSelect.value) {
            providerClassSelect.value = selectedOption.dataset.class;
        }
        
        // Hide all settings
        telecomSettings.classList.add('hidden');
        ccxtSettings.classList.add('hidden');
        apiSettings.classList.add('hidden');
        
        // Show relevant settings
        if (selectedType === 'telecom') {
            telecomSettings.classList.remove('hidden');
        } else if (selectedType === 'ccxt') {
            ccxtSettings.classList.remove('hidden');
        } else if (selectedType === 'api') {
            apiSettings.classList.remove('hidden');
        }
    }

    typeSelect.addEventListener('change', toggleSettings);
    toggleSettings(); // Initial call
});
</script>
@endsection 