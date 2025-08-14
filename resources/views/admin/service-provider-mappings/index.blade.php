@extends('layouts.app')

@section('title', 'ربط الخدمات بالمزودين')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        ربط الخدمات بالمزودين
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        إدارة ربط الخدمات المحلية مع خدمات المزودين الخارجيين
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.service-provider-mappings.create') }}" class="btn btn-primary">
                        <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        إضافة ربط جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total Mappings -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">إجمالي الروابط</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $mappings->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Mappings -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">الروابط النشطة</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['active'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inactive Mappings -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">الروابط غير النشطة</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['inactive'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Providers Count -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-info-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">عدد المزودين</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['providers'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-8">
            <div class="card-header">
                <h3 class="card-title">فلاتر البحث</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.service-provider-mappings.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Service Filter -->
                        <div>
                            <label for="service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                الخدمة
                            </label>
                            <select name="service_id" id="service_id" class="form-select">
                                <option value="">جميع الخدمات</option>
                                @foreach($services ?? [] as $service)
                                    <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Provider Filter -->
                        <div>
                            <label for="provider_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                المزود
                            </label>
                            <select name="provider_id" id="provider_id" class="form-select">
                                <option value="">جميع المزودين</option>
                                @foreach($providers ?? [] as $provider)
                                    <option value="{{ $provider->id }}" {{ request('provider_id') == $provider->id ? 'selected' : '' }}>
                                        {{ $provider->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                الحالة
                            </label>
                            <select name="is_active" id="is_active" class="form-select">
                                <option value="">جميع الحالات</option>
                                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>نشط</option>
                                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>غير نشط</option>
                            </select>
                        </div>

                        <!-- Search Button -->
                        <div class="flex items-end">
                            <button type="submit" class="btn btn-primary w-full">
                                <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                بحث
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mappings Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">قائمة الروابط</h3>
            </div>
            <div class="card-body">
                @if($mappings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" :class="{ 'text-left': direction === 'ltr' }">
                                        الخدمة المحلية
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" :class="{ 'text-left': direction === 'ltr' }">
                                        المزود
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" :class="{ 'text-left': direction === 'ltr' }">
                                        خدمة المزود
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" :class="{ 'text-left': direction === 'ltr' }">
                                        السعر النهائي
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" :class="{ 'text-left': direction === 'ltr' }">
                                        الأولوية
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" :class="{ 'text-left': direction === 'ltr' }">
                                        الحالة
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider" :class="{ 'text-left': direction === 'ltr' }">
                                        الإجراءات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($mappings as $mapping)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $mapping->service->name_ar ?? 'غير محدد' }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                ID: {{ $mapping->local_service_id }}
                                                @if($mapping->serviceOption)
                                                    <br>خيار: {{ $mapping->serviceOption->option_name }}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $mapping->provider->name ?? 'غير محدد' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $mapping->provider_service_id }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                @if($mapping->provider_package_id)
                                                    باقة: {{ $mapping->provider_package_id }}
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ number_format($mapping->final_price, 2) }} ريال
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                ربح: {{ number_format($mapping->profit, 2) }} ريال
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                {{ $mapping->priority }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $mapping->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                {{ $mapping->is_active ? 'نشط' : 'غير نشط' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                                <a href="{{ route('admin.service-provider-mappings.show', $mapping) }}" 
                                                   class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                                    عرض
                                                </a>
                                                <a href="{{ route('admin.service-provider-mappings.edit', $mapping) }}" 
                                                   class="text-warning-600 hover:text-warning-900 dark:text-warning-400 dark:hover:text-warning-300">
                                                    تعديل
                                                </a>
                                                <form action="{{ route('admin.service-provider-mappings.destroy', $mapping) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الربط؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger-600 hover:text-danger-900 dark:text-danger-400 dark:hover:text-danger-300">
                                                        حذف
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
                        {{ $mappings->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">لا توجد روابط</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">ابدأ بإنشاء ربط جديد بين الخدمات والمزودين.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.service-provider-mappings.create') }}" class="btn btn-primary">
                                <svg class="w-5 h-5 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                إضافة أول ربط
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
