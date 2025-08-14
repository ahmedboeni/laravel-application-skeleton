@extends('layouts.app')

@section('title', 'تعديل ربط الخدمة')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        تعديل ربط الخدمة
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        تعديل ربط {{ $serviceProviderMapping->service->name_ar ?? 'غير محدد' }} مع {{ $serviceProviderMapping->provider->name ?? 'غير محدد' }}
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
                <h3 class="card-title">تعديل معلومات الربط</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.service-provider-mappings.update', $serviceProviderMapping) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Local Service -->
                        <div class="col-span-1">
                            <label for="service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                الخدمة المحلية <span class="text-red-500">*</span>
                            </label>
                            <select name="service_id" id="service_id" 
                                    class="form-select @error('service_id') border-red-500 @enderror" required>
                                <option value="">اختر الخدمة</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" 
                                            {{ old('service_id', $serviceProviderMapping->service_id) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name_ar }}
                                        @if($service->category)
                                            - {{ $service->category->name_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
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
                                    <option value="{{ $provider->id }}" 
                                            {{ old('provider_id', $serviceProviderMapping->provider_id) == $provider->id ? 'selected' : '' }}>
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
                                   value="{{ old('provider_service_id', $serviceProviderMapping->provider_service_id) }}"
                                   class="form-input @error('provider_service_id') border-red-500 @enderror" 
                                   placeholder="مثال: service_123" required>
                            @error('provider_service_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Provider Service Name -->
                        <div class="col-span-1">
                            <label for="provider_service_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                اسم خدمة المزود <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="provider_service_name" id="provider_service_name" 
                                   value="{{ old('provider_service_name', $serviceProviderMapping->provider_service_name) }}"
                                   class="form-input @error('provider_service_name') border-red-500 @enderror" 
                                   placeholder="اسم الخدمة عند المزود" required>
                            @error('provider_service_name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cost Price -->
                        <div class="col-span-1">
                            <label for="cost_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                سعر التكلفة <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="cost_price" id="cost_price" 
                                   value="{{ old('cost_price', $serviceProviderMapping->cost_price) }}" 
                                   step="0.01" min="0"
                                   class="form-input @error('cost_price') border-red-500 @enderror" 
                                   placeholder="0.00" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">سعر الخدمة من المزود</p>
                            @error('cost_price')
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
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" 
                                            {{ old('priority', $serviceProviderMapping->priority) == $i ? 'selected' : '' }}>
                                        {{ $i }} {{ $i == 1 ? '(أولوية عالية)' : ($i == 10 ? '(أولوية منخفضة)' : '') }}
                                    </option>
                                @endfor
                            </select>
                            @error('priority')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Pricing Section -->
                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">إعدادات التسعير</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Markup Percentage -->
                            <div class="col-span-1">
                                <label for="markup_percentage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    نسبة الربح (%)
                                </label>
                                <input type="number" name="markup_percentage" id="markup_percentage" 
                                       value="{{ old('markup_percentage', $serviceProviderMapping->markup_percentage) }}" 
                                       step="0.01" min="0" max="100"
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
                                       value="{{ old('markup_fixed', $serviceProviderMapping->markup_fixed) }}" 
                                       step="0.01" min="0"
                                       class="form-input @error('markup_fixed') border-red-500 @enderror" 
                                       placeholder="0.00">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">مبلغ ثابت يُضاف للسعر</p>
                                @error('markup_fixed')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Final Price (Calculated) -->
                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    السعر النهائي
                                </label>
                                <div class="form-input bg-gray-50 dark:bg-gray-700 text-gray-500" id="final_price_display">
                                    {{ number_format($serviceProviderMapping->final_price, 2) }}
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">محسوب تلقائياً</p>
                            </div>
                        </div>
                    </div>

                    <!-- Configuration -->
                    <div class="mt-8">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">إعدادات إضافية</h4>
                        
                        <div>
                            <label for="mapping_config" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                إعدادات الربط (JSON)
                            </label>
                            <textarea name="mapping_config" id="mapping_config" rows="4"
                                      class="form-textarea @error('mapping_config') border-red-500 @enderror"
                                      placeholder='{"timeout": 30, "retry_count": 3}'>{{ old('mapping_config', $serviceProviderMapping->mapping_config ? json_encode($serviceProviderMapping->mapping_config, JSON_PRETTY_PRINT) : '') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">إعدادات إضافية بصيغة JSON (اختياري)</p>
                            @error('mapping_config')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status and Sync Info -->
                    <div class="mt-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Status -->
                            <div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                                           {{ old('is_active', $serviceProviderMapping->is_active) ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                    <label for="is_active" class="mr-2 text-sm text-gray-700 dark:text-gray-300" :class="{ 'ml-2 mr-0': direction === 'rtl' }">
                                        تفعيل الربط
                                    </label>
                                </div>
                            </div>

                            <!-- Last Sync -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    آخر مزامنة
                                </label>
                                <div class="form-input bg-gray-50 dark:bg-gray-700 text-gray-500">
                                    {{ $serviceProviderMapping->last_sync_at ? $serviceProviderMapping->last_sync_at->format('Y-m-d H:i:s') : 'لم تتم مزامنة' }}
                                </div>
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
                            تحديث الربط
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// حساب السعر النهائي تلقائياً
function calculateFinalPrice() {
    const costPrice = parseFloat(document.getElementById('cost_price').value) || 0;
    const markupPercentage = parseFloat(document.getElementById('markup_percentage').value) || 0;
    const markupFixed = parseFloat(document.getElementById('markup_fixed').value) || 0;
    
    const finalPrice = costPrice + (costPrice * markupPercentage / 100) + markupFixed;
    document.getElementById('final_price_display').textContent = finalPrice.toFixed(2);
}

// ربط الأحداث
document.getElementById('cost_price').addEventListener('input', calculateFinalPrice);
document.getElementById('markup_percentage').addEventListener('input', calculateFinalPrice);
document.getElementById('markup_fixed').addEventListener('input', calculateFinalPrice);
</script>
@endsection
