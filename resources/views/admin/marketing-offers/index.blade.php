@extends('layouts.app')

@section('title', 'إدارة العروض التسويقية')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        إدارة العروض التسويقية
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        إدارة العروض والخصومات للمستخدمين
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.marketing-offers.create') }}" 
                       class="btn btn-primary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        إنشاء عرض جديد
                    </a>
                    <a href="{{ route('admin.marketing-offers.statistics') }}" 
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
                <form method="GET" action="{{ route('admin.marketing-offers.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="discount_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">نوع الخصم</label>
                        <select name="discount_type" id="discount_type" class="form-select">
                            <option value="">جميع الأنواع</option>
                            <option value="percentage" {{ request('discount_type') == 'percentage' ? 'selected' : '' }}>نسبة مئوية</option>
                            <option value="fixed" {{ request('discount_type') == 'fixed' ? 'selected' : '' }}>مبلغ ثابت</option>
                            <option value="both" {{ request('discount_type') == 'both' ? 'selected' : '' }}>كلاهما</option>
                        </select>
                    </div>
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">الحالة</label>
                        <select name="is_active" id="is_active" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>نشط</option>
                            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>غير نشط</option>
                        </select>
                    </div>
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">بحث</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               class="form-input" placeholder="البحث في العنوان أو الكود">
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

        <!-- Offers List -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">قائمة العروض</h3>
            </div>
            <div class="card-body">
                @if($offers->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        العرض
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        نوع الخصم
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الكود
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الحالة
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الاستخدام
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الصلاحية
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الإجراءات
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($offers as $offer)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4">
                                        <div class="flex items-start">
                                            @if($offer->image_url)
                                                <img src="{{ $offer->image_url }}" alt="صورة العرض" 
                                                     class="h-10 w-10 rounded-lg object-cover ml-3" 
                                                     :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                            @else
                                                <div class="h-10 w-10 rounded-lg bg-primary-100 flex items-center justify-center ml-3" 
                                                     :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                                    <svg class="h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                    {{ $offer->title }}
                                                </p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                                    {{ Str::limit($offer->description, 100) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $offer->discount_type == 'percentage' ? 'blue' : ($offer->discount_type == 'fixed' ? 'green' : 'purple') }}-100 text-{{ $offer->discount_type == 'percentage' ? 'blue' : ($offer->discount_type == 'fixed' ? 'green' : 'purple') }}-800 dark:bg-{{ $offer->discount_type == 'percentage' ? 'blue' : ($offer->discount_type == 'fixed' ? 'green' : 'purple') }}-900 dark:text-{{ $offer->discount_type == 'percentage' ? 'blue' : ($offer->discount_type == 'fixed' ? 'green' : 'purple') }}-200">
                                                {{ $offer->discount_type_text }}
                                            </span>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $offer->discount_text }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($offer->code)
                                            <code class="text-sm bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                                                {{ $offer->code }}
                                            </code>
                                        @else
                                            <span class="text-sm text-gray-500 dark:text-gray-400">لا يوجد كود</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $offer->status_class }}-100 text-{{ $offer->status_class }}-800 dark:bg-{{ $offer->status_class }}-900 dark:text-{{ $offer->status_class }}-200">
                                            {{ $offer->status_text }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ $offer->used_count }}
                                            @if($offer->usage_limit)
                                                / {{ $offer->usage_limit }}
                                            @endif
                                        </div>
                                        @if($offer->usage_limit)
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-1">
                                                @php
                                                    $percentage = ($offer->used_count / $offer->usage_limit) * 100;
                                                @endphp
                                                <div class="bg-primary-500 h-2 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            @if($offer->valid_from)
                                                من: {{ $offer->formatted_valid_from }}
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            @if($offer->valid_until)
                                                إلى: {{ $offer->formatted_valid_until }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                            <a href="{{ route('admin.marketing-offers.show', $offer->id) }}" 
                                               class="text-primary-600 hover:text-primary-900 dark:text-primary-400 dark:hover:text-primary-300">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.marketing-offers.edit', $offer->id) }}" 
                                               class="text-warning-600 hover:text-warning-900 dark:text-warning-400 dark:hover:text-warning-300">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.marketing-offers.destroy', $offer->id) }}" 
                                                  class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا العرض؟')">
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
                        {{ $offers->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">لا توجد عروض</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            لم يتم العثور على عروض تطابق معايير البحث.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('admin.marketing-offers.create') }}" class="btn btn-primary">
                                إنشاء عرض جديد
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 