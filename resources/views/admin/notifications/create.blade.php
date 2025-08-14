@extends('layouts.app')

@section('title', 'إرسال إشعار جديد')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        إرسال إشعار جديد
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        إرسال إشعارات للمستخدمين
                    </p>
                </div>
                <div>
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        العودة للقائمة
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="-mb-px flex space-x-8" :class="{ 'space-x-reverse': direction === 'rtl' }" aria-label="Tabs">
                    <button onclick="showTab('single')" id="tab-single" class="tab-button active">
                        إرسال لمستخدم واحد
                    </button>
                    <button onclick="showTab('multiple')" id="tab-multiple" class="tab-button">
                        إرسال لمستخدمين محددين
                    </button>
                    <button onclick="showTab('all')" id="tab-all" class="tab-button">
                        إرسال لجميع المستخدمين
                    </button>
                    <button onclick="showTab('criteria')" id="tab-criteria" class="tab-button">
                        إرسال حسب معايير
                    </button>
                </nav>
            </div>
        </div>

        <!-- Single User Form -->
        <div id="tab-content-single" class="tab-content">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">إرسال إشعار لمستخدم واحد</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.notifications.send-to-user') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    المستخدم <span class="text-danger-500">*</span>
                                </label>
                                <select name="user_id" id="user_id" class="form-select" required>
                                    <option value="">اختر المستخدم</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    نوع الإشعار <span class="text-danger-500">*</span>
                                </label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="">اختر النوع</option>
                                    <option value="marketing" {{ old('type') == 'marketing' ? 'selected' : '' }}>تسويقي</option>
                                    <option value="system" {{ old('type') == 'system' ? 'selected' : '' }}>نظام</option>
                                    <option value="balance" {{ old('type') == 'balance' ? 'selected' : '' }}>رصيد</option>
                                    <option value="purchase" {{ old('type') == 'purchase' ? 'selected' : '' }}>شراء</option>
                                    <option value="security" {{ old('type') == 'security' ? 'selected' : '' }}>أمان</option>
                                    <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>عام</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                عنوان الإشعار <span class="text-danger-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                   class="form-input" placeholder="أدخل عنوان الإشعار" required>
                            @error('title')
                                <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                محتوى الإشعار <span class="text-danger-500">*</span>
                            </label>
                            <textarea name="message" id="message" rows="4" 
                                      class="form-textarea" placeholder="أدخل محتوى الإشعار" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    رابط الصورة (اختياري)
                                </label>
                                <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}" 
                                       class="form-input" placeholder="https://example.com/image.jpg">
                                @error('image_url')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="expires_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    تاريخ انتهاء الصلاحية (اختياري)
                                </label>
                                <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at') }}" 
                                       class="form-input">
                                @error('expires_at')
                                    <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                إرسال الإشعار
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Multiple Users Form -->
        <div id="tab-content-multiple" class="tab-content hidden">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">إرسال إشعار لمستخدمين محددين</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.notifications.send-to-specific') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                اختيار المستخدمين <span class="text-danger-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-60 overflow-y-auto border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                @foreach($users as $user)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" 
                                               class="form-checkbox h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                                        <span class="mr-2" :class="{ 'ml-2 mr-0': direction === 'rtl' }">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 block">{{ $user->email }}</span>
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('user_ids')
                                <p class="mt-1 text-sm text-danger-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Same form fields as single user -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="type_multiple" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    نوع الإشعار <span class="text-danger-500">*</span>
                                </label>
                                <select name="type" id="type_multiple" class="form-select" required>
                                    <option value="">اختر النوع</option>
                                    <option value="marketing">تسويقي</option>
                                    <option value="system">نظام</option>
                                    <option value="balance">رصيد</option>
                                    <option value="purchase">شراء</option>
                                    <option value="security">أمان</option>
                                    <option value="general">عام</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="title_multiple" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                عنوان الإشعار <span class="text-danger-500">*</span>
                            </label>
                            <input type="text" name="title" id="title_multiple" class="form-input" placeholder="أدخل عنوان الإشعار" required>
                        </div>

                        <div>
                            <label for="message_multiple" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                محتوى الإشعار <span class="text-danger-500">*</span>
                            </label>
                            <textarea name="message" id="message_multiple" rows="4" class="form-textarea" placeholder="أدخل محتوى الإشعار" required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                إرسال الإشعار
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- All Users Form -->
        <div id="tab-content-all" class="tab-content hidden">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">إرسال إشعار لجميع المستخدمين</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.notifications.send-to-all') }}" class="space-y-6">
                        @csrf
                        <div class="bg-warning-50 dark:bg-warning-900/20 border border-warning-200 dark:border-warning-800 rounded-lg p-4">
                            <div class="flex">
                                <svg class="h-5 w-5 text-warning-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                                <div class="mr-3" :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                                    <h3 class="text-sm font-medium text-warning-800 dark:text-warning-200">تنبيه</h3>
                                    <p class="text-sm text-warning-700 dark:text-warning-300 mt-1">
                                        سيتم إرسال هذا الإشعار لجميع المستخدمين المسجلين في النظام.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Same form fields as single user -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="type_all" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    نوع الإشعار <span class="text-danger-500">*</span>
                                </label>
                                <select name="type" id="type_all" class="form-select" required>
                                    <option value="">اختر النوع</option>
                                    <option value="marketing">تسويقي</option>
                                    <option value="system">نظام</option>
                                    <option value="balance">رصيد</option>
                                    <option value="purchase">شراء</option>
                                    <option value="security">أمان</option>
                                    <option value="general">عام</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="title_all" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                عنوان الإشعار <span class="text-danger-500">*</span>
                            </label>
                            <input type="text" name="title" id="title_all" class="form-input" placeholder="أدخل عنوان الإشعار" required>
                        </div>

                        <div>
                            <label for="message_all" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                محتوى الإشعار <span class="text-danger-500">*</span>
                            </label>
                            <textarea name="message" id="message_all" rows="4" class="form-textarea" placeholder="أدخل محتوى الإشعار" required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                إرسال الإشعار للجميع
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Criteria Form -->
        <div id="tab-content-criteria" class="tab-content hidden">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">إرسال إشعار حسب معايير</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.notifications.send-by-criteria') }}" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="criteria_role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    الدور
                                </label>
                                <select name="criteria[role]" id="criteria_role" class="form-select">
                                    <option value="">جميع الأدوار</option>
                                    <option value="user">مستخدم</option>
                                    <option value="admin">مشرف</option>
                                </select>
                            </div>

                            <div>
                                <label for="criteria_is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    الحالة
                                </label>
                                <select name="criteria[is_active]" id="criteria_is_active" class="form-select">
                                    <option value="">جميع الحالات</option>
                                    <option value="1">نشط</option>
                                    <option value="0">غير نشط</option>
                                </select>
                            </div>

                            <div>
                                <label for="criteria_min_balance" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    الحد الأدنى للرصيد
                                </label>
                                <input type="number" name="criteria[min_balance]" id="criteria_min_balance" 
                                       class="form-input" placeholder="0.00" step="0.01" min="0">
                            </div>

                            <div>
                                <label for="criteria_max_balance" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    الحد الأقصى للرصيد
                                </label>
                                <input type="number" name="criteria[max_balance]" id="criteria_max_balance" 
                                       class="form-input" placeholder="0.00" step="0.01" min="0">
                            </div>

                            <div>
                                <label for="criteria_created_after" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    تاريخ التسجيل من
                                </label>
                                <input type="date" name="criteria[created_after]" id="criteria_created_after" class="form-input">
                            </div>

                            <div>
                                <label for="criteria_created_before" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    تاريخ التسجيل إلى
                                </label>
                                <input type="date" name="criteria[created_before]" id="criteria_created_before" class="form-input">
                            </div>
                        </div>

                        <!-- Same form fields as single user -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="type_criteria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    نوع الإشعار <span class="text-danger-500">*</span>
                                </label>
                                <select name="type" id="type_criteria" class="form-select" required>
                                    <option value="">اختر النوع</option>
                                    <option value="marketing">تسويقي</option>
                                    <option value="system">نظام</option>
                                    <option value="balance">رصيد</option>
                                    <option value="purchase">شراء</option>
                                    <option value="security">أمان</option>
                                    <option value="general">عام</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="title_criteria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                عنوان الإشعار <span class="text-danger-500">*</span>
                            </label>
                            <input type="text" name="title" id="title_criteria" class="form-input" placeholder="أدخل عنوان الإشعار" required>
                        </div>

                        <div>
                            <label for="message_criteria" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                محتوى الإشعار <span class="text-danger-500">*</span>
                            </label>
                            <textarea name="message" id="message_criteria" rows="4" class="form-textarea" placeholder="أدخل محتوى الإشعار" required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">
                                <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                إرسال الإشعار
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
.tab-button {
    @apply py-2 px-1 border-b-2 font-medium text-sm;
    @apply text-gray-500 border-transparent hover:text-gray-700 hover:border-gray-300;
    @apply dark:text-gray-400 dark:hover:text-gray-300 dark:hover:border-gray-600;
}

.tab-button.active {
    @apply text-primary-600 border-primary-500;
    @apply dark:text-primary-400 dark:border-primary-400;
}

.tab-content {
    @apply transition-all duration-300 ease-in-out;
}
</style>
@endpush

@push('scripts')
<script>
function showTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.classList.add('hidden');
    });

    // Remove active class from all tab buttons
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('active');
    });

    // Show selected tab content
    document.getElementById(`tab-content-${tabName}`).classList.remove('hidden');
    
    // Add active class to selected tab button
    document.getElementById(`tab-${tabName}`).classList.add('active');
}

// Initialize with first tab
document.addEventListener('DOMContentLoaded', function() {
    showTab('single');
});
</script>
@endpush 