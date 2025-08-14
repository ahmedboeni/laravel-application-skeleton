@extends('layouts.app')

@section('title', 'تفاصيل ربط الخدمة')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        تفاصيل ربط الخدمة
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        عرض تفاصيل ربط {{ $serviceProviderMapping->service->name_ar ?? 'غير محدد' }} مع {{ $serviceProviderMapping->provider->name ?? 'غير محدد' }}
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.service-provider-mappings.edit', $serviceProviderMapping) }}" class="btn btn-primary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        تعديل
                    </a>
                    <a href="{{ route('admin.service-provider-mappings.index') }}" class="btn btn-secondary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        العودة للقائمة
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Information -->
            <div class="lg:col-span-2">
                <!-- Basic Info Card -->
                <div class="card mb-6">
                    <div class="card-header">
                        <h3 class="card-title">المعلومات الأساسية</h3>
                        <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $serviceProviderMapping->is_active ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                {{ $serviceProviderMapping->is_active ? 'نشط' : 'غير نشط' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Local Service -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    الخدمة المحلية
                                </label>
                                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                    @if($serviceProviderMapping->service->image)
                                        <img src="{{ asset('storage/' . $serviceProviderMapping->service->image) }}" 
                                             alt="{{ $serviceProviderMapping->service->name_ar }}" 
                                             class="w-10 h-10 rounded-lg object-cover">
                                    @endif
                                    <div>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $serviceProviderMapping->service->name_ar ?? 'غير محدد' }}
                                        </p>
                                        @if($serviceProviderMapping->service->category)
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $serviceProviderMapping->service->category->name_ar }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Provider -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    المزود
                                </label>
                                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                    <div class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-800 flex items-center justify-center">
                                        <span class="text-primary-600 dark:text-primary-300 font-semibold text-sm">
                                            {{ strtoupper(substr($serviceProviderMapping->provider->type ?? 'P', 0, 2)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $serviceProviderMapping->provider->name ?? 'غير محدد' }}
                                        </p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $serviceProviderMapping->provider->type ?? 'غير محدد' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Provider Service Info -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    معرف خدمة المزود
                                </label>
                                <p class="text-lg font-mono text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded-lg">
                                    {{ $serviceProviderMapping->provider_service_id }}
                                </p>
                            </div>

                            <!-- Provider Service Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    اسم خدمة المزود
                                </label>
                                <p class="text-lg text-gray-900 dark:text-white">
                                    {{ $serviceProviderMapping->provider_service_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing Info Card -->
                <div class="card mb-6">
                    <div class="card-header">
                        <h3 class="card-title">معلومات التسعير</h3>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Cost Price -->
                            <div class="text-center">
                                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">سعر التكلفة</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ number_format($serviceProviderMapping->cost_price, 2) }}
                                </p>
                            </div>

                            <!-- Markup Percentage -->
                            <div class="text-center">
                                <div class="w-16 h-16 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">نسبة الربح</p>
                                <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                    {{ number_format($serviceProviderMapping->markup_percentage, 2) }}%
                                </p>
                            </div>

                            <!-- Markup Fixed -->
                            <div class="text-center">
                                <div class="w-16 h-16 bg-yellow-100 dark:bg-yellow-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">الربح الثابت</p>
                                <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                                    {{ number_format($serviceProviderMapping->markup_fixed, 2) }}
                                </p>
                            </div>

                            <!-- Final Price -->
                            <div class="text-center">
                                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-800 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">السعر النهائي</p>
                                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                                    {{ number_format($serviceProviderMapping->final_price, 2) }}
                                </p>
                            </div>
                        </div>

                        <!-- Profit Calculation -->
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">حساب الربح:</h4>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <p>السعر النهائي = سعر التكلفة + (سعر التكلفة × نسبة الربح) + الربح الثابت</p>
                                <p class="mt-1 font-mono">
                                    {{ number_format($serviceProviderMapping->final_price, 2) }} = 
                                    {{ number_format($serviceProviderMapping->cost_price, 2) }} + 
                                    ({{ number_format($serviceProviderMapping->cost_price, 2) }} × {{ $serviceProviderMapping->markup_percentage }}%) + 
                                    {{ number_format($serviceProviderMapping->markup_fixed, 2) }}
                                </p>
                                <p class="mt-2 text-green-600 dark:text-green-400 font-semibold">
                                    إجمالي الربح: {{ number_format($serviceProviderMapping->profit, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configuration Card -->
                @if($serviceProviderMapping->mapping_config)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">إعدادات الربط</h3>
                    </div>
                    <div class="card-body">
                        <pre class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg text-sm overflow-x-auto"><code>{{ json_encode($serviceProviderMapping->mapping_config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</code></pre>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Status Card -->
                <div class="card mb-6">
                    <div class="card-header">
                        <h3 class="card-title">حالة الربط</h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            <!-- Status -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">الحالة</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $serviceProviderMapping->is_active ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                    {{ $serviceProviderMapping->is_active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </div>

                            <!-- Priority -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">الأولوية</span>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= $serviceProviderMapping->priority; $i++)
                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                    <span class="mr-2 text-sm text-gray-600 dark:text-gray-400" :class="{ 'ml-2 mr-0': direction === 'rtl' }">
                                        {{ $serviceProviderMapping->priority }}/10
                                    </span>
                                </div>
                            </div>

                            <!-- Last Sync -->
                            <div>
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 block mb-1">آخر مزامنة</span>
                                <span class="text-sm text-gray-900 dark:text-white">
                                    {{ $serviceProviderMapping->last_sync_at ? $serviceProviderMapping->last_sync_at->format('Y-m-d H:i:s') : 'لم تتم مزامنة' }}
                                </span>
                            </div>

                            <!-- Created At -->
                            <div>
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 block mb-1">تاريخ الإنشاء</span>
                                <span class="text-sm text-gray-900 dark:text-white">
                                    {{ $serviceProviderMapping->created_at->format('Y-m-d H:i:s') }}
                                </span>
                            </div>

                            <!-- Updated At -->
                            <div>
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 block mb-1">آخر تحديث</span>
                                <span class="text-sm text-gray-900 dark:text-white">
                                    {{ $serviceProviderMapping->updated_at->format('Y-m-d H:i:s') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">إجراءات</h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-3">
                            <!-- Toggle Status -->
                            <button onclick="toggleStatus({{ $serviceProviderMapping->id }})" 
                                    class="w-full btn {{ $serviceProviderMapping->is_active ? 'btn-warning' : 'btn-success' }}">
                                <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4 4m4-4l-4-4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                {{ $serviceProviderMapping->is_active ? 'إلغاء التفعيل' : 'تفعيل' }}
                            </button>

                            <!-- Edit -->
                            <a href="{{ route('admin.service-provider-mappings.edit', $serviceProviderMapping) }}" 
                               class="w-full btn btn-primary">
                                <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                تعديل الربط
                            </a>

                            <!-- Delete -->
                            <button onclick="deleteMapping({{ $serviceProviderMapping->id }})" 
                                    class="w-full btn btn-danger">
                                <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                حذف الربط
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleStatus(mappingId) {
    if (!confirm('هل أنت متأكد من تغيير حالة هذا الربط؟')) {
        return;
    }

    fetch(`/admin/service-provider-mappings/${mappingId}/toggle-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('حدث خطأ: ' + data.message);
        }
    })
    .catch(error => {
        alert('حدث خطأ في الاتصال: ' + error.message);
    });
}

function deleteMapping(mappingId) {
    if (!confirm('هل أنت متأكد من حذف هذا الربط؟ لا يمكن التراجع عن هذا الإجراء.')) {
        return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/service-provider-mappings/${mappingId}`;
    
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'DELETE';
    
    form.appendChild(csrfToken);
    form.appendChild(methodInput);
    document.body.appendChild(form);
    form.submit();
}
</script>
@endsection
