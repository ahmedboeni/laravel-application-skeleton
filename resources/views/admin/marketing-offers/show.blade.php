@extends('layouts.app')

@section('title', 'تفاصيل العرض التسويقي')

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        تفاصيل العرض التسويقي
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        عرض تفاصيل العرض التسويقي
                    </p>
                </div>
                <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.marketing-offers.edit', $offer->id) }}" class="btn btn-warning">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        تعديل العرض
                    </a>
                    <a href="{{ route('admin.marketing-offers.index') }}" class="btn btn-secondary">
                        <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        العودة للقائمة
                    </a>
                    <form method="POST" action="{{ route('admin.marketing-offers.destroy', $offer->id) }}" 
                          class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا العرض؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            حذف العرض
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Offer Details -->
        <div class="card">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">معلومات العرض</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $offer->status_class }}-100 text-{{ $offer->status_class }}-800 dark:bg-{{ $offer->status_class }}-900 dark:text-{{ $offer->status_class }}-200">
                        {{ $offer->status_text }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Main Content -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">العنوان</label>
                            <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $offer->title }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الوصف</label>
                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                                <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $offer->description }}</p>
                            </div>
                        </div>

                        @if($offer->image_url)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">صورة العرض</label>
                                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                                    <img src="{{ $offer->image_url }}" alt="صورة العرض" 
                                         class="max-w-full h-auto rounded-lg shadow-sm">
                                </div>
                            </div>
                        @endif

                        @if($offer->code)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">كود الخصم</label>
                                <code class="text-lg bg-gray-100 dark:bg-gray-700 px-3 py-2 rounded font-mono">
                                    {{ $offer->code }}
                                </code>
                            </div>
                        @endif
                    </div>

                    <!-- Metadata -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">نوع الخصم</label>
                            <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $offer->discount_type == 'percentage' ? 'blue' : ($offer->discount_type == 'fixed' ? 'green' : 'purple') }}-100 text-{{ $offer->discount_type == 'percentage' ? 'blue' : ($offer->discount_type == 'fixed' ? 'green' : 'purple') }}-800 dark:bg-{{ $offer->discount_type == 'percentage' ? 'blue' : ($offer->discount_type == 'fixed' ? 'green' : 'purple') }}-900 dark:text-{{ $offer->discount_type == 'percentage' ? 'blue' : ($offer->discount_type == 'fixed' ? 'green' : 'purple') }}-200">
                                    {{ $offer->discount_type_text }}
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $offer->discount_text }}</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الحد الأدنى للشراء</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ number_format($offer->min_purchase_amount, 2) }} ريال</p>
                        </div>

                        @if($offer->max_discount_amount)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الحد الأقصى للخصم</label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ number_format($offer->max_discount_amount, 2) }} ريال</p>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الاستخدام</label>
                            <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                <span class="text-sm text-gray-900 dark:text-white">{{ $offer->used_count }}</span>
                                @if($offer->usage_limit)
                                    <span class="text-sm text-gray-500 dark:text-gray-400">/ {{ $offer->usage_limit }}</span>
                                @else
                                    <span class="text-sm text-gray-500 dark:text-gray-400">/ غير محدود</span>
                                @endif
                            </div>
                            @if($offer->usage_limit)
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                    @php
                                        $percentage = ($offer->used_count / $offer->usage_limit) * 100;
                                    @endphp
                                    <div class="bg-primary-500 h-2 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($percentage, 1) }}% مستخدم</p>
                            @endif
                        </div>

                        @if($offer->valid_from || $offer->valid_until)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">فترة الصلاحية</label>
                                @if($offer->valid_from)
                                    <p class="text-sm text-gray-900 dark:text-white">من: {{ $offer->formatted_valid_from }}</p>
                                @endif
                                @if($offer->valid_until)
                                    <p class="text-sm text-gray-500 dark:text-gray-400">إلى: {{ $offer->formatted_valid_until }}</p>
                                @endif
                                @if($offer->isExpired())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-danger-100 text-danger-800 dark:bg-danger-900 dark:text-danger-200 mt-2">
                                        منتهي الصلاحية
                                    </span>
                                @elseif($offer->isValid())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200 mt-2">
                                        صالح
                                    </span>
                                @endif
                            </div>
                        @endif

                        @if($offer->applicable_categories)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الفئات المطبقة</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($offer->applicable_categories as $categoryId)
                                        @php
                                            $category = $categories->firstWhere('id', $categoryId);
                                        @endphp
                                        @if($category)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                {{ $category->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($offer->excluded_services)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">الخدمات المستثناة</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($offer->excluded_services as $serviceId)
                                        @php
                                            $service = $services->firstWhere('id', $serviceId);
                                        @endphp
                                        @if($service)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                {{ $service->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">تاريخ الإنشاء</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $offer->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">آخر تحديث</label>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $offer->updated_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usage Statistics -->
        @if($offer->usages->count() > 0)
            <div class="card mt-8">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">سجل الاستخدام</h3>
                </div>
                <div class="card-body">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        المستخدم
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        المبلغ الأصلي
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        الخصم
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        المبلغ النهائي
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        تاريخ الاستخدام
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($offer->usages->take(10) as $usage)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <div class="h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center">
                                                    <span class="text-sm font-medium text-primary-600">
                                                        {{ substr($usage->user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mr-3" :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $usage->user->name }}
                                                </p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $usage->user->email }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ number_format($usage->original_amount, 2) }} ريال
                                    </td>
                                    <td class="px-6 py-4 text-sm text-success-600 dark:text-success-400">
                                        -{{ number_format($usage->discount_amount, 2) }} ريال
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ number_format($usage->final_amount, 2) }} ريال
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $usage->formatted_used_at }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="mt-8 flex justify-end space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
            <a href="{{ route('admin.marketing-offers.index') }}" class="btn btn-secondary">
                <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                العودة للقائمة
            </a>
            
            <a href="{{ route('admin.marketing-offers.edit', $offer->id) }}" class="btn btn-warning">
                <svg class="h-4 w-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                تعديل العرض
            </a>
        </div>
    </div>
</div>
@endsection 