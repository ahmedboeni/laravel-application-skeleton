@extends('layouts.app')

@section('title', __('app.add_category'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.add_category') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.create_new_category_description', ['default' => 'إنشاء فئة جديدة في النظام']) }}
                    </p>
                </div>
                <a href="{{ route('admin.categories.index') }}" 
                   class="btn btn-outline-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('app.back') }}
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.category_information') }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Arabic Name -->
                        <div class="col-span-1">
                            <label for="name_ar" class="form-label">
                                {{ __('app.category_name_ar') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name_ar" 
                                   name="name_ar" 
                                   value="{{ old('name_ar') }}"
                                   class="form-input @error('name_ar') border-red-500 @enderror"
                                   placeholder="{{ __('app.category_name_ar_placeholder') }}"
                                   required>
                            @error('name_ar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- English Name -->
                        <div class="col-span-1">
                            <label for="name_en" class="form-label">
                                {{ __('app.category_name_en') }}
                            </label>
                            <input type="text" 
                                   id="name_en" 
                                   name="name_en" 
                                   value="{{ old('name_en') }}"
                                   class="form-input @error('name_en') border-red-500 @enderror"
                                   placeholder="{{ __('app.category_name_en_placeholder') }}">
                            @error('name_en')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="col-span-1">
                            <label for="type" class="form-label">
                                {{ __('app.category_type') }}
                            </label>
                            <select id="type" 
                                    name="type" 
                                    class="form-select @error('type') border-red-500 @enderror">
                                <option value="">{{ __('app.select_category_type', ['default' => 'اختر نوع الفئة']) }}</option>
                                @foreach(\App\Models\AppVariable::getByCategory('category_types') as $categoryType)
                                    <option value="{{ $categoryType->variable_key }}" 
                                            {{ old('type') == $categoryType->variable_key ? 'selected' : '' }}
                                            data-icon="{{ $categoryType->icon }}"
                                            data-color="{{ $categoryType->color }}">
                                        {{ $categoryType->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div class="col-span-1">
                            <label for="icon" class="form-label">
                                {{ __('app.category_icon') }}
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       id="icon" 
                                       name="icon" 
                                       value="{{ old('icon') }}"
                                       class="form-input @error('icon') border-red-500 @enderror pr-10"
                                       placeholder="{{ __('app.category_icon_placeholder') }}">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" 
                                            onclick="openIconSelector()"
                                            class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @error('icon')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div class="col-span-1">
                            <label for="color" class="form-label">
                                {{ __('app.category_color') }}
                            </label>
                            <div class="relative">
                                <input type="color" 
                                       id="color" 
                                       name="color" 
                                       value="{{ old('color', '#007bff') }}"
                                       class="form-input h-10 w-full @error('color') border-red-500 @enderror">
                            </div>
                            @error('color')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-1">
                            <label class="form-label">
                                {{ __('app.category_status') }}
                            </label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" 
                                           name="is_active" 
                                           value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}
                                           class="form-checkbox">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                        {{ __('app.category_active') }}
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="btn btn-outline-secondary">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('app.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Icon Selector Modal -->
<div id="iconSelectorModal" class="fixed inset-0 bg-black bg-opacity-75 overflow-y-auto h-full w-full hidden z-50 backdrop-blur-sm">
    <div class="relative top-10 mx-auto p-6 border-0 w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2 shadow-2xl rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700">
        <div class="mt-2">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('app.select_category_icon') }}
                </h3>
                <button onclick="closeIconSelector()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors duration-200 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Search Box -->
            <div class="mb-4">
                <div class="relative">
                    <input type="text" 
                           id="iconSearch" 
                           placeholder="البحث في الأيقونات..." 
                           class="w-full px-4 py-2 pl-10 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-6 sm:grid-cols-8 md:grid-cols-10 gap-3 max-h-96 overflow-y-auto p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                @php
                    $icons = [
                        // التكنولوجيا
                        'laptop', 'mobile-alt', 'tablet-alt', 'desktop', 'server', 'database', 'microchip', 'wifi', 'bluetooth',
                        // التجارة
                        'shopping-cart', 'shopping-bag', 'store', 'credit-card', 'money-bill', 'wallet', 'coins', 'receipt',
                        // التواصل
                        'phone', 'envelope', 'comment', 'comments', 'paper-plane', 'globe', 'link', 'share',
                        // الترفيه
                        'gamepad', 'film', 'music', 'video', 'camera', 'headphones', 'tv', 'radio',
                        // النقل
                        'car', 'plane', 'ship', 'train', 'bicycle', 'motorcycle', 'truck', 'rocket',
                        // الطعام والشراب
                        'coffee', 'utensils', 'pizza-slice', 'hamburger', 'ice-cream', 'wine-glass', 'beer', 'cocktail',
                        // الرياضة
                        'futbol', 'basketball-ball', 'volleyball-ball', 'table-tennis', 'swimming-pool', 'dumbbell', 'running', 'medal',
                        // التعليم
                        'book', 'graduation-cap', 'chalkboard-teacher', 'school', 'university', 'pencil-alt', 'pen', 'ruler',
                        // الصحة
                        'heart', 'stethoscope', 'pills', 'hospital', 'ambulance', 'user-md', 'thermometer', 'band-aid',
                        // الطبيعة
                        'leaf', 'tree', 'sun', 'moon', 'cloud', 'rain', 'snowflake', 'umbrella',
                        // الحيوانات
                        'paw', 'dog', 'cat', 'fish', 'bird', 'horse', 'cow', 'pig',
                        // المنزل
                        'home', 'bed', 'couch', 'chair', 'table', 'lamp', 'door-open', 'window-maximize',
                        // الأدوات
                        'wrench', 'hammer', 'screwdriver', 'drill', 'saw', 'paint-roller', 'brush', 'ruler-combined',
                        // الأمان
                        'lock', 'shield-alt', 'key', 'fingerprint', 'eye', 'eye-slash', 'user-shield', 'user-lock',
                        // التنقل
                        'map', 'map-marker-alt', 'compass', 'route', 'location-arrow', 'crosshairs', 'street-view', 'satellite',
                        // الأيقونات العامة
                        'star', 'heart', 'gem', 'crown', 'trophy', 'medal', 'award', 'certificate',
                        'user', 'users', 'user-friends', 'user-plus', 'user-minus', 'user-edit', 'user-cog', 'user-tie',
                        'cog', 'cogs', 'settings', 'tools', 'wrench', 'screwdriver', 'hammer', 'saw',
                        'calendar', 'clock', 'hourglass', 'stopwatch', 'alarm-clock', 'calendar-alt', 'calendar-check', 'calendar-plus',
                        'search', 'filter', 'sort', 'list', 'th-large', 'th', 'th-list', 'bars',
                        'plus', 'minus', 'times', 'check', 'check-circle', 'times-circle', 'exclamation-triangle', 'info-circle',
                        'arrow-up', 'arrow-down', 'arrow-left', 'arrow-right', 'chevron-up', 'chevron-down', 'chevron-left', 'chevron-right',
                        'download', 'upload', 'cloud-download-alt', 'cloud-upload-alt', 'file', 'folder', 'folder-open', 'file-alt',
                        'trash', 'recycle', 'trash-alt', 'dumpster', 'dumpster-fire', 'fire', 'fire-extinguisher', 'smoke',
                        'lightbulb', 'lightbulb-on', 'lightbulb-slash', 'lightbulb-exclamation', 'bolt', 'zap', 'flash', 'sparkles'
                    ];
                @endphp
                
                @foreach($icons as $icon)
                <button type="button" 
                        onclick="selectIcon('{{ $icon }}')"
                        class="icon-selector-btn p-3 border-2 border-gray-200 dark:border-gray-600 rounded-lg hover:border-primary-500 dark:hover:border-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all duration-200 group bg-white dark:bg-gray-700 shadow-sm">
                    <i class="fas fa-{{ $icon }} text-lg text-gray-600 dark:text-gray-400 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-200"></i>
                </button>
                @endforeach
            </div>
            
            <div class="mt-6 flex justify-end">
                <button onclick="closeIconSelector()" class="btn btn-outline-secondary">
                    {{ __('app.cancel') }}
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openIconSelector() {
    document.getElementById('iconSelectorModal').classList.remove('hidden');
    // Focus on search input when modal opens
    setTimeout(() => {
        document.getElementById('iconSearch').focus();
    }, 100);
}

function closeIconSelector() {
    document.getElementById('iconSelectorModal').classList.add('hidden');
    // Clear search when closing
    document.getElementById('iconSearch').value = '';
    filterIcons('');
}

function selectIcon(icon) {
    document.getElementById('icon').value = icon;
    closeIconSelector();
}

function filterIcons(searchTerm) {
    const iconButtons = document.querySelectorAll('.icon-selector-btn');
    const searchLower = searchTerm.toLowerCase();
    
    iconButtons.forEach(button => {
        const iconName = button.querySelector('i').className;
        if (iconName.toLowerCase().includes(searchLower)) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }
    });
}

// Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('iconSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            filterIcons(e.target.value);
        });
    }
});

// Close modal when clicking outside
document.getElementById('iconSelectorModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeIconSelector();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeIconSelector();
    }
});
</script>
@endpush 