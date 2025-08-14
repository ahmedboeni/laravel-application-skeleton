@extends('layouts.app')

@section('title', 'إعدادات المزود - ' . $provider->name)

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-cog text-primary-600"></i>
                        إعدادات مزود: {{ $provider->name }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        إدارة إعدادات وتهيئة مزود {{ $provider->type }}
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.providers.index') }}" 
                       class="btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        العودة للمزودين
                    </a>
                    <a href="{{ route('admin.providers.config.create', $provider->id) }}" 
                       class="btn-primary">
                        <i class="fas fa-plus"></i>
                        إضافة إعداد جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- Provider Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-info-500 flex items-center justify-center">
                                <i class="fas fa-server text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">نوع المزود</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $provider->type }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md {{ $provider->is_active ? 'bg-success-500' : 'bg-danger-500' }} flex items-center justify-center">
                                <i class="fas fa-{{ $provider->is_active ? 'check' : 'times' }} text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">الحالة</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $provider->is_active ? 'نشط' : 'غير نشط' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card mb-8">
            <div class="card-body">
                <div class="flex flex-wrap gap-3">
                    <button type="button" class="btn-info" onclick="testProvider()">
                        <i class="fas fa-vial"></i>
                        اختبار الاتصال
                    </button>
                    <button type="button" class="btn-success" onclick="getBalance()">
                        <i class="fas fa-wallet"></i>
                        فحص الرصيد
                    </button>
                    <button type="button" class="btn-warning" onclick="refreshConfigs()">
                        <i class="fas fa-sync"></i>
                        تحديث الإعدادات
                    </button>
                </div>
            </div>
        </div>

        <!-- Configurations Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    <i class="fas fa-list"></i>
                    قائمة الإعدادات
                </h3>
            </div>
            <div class="card-body">
                @if(count($configs) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="configs-table">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        #
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        المفتاح
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        القيمة
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        النوع
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        مشفر
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        مطلوب
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        عام
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الإجراءات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($configs as $index => $config)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $config->config_key }}
                                            </div>
                                            @if($config->description)
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $config->description }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($config->is_encrypted)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-100 text-warning-800 dark:bg-warning-900 dark:text-warning-200">
                                                ***مشفر***
                                            </span>
                                        @else
                                            <code class="text-sm text-gray-900 dark:text-white">
                                                {{ Str::limit($config->config_value, 50) }}
                                            </code>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-info-100 text-info-800 dark:bg-info-900 dark:text-info-200">
                                            {{ $config->config_type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($config->is_encrypted)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200">
                                                نعم
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                                لا
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($config->is_required)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-danger-100 text-danger-800 dark:bg-danger-900 dark:text-danger-200">
                                                مطلوب
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                                اختياري
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($config->is_public)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200">
                                                عام
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                                خاص
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                            <a href="{{ route('admin.providers.config.edit', [$provider->id, $config->id]) }}" 
                                               class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300"
                                               title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    onclick="deleteConfig({{ $config->id }})" 
                                                    class="text-danger-600 hover:text-danger-900 dark:text-danger-400 dark:hover:text-danger-300"
                                                    title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">لا توجد إعدادات</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">لم يتم إضافة أي إعدادات لهذا المزود بعد.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.providers.config.create', $provider->id) }}" class="btn-primary">
                                <i class="fas fa-plus"></i>
                                إضافة إعداد جديد
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Result Modal -->
<div id="resultModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white" id="resultModalTitle">النتيجة</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="resultModalBody">
                <!-- المحتوى سيتم إضافته ديناميكياً -->
            </div>
            <div class="mt-4 flex justify-end">
                <button type="button" class="btn-secondary" onclick="closeModal()">
                    إغلاق
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function testProvider() {
    showLoading('جاري اختبار الاتصال...');
    
    $.post('{{ route("admin.providers.config.test", $provider->id) }}')
        .done(function(response) {
            if (response.success) {
                showResult('اختبار الاتصال', 
                    '<div class="flex items-center p-4 mb-4 text-sm text-success-800 border border-success-300 rounded-lg bg-success-50 dark:bg-success-900/30 dark:text-success-400 dark:border-success-800" role="alert"><i class="fas fa-check mr-2"></i>' + response.message + '</div>');
            } else {
                showResult('اختبار الاتصال', 
                    '<div class="flex items-center p-4 mb-4 text-sm text-danger-800 border border-danger-300 rounded-lg bg-danger-50 dark:bg-danger-900/30 dark:text-danger-400 dark:border-danger-800" role="alert"><i class="fas fa-times mr-2"></i>' + response.message + '</div>');
            }
        })
        .fail(function(xhr) {
            showResult('اختبار الاتصال', 
                '<div class="flex items-center p-4 mb-4 text-sm text-danger-800 border border-danger-300 rounded-lg bg-danger-50 dark:bg-danger-900/30 dark:text-danger-400 dark:border-danger-800" role="alert"><i class="fas fa-times mr-2"></i>خطأ في الاتصال</div>');
        });
}

function getBalance() {
    showLoading('جاري فحص الرصيد...');
    
    $.post('{{ route("admin.providers.config.balance", $provider->id) }}')
        .done(function(response) {
            if (response.success) {
                let balanceHtml = '<div class="flex items-center p-4 mb-4 text-sm text-success-800 border border-success-300 rounded-lg bg-success-50 dark:bg-success-900/30 dark:text-success-400 dark:border-success-800" role="alert">';
                balanceHtml += '<i class="fas fa-check mr-2"></i>' + response.message;
                if (response.data && response.data.balance) {
                    balanceHtml += '<br><strong class="mt-2 block">الرصيد:</strong> ' + response.data.balance + ' ' + (response.data.currency || 'YER');
                }
                balanceHtml += '</div>';
                showResult('فحص الرصيد', balanceHtml);
            } else {
                showResult('فحص الرصيد', 
                    '<div class="flex items-center p-4 mb-4 text-sm text-danger-800 border border-danger-300 rounded-lg bg-danger-50 dark:bg-danger-900/30 dark:text-danger-400 dark:border-danger-800" role="alert"><i class="fas fa-times mr-2"></i>' + response.message + '</div>');
            }
        })
        .fail(function(xhr) {
            showResult('فحص الرصيد', 
                '<div class="flex items-center p-4 mb-4 text-sm text-danger-800 border border-danger-300 rounded-lg bg-danger-50 dark:bg-danger-900/30 dark:text-danger-400 dark:border-danger-800" role="alert"><i class="fas fa-times mr-2"></i>خطأ في الاتصال</div>');
        });
}

function deleteConfig(configId) {
    if (confirm('هل أنت متأكد من حذف هذا الإعداد؟')) {
        $.ajax({
            url: '{{ route("admin.providers.config.destroy", [$provider->id, ":configId"]) }}'.replace(':configId', configId),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            }
        })
        .done(function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert('خطأ: ' + response.message);
            }
        })
        .fail(function(xhr) {
            alert('خطأ في الاتصال');
        });
    }
}

function refreshConfigs() {
    location.reload();
}

function showLoading(message) {
    $('#resultModalTitle').text('جاري التحميل...');
    $('#resultModalBody').html('<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x text-primary-600"></i><br><p class="mt-2">' + message + '</p></div>');
    $('#resultModal').removeClass('hidden');
}

function showResult(title, content) {
    $('#resultModalTitle').text(title);
    $('#resultModalBody').html(content);
    $('#resultModal').removeClass('hidden');
}

function closeModal() {
    $('#resultModal').addClass('hidden');
}

$(document).ready(function() {
    // تفعيل DataTable
    $('#configs-table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json"
        },
        "order": [[0, "asc"]],
        "pageLength": 25,
        "responsive": true
    });
});
</script>
@endpush

@push('styles')
<style>
/* Custom styles for the provider config page */
.btn-primary {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200;
}

.btn-secondary {
    @apply inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200;
}

.btn-info {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-info-600 hover:bg-info-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-info-500 transition-colors duration-200;
}

.btn-success {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-success-600 hover:bg-success-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-success-500 transition-colors duration-200;
}

.btn-warning {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-warning-600 hover:bg-warning-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-warning-500 transition-colors duration-200;
}

.card {
    @apply bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700;
}

.card-header {
    @apply px-6 py-4 border-b border-gray-200 dark:border-gray-700;
}

.card-body {
    @apply px-6 py-4;
}
</style>
@endpush 
