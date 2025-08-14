@extends('layouts.app')

@section('title', 'تفاصيل الإشعار')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        تفاصيل الإشعار
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        عرض تفاصيل الإشعار
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        العودة للقائمة
                    </a>
                    <form method="POST" action="{{ route('admin.notifications.destroy', $notification->id) }}" 
                          class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الإشعار؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            حذف الإشعار
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notification Details -->
        <div class="card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">معلومات الإشعار</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $notification->type_class }}-100 text-{{ $notification->type_class }}-800 dark:bg-{{ $notification->type_class }}-900 dark:text-{{ $notification->type_class }}-200">
                        {{ $notification->type_text }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Main Content -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العنوان</label>
                            <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $notification->title }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">المحتوى</label>
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                                <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $notification->message }}</p>
                            </div>
                        </div>

                        @if($notification->image_url)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الصورة المرفقة</label>
                                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                                    <img src="{{ $notification->image_url }}" alt="صورة الإشعار" 
                                         class="max-w-full h-auto rounded-lg shadow-sm">
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Metadata -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">المستخدم المستهدف</label>
                            @if($notification->user)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
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
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">حالة القراءة</label>
                            @if($notification->is_read)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200">
                                    <svg class="h-3 w-3 ml-1" :class="{ 'mr-1 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    مقروء
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-warning-100 text-warning-800 dark:bg-warning-900 dark:text-warning-200">
                                    <svg class="h-3 w-3 ml-1" :class="{ 'mr-1 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    غير مقروء
                                </span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">تاريخ الإرسال</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $notification->formatted_date }}</p>
                        </div>

                        @if($notification->expires_at)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">تاريخ انتهاء الصلاحية</label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $notification->expires_at->format('Y-m-d H:i:s') }}</p>
                                @if($notification->isExpired())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-danger-100 text-danger-800 dark:bg-danger-900 dark:text-danger-200 mt-1">
                                        منتهي الصلاحية
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200 mt-1">
                                        صالح
                                    </span>
                                @endif
                            </div>
                        @endif

                        @if($notification->metadata)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">بيانات إضافية</label>
                                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                                    <pre class="text-xs text-gray-900 dark:text-white overflow-x-auto">{{ json_encode($notification->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex justify-end space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
            <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
                <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                العودة للقائمة
            </a>
            
            @if(!$notification->is_read)
                <form method="POST" action="{{ route('admin.notifications.mark-read', $notification->id) }}" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        تحديد كمقروء
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection 