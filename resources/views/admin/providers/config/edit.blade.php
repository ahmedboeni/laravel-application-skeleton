@extends('layouts.app')

@section('title', 'تعديل الإعداد - ' . $config->config_key)

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-edit text-primary-600"></i>
                        تعديل الإعداد
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        تعديل إعداد {{ $config->config_key }} لمزود {{ $provider->name }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.providers.config.index', $provider->id) }}" 
                       class="btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        العودة للإعدادات
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    <i class="fas fa-cog"></i>
                    تفاصيل الإعداد
                </h3>
            </div>
            <div class="card-body">
                <form id="configForm" method="POST" action="{{ route('admin.providers.config.update', [$provider->id, $config->id]) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="config_key" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                مفتاح الإعداد
                            </label>
                            <input type="text" 
                                   class="form-input w-full bg-gray-100 dark:bg-gray-700" 
                                   id="config_key" 
                                   value="{{ $config->config_key }}" 
                                   readonly disabled>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">لا يمكن تعديل مفتاح الإعداد</p>
                        </div>
                        
                        <div>
                            <label for="config_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                نوع البيانات <span class="text-danger-600">*</span>
                            </label>
                            <select class="form-select w-full @error('config_type') border-danger-500 @enderror" 
                                    id="config_type" 
                                    name="config_type" 
                                    required>
                                <option value="">اختر النوع</option>
                                <option value="string" {{ old('config_type', $config->config_type) == 'string' ? 'selected' : '' }}>نص</option>
                                <option value="integer" {{ old('config_type', $config->config_type) == 'integer' ? 'selected' : '' }}>رقم صحيح</option>
                                <option value="boolean" {{ old('config_type', $config->config_type) == 'boolean' ? 'selected' : '' }}>صح/خطأ</option>
                                <option value="json" {{ old('config_type', $config->config_type) == 'json' ? 'selected' : '' }}>JSON</option>
                            </select>
                            @error('config_type')
                                <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="config_value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            قيمة الإعداد <span class="text-danger-600">*</span>
                        </label>
                        @if($config->is_encrypted)
                            <div class="mb-3 p-4 bg-warning-50 dark:bg-warning-900/30 border border-warning-200 dark:border-warning-800 rounded-md">
                                <div class="flex">
                                    <i class="fas fa-lock text-warning-600 mt-0.5"></i>
                                    <div class="mr-3">
                                        <p class="text-sm text-warning-800 dark:text-warning-200">
                                            هذه القيمة مشفرة. أدخل القيمة الجديدة لتحديثها.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <textarea class="form-textarea w-full @error('config_value') border-danger-500 @enderror" 
                                  id="config_value" 
                                  name="config_value" 
                                  rows="3" 
                                  placeholder="أدخل قيمة الإعداد" 
                                  required>{{ old('config_value') }}</textarea>
                        @error('config_value')
                            <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                        @enderror
                        @if($config->is_encrypted)
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">القيمة الحالية مشفرة. أدخل القيمة الجديدة لتحديثها.</p>
                        @endif
                    </div>
                    
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            الوصف
                        </label>
                        <textarea class="form-textarea w-full @error('description') border-danger-500 @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="2" 
                                  placeholder="وصف مختصر للإعداد">{{ old('description', $config->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   class="form-checkbox h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" 
                                   id="is_encrypted" 
                                   name="is_encrypted" 
                                   value="1" 
                                   {{ old('is_encrypted', $config->is_encrypted) ? 'checked' : '' }}>
                            <label for="is_encrypted" class="mr-2 block text-sm text-gray-900 dark:text-gray-300">
                                تشفير القيمة
                            </label>
                            <p class="text-xs text-gray-500 dark:text-gray-400">يُنصح بتشفير كلمات المرور والمفاتيح الحساسة</p>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   class="form-checkbox h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" 
                                   id="is_required" 
                                   name="is_required" 
                                   value="1" 
                                   {{ old('is_required', $config->is_required) ? 'checked' : '' }}>
                            <label for="is_required" class="mr-2 block text-sm text-gray-900 dark:text-gray-300">
                                إعداد مطلوب
                            </label>
                            <p class="text-xs text-gray-500 dark:text-gray-400">الإعدادات المطلوبة للمزود للعمل بشكل صحيح</p>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   class="form-checkbox h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" 
                                   id="is_public" 
                                   name="is_public" 
                                   value="1" 
                                   {{ old('is_public', $config->is_public) ? 'checked' : '' }}>
                            <label for="is_public" class="mr-2 block text-sm text-gray-900 dark:text-gray-300">
                                إعداد عام
                            </label>
                            <p class="text-xs text-gray-500 dark:text-gray-400">الإعدادات العامة يمكن عرضها للمستخدمين</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save"></i>
                            حفظ التغييرات
                        </button>
                        <a href="{{ route('admin.providers.config.index', $provider->id) }}" class="btn-secondary">
                            <i class="fas fa-times"></i>
                            إلغاء
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#configForm').on('submit', function(e) {
        e.preventDefault();
        
        // التحقق من صحة البيانات
        if (!$('#config_value').val()) {
            alert('يرجى إدخال قيمة الإعداد');
            return;
        }
        
        if (!$('#config_type').val()) {
            alert('يرجى اختيار نوع البيانات');
            return;
        }
        
        // إرسال النموذج
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    alert('تم تحديث الإعداد بنجاح');
                    window.location.href = '{{ route("admin.providers.config.index", $provider->id) }}';
                } else {
                    alert('خطأ: ' + response.message);
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = 'يرجى تصحيح الأخطاء التالية:\n';
                    for (let field in errors) {
                        errorMessage += '- ' + errors[field][0] + '\n';
                    }
                    alert(errorMessage);
                } else {
                    alert('خطأ في الاتصال');
                }
            }
        });
    });
});
</script>
@endpush

@push('styles')
<style>
/* Custom styles for the edit config page */
.btn-primary {
    @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200;
}

.btn-secondary {
    @apply inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200;
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

.form-input, .form-select, .form-textarea {
    @apply block w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:text-white;
}

.form-checkbox {
    @apply h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded;
}
</style>
@endpush
