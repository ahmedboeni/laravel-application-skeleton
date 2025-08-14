@extends('layouts.app')

@section('title', 'إحصائيات الإشعارات')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        إحصائيات الإشعارات
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        نظرة عامة على إحصائيات الإشعارات
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.notifications.index') }}" class="btn btn-secondary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        العودة للقائمة
                    </a>
                    <a href="{{ route('admin.notifications.create') }}" class="btn btn-primary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        إرسال إشعار جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Notifications -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM20 4H4v2h16V4zM4 10h16v2H4v-2zM4 14h16v2H4v-2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">إجمالي الإشعارات</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($statistics['total']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Unread Notifications -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">غير مقروء</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($statistics['unread']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Read Notifications -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-success-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">مقروء</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($statistics['read']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Read Rate -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-info-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">معدل القراءة</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ $statistics['total'] > 0 ? number_format(($statistics['read'] / $statistics['total']) * 100, 1) : 0 }}%
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Notifications by Type -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">الإشعارات حسب النوع</h3>
                </div>
                <div class="card-body">
                    @if(!empty($statistics['by_type']))
                        <div class="space-y-4">
                            @foreach($statistics['by_type'] as $type => $count)
                                @php
                                    $percentage = $statistics['total'] > 0 ? ($count / $statistics['total']) * 100 : 0;
                                    $typeColors = [
                                        'marketing' => 'bg-blue-500',
                                        'system' => 'bg-green-500',
                                        'balance' => 'bg-yellow-500',
                                        'purchase' => 'bg-purple-500',
                                        'security' => 'bg-red-500',
                                        'general' => 'bg-gray-500'
                                    ];
                                    $typeTexts = [
                                        'marketing' => 'تسويقي',
                                        'system' => 'نظام',
                                        'balance' => 'رصيد',
                                        'purchase' => 'شراء',
                                        'security' => 'أمان',
                                        'general' => 'عام'
                                    ];
                                    $color = $typeColors[$type] ?? 'bg-gray-500';
                                    $text = $typeTexts[$type] ?? $type;
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full {{ $color }} ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }"></div>
                                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $text }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ number_format($count) }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="{{ $color }} h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($percentage, 1) }}%</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">لا توجد بيانات متاحة</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">النشاط الأخير</h3>
                </div>
                <div class="card-body">
                    <div class="space-y-4">
                        @forelse($recentNotifications as $notification)
                            <div class="flex items-start space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM20 4H4v2h16V4zM4 10h16v2H4v-2zM4 14h16v2H4v-2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                        {{ $notification->title }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $notification->user ? $notification->user->name : 'جميع المستخدمين' }}
                                    </p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $notification->type_class }}-100 text-{{ $notification->type_class }}-800 dark:bg-{{ $notification->type_class }}-900 dark:text-{{ $notification->type_class }}-200">
                                        {{ $notification->type_text }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM20 4H4v2h16V4zM4 10h16v2H4v-2zM4 14h16v2H4v-2z" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">لا توجد إشعارات حديثة</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">إجراءات سريعة</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.notifications.create') }}" 
                       class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">إرسال إشعار جديد</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">إنشاء وإرسال إشعار للمستخدمين</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.notifications.index') }}" 
                       class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-success-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">عرض جميع الإشعارات</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">إدارة وتصفية الإشعارات</p>
                        </div>
                    </a>

                    <button onclick="deleteExpiredNotifications()" 
                            class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 text-right" 
                            :class="{ 'text-left': direction === 'rtl' }">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">حذف منتهية الصلاحية</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">تنظيف الإشعارات القديمة</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function deleteExpiredNotifications() {
    if (confirm('هل أنت متأكد من حذف جميع الإشعارات منتهية الصلاحية؟')) {
        fetch('{{ route("admin.notifications.delete-expired") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`تم حذف ${data.count} إشعار منتهي الصلاحية بنجاح`);
                location.reload();
            } else {
                alert('حدث خطأ أثناء حذف الإشعارات');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء حذف الإشعارات');
        });
    }
}
</script>
@endpush 