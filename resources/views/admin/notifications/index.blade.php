@extends('layouts.app')

@section('title', 'إدارة الإشعارات')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        إدارة الإشعارات
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        إدارة وإرسال الإشعارات للمستخدمين
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.notifications.create') }}" 
                       class="btn btn-primary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        إرسال إشعار جديد
                    </a>
                    <a href="{{ route('admin.notifications.statistics') }}" 
                       class="btn btn-secondary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        الإحصائيات
                    </a>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.notifications.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">نوع الإشعار</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">جميع الأنواع</option>
                            <option value="marketing" {{ request('type') == 'marketing' ? 'selected' : '' }}>تسويقي</option>
                            <option value="system" {{ request('type') == 'system' ? 'selected' : '' }}>نظام</option>
                            <option value="balance" {{ request('type') == 'balance' ? 'selected' : '' }}>رصيد</option>
                            <option value="purchase" {{ request('type') == 'purchase' ? 'selected' : '' }}>شراء</option>
                            <option value="security" {{ request('type') == 'security' ? 'selected' : '' }}>أمان</option>
                            <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>عام</option>
                        </select>
                    </div>
                    <div>
                        <label for="is_read" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">حالة القراءة</label>
                        <select name="is_read" id="is_read" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>غير مقروء</option>
                            <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>مقروء</option>
                        </select>
                    </div>
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">بحث</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               class="form-input" placeholder="البحث في العنوان أو المحتوى">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="btn btn-primary w-full">
                            <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            بحث
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">قائمة الإشعارات</h3>
            </div>
            <div class="card-body">
                @if($notifications->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الإشعار
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        النوع
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        المستخدم
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الحالة
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        التاريخ
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الإجراءات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($notifications as $notification)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4">
                                        <div class="flex items-start">
                                            @if($notification->image_url)
                                                <img src="{{ $notification->image_url }}" alt="صورة الإشعار" 
                                                     class="h-10 w-10 rounded-lg object-cover ml-3" 
                                                     :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                            @else
                                                <div class="h-10 w-10 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center ml-3" 
                                                     :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                    {{ $notification->title }}
                                                </p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                    {{ Str::limit($notification->message, 100) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $notification->type_class }}-100 text-{{ $notification->type_class }}-800 dark:bg-{{ $notification->type_class }}-900 dark:text-{{ $notification->type_class }}-200">
                                            {{ $notification->type_text }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($notification->user)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-primary-600">
                                                            {{ substr($notification->user->name, 0, 1) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="mr-3" :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $notification->user->name }}
                                                    </p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $notification->user->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 dark:text-gray-400">جميع المستخدمين</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($notification->is_read)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200">
                                                مقروء
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-100 text-warning-800 dark:bg-warning-900 dark:text-warning-200">
                                                غير مقروء
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $notification->created_at->format('Y-m-d') }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $notification->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                            <button type="button" 
                                                    class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300"
                                                    onclick="viewNotification({{ $notification->id }})">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <form method="POST" action="{{ route('admin.notifications.destroy', $notification->id) }}" 
                                                  class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الإشعار؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-danger-600 hover:text-danger-900 dark:text-danger-400 dark:hover:text-danger-300">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">لا توجد إشعارات</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            لم يتم العثور على إشعارات تطابق معايير البحث.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary">
                                إرسال إشعار جديد
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Notification View Modal -->
<div id="notificationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">تفاصيل الإشعار</h3>
                <button onclick="closeNotificationModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="notificationContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function viewNotification(id) {
    // Load notification details via AJAX
    fetch(`/admin/notifications/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('notificationContent').innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">العنوان</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">${data.data.title}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">المحتوى</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">${data.data.message}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">النوع</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-${data.data.type_class}-100 text-${data.data.type_class}-800 dark:bg-${data.data.type_class}-900 dark:text-${data.data.type_class}-200">
                                ${data.data.type_text}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">تاريخ الإرسال</label>
                            <p class="mt-1 text-sm text-gray-900 dark:text-white">${data.data.formatted_date}</p>
                        </div>
                    </div>
                `;
                document.getElementById('notificationModal').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء تحميل تفاصيل الإشعار');
        });
}

function closeNotificationModal() {
    document.getElementById('notificationModal').classList.add('hidden');
}
</script>
@endpush 