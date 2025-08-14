{{-- Service Card Component --}}
@props(['service', 'showProviders' => false, 'showDetails' => false])

<div class="card hover:shadow-lg transition-shadow duration-200">
    <div class="card-body">
        <div class="flex items-start justify-between">
            <!-- Service Info -->
            <div class="flex items-center space-x-4" :class="{ 'space-x-reverse': direction === 'rtl' }">
                @if($service->image)
                    <img src="{{ $service->image }}" alt="{{ $service->name_ar }}" class="h-12 w-12 rounded-lg object-cover">
                @else
                    <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                @endif

                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $service->name_ar }}
                    </h3>
                    @if($service->name_en)
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $service->name_en }}</p>
                    @endif
                    
                    <!-- Service Type & Category -->
                    <div class="flex items-center space-x-2 mt-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        @if($service->service_type)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ $service->service_type }}
                            </span>
                        @endif
                        
                        @if($service->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                {{ $service->category->name_ar ?? 'غير محدد' }}
                            </span>
                        @endif

                        @if($service->carrier)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                {{ $service->carrier->name_ar }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status & Actions -->
            <div class="flex items-center space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                <!-- Status -->
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                    {{ $service->is_active ? 'نشط' : 'غير نشط' }}
                </span>

                <!-- Actions Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg z-10" :class="{ 'right-0 left-auto': direction === 'rtl' }">
                        <div class="py-1">
                            <a href="{{ route('admin.services.show', $service) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                عرض التفاصيل
                            </a>
                            <a href="{{ route('admin.services.edit', $service) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                تعديل
                            </a>
                            @if($showProviders && isset($service->providerMappings))
                                <a href="{{ route('admin.service-provider-mappings.index', ['service_id' => $service->id]) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="w-4 h-4 ml-2" :class="{ 'mr-2 ml-0': direction === 'rtl' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    إدارة المزودين
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($showDetails)
            <!-- Extended Details -->
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Price Range -->
                    @if($service->min_amount || $service->max_amount)
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">المدى السعري</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                @if($service->min_amount && $service->max_amount)
                                    {{ number_format($service->min_amount, 0) }} - {{ number_format($service->max_amount, 0) }} ريال
                                @elseif($service->min_amount)
                                    من {{ number_format($service->min_amount, 0) }} ريال
                                @elseif($service->max_amount)
                                    حتى {{ number_format($service->max_amount, 0) }} ريال
                                @endif
                            </p>
                        </div>
                    @endif

                    <!-- Providers Count -->
                    @if($showProviders && isset($service->providerMappings))
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">عدد المزودين</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $service->providerMappings->count() }} مزود
                                <span class="text-xs text-green-600">({{ $service->activeProviderMappings->count() }} نشط)</span>
                            </p>
                        </div>
                    @endif

                    <!-- Sort Order -->
                    @if($service->sort_order)
                        <div>
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">ترتيب العرض</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $service->sort_order }}</p>
                        </div>
                    @endif

                    <!-- Last Updated -->
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">آخر تحديث</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $service->updated_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <!-- Description -->
                @if($service->description)
                    <div class="mt-3">
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $service->description }}</p>
                    </div>
                @endif

                <!-- Client Fields Preview -->
                @if($service->client_fields)
                    <div class="mt-3">
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 mb-2">الحقول المطلوبة:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($service->getRequiredClientFields() as $field)
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                    {{ $field['label'] ?? $field }}
                                    @if(isset($field['required']) && $field['required'])
                                        <span class="text-red-500 mr-1">*</span>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
