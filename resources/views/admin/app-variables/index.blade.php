@extends('layouts.app')

@section('title', 'إدارة المتغيرات')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        إدارة المتغيرات
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        إدارة جميع المتغيرات والإعدادات المستخدمة في التطبيق
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.app-variables.create') }}" 
                       class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        إضافة متغير جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.app-variables.index') }}">
                    <div class="flex items-center space-x-4" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <div class="flex-1">
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                الفئة
                            </label>
                            <select name="category" id="category" class="form-select w-full" onchange="this.form.submit()">
                                <option value="all" {{ $category === 'all' ? 'selected' : '' }}>جميع الفئات</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex items-end">
                            <button type="button" 
                                    onclick="clearCache()"
                                    class="btn btn-secondary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                مسح الكاش
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Variables Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    قائمة المتغيرات
                    @if($category !== 'all')
                        - فئة: {{ $category }}
                    @endif
                </h3>
            </div>
            <div class="card-body p-0">
                @if($variables->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>الفئة</th>
                                    <th>المفتاح</th>
                                    <th>الاسم المعروض</th>
                                    <th>القيمة</th>
                                    <th>الوصف</th>
                                    <th>الحالة</th>
                                    <th>الترتيب</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($variables as $variable)
                                    <tr>
                                        <td>
                                            <span class="badge badge-secondary">{{ $variable->category }}</span>
                                        </td>
                                        <td>
                                            <code class="text-sm">{{ $variable->variable_key }}</code>
                                        </td>
                                        <td>
                                            <div class="flex items-center">
                                                @if($variable->icon)
                                                    <span class="mr-2" style="color: {{ $variable->color ?? '#6c757d' }}">
                                                        <i class="fas fa-{{ $variable->icon }}"></i>
                                                    </span>
                                                @endif
                                                {{ $variable->display_name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="max-w-xs truncate" title="{{ $variable->variable_value }}">
                                                {{ $variable->variable_value }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="max-w-xs truncate" title="{{ $variable->description }}">
                                                {{ $variable->description }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $variable->is_active ? 'badge-success' : 'badge-danger' }}">
                                                {{ $variable->is_active ? 'نشط' : 'غير نشط' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-sm text-gray-500">{{ $variable->sort_order }}</span>
                                        </td>
                                        <td>
                                            <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                                <a href="{{ route('admin.app-variables.edit', $variable) }}" 
                                                   class="btn btn-sm btn-info">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                <button onclick="deleteVariable({{ $variable->id }})" 
                                                        class="btn btn-sm btn-danger">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $variables->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">لا توجد متغيرات</h3>
                        <p class="mt-1 text-sm text-gray-500">ابدأ بإضافة متغير جديد.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.app-variables.create') }}" class="btn btn-primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                إضافة متغير جديد
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// مسح الكاش
function clearCache() {
    fetch('{{ route("admin.app-variables.clear-cache") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('تم مسح الكاش بنجاح!');
        } else {
            alert('خطأ في مسح الكاش: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء مسح الكاش');
    });
}

// حذف متغير
function deleteVariable(id) {
    if (!confirm('هل أنت متأكد من حذف هذا المتغير؟')) {
        return;
    }
    
    fetch(`/admin/app-variables/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('خطأ في حذف المتغير: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('حدث خطأ أثناء حذف المتغير');
    });
}
</script>
@endsection
