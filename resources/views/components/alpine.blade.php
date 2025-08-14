{{-- Alpine.js Components Templates --}}

{{-- Modal Component --}}
@component('components.alpine.modal')
    @slot('trigger')
        <button type="button" @click="open = true" class="btn btn-primary">
            {{ $trigger ?? __('app.open') }}
        </button>
    @endslot
    
    @slot('content')
        <div class="modal-overlay" x-show="open" x-transition>
            <div class="modal-content">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">{{ $title ?? __('app.modal') }}</h3>
                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="mb-4">
                    {{ $content ?? '' }}
                </div>
                <div class="flex justify-end space-x-2">
                    <button @click="open = false" class="btn btn-secondary">
                        {{ $cancelText ?? __('app.cancel') }}
                    </button>
                    @if(isset($confirmText))
                        <button @click="$dispatch('modal-confirmed'); open = false" class="btn btn-primary">
                            {{ $confirmText }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endslot
@endcomponent

{{-- Dropdown Component --}}
@component('components.alpine.dropdown')
    @slot('trigger')
        <button type="button" @click="open = !open" class="btn btn-outline">
            {{ $trigger ?? __('app.menu') }}
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    @endslot
    
    @slot('content')
        <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
            <div class="py-1">
                {{ $content ?? '' }}
            </div>
        </div>
    @endslot
@endcomponent

{{-- Tabs Component --}}
@component('components.alpine.tabs')
    @slot('tabs')
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                @foreach($tabs as $index => $tab)
                    <button @click="activeTab = {{ $index }}" 
                            :class="activeTab === {{ $index }} ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </nav>
        </div>
    @endslot
    
    @slot('content')
        @foreach($tabs as $index => $tab)
            <div x-show="activeTab === {{ $index }}" x-transition>
                {{ $tab['content'] }}
            </div>
        @endforeach
    @endslot
@endcomponent

{{-- Accordion Component --}}
@component('components.alpine.accordion')
    @slot('items')
        @foreach($items as $index => $item)
            <div class="border border-gray-200 rounded-lg mb-2">
                <button @click="toggleItem({{ $index }})" 
                        class="w-full px-4 py-3 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <div class="flex justify-between items-center">
                        <span class="font-medium">{{ $item['title'] }}</span>
                        <svg class="w-5 h-5 transform transition-transform" 
                             :class="activeItem === {{ $index }} ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </button>
                <div x-show="activeItem === {{ $index }}" x-transition class="px-4 py-3 border-t border-gray-200">
                    {{ $item['content'] }}
                </div>
            </div>
        @endforeach
    @endslot
@endcomponent

{{-- Toast Notification Component --}}
@component('components.alpine.toast')
    <div class="fixed top-4 right-4 z-50 space-y-2" x-data="toast">
        <template x-for="notification in notifications" :key="notification.id">
            <div class="toast" :class="`toast-${notification.type}`" x-transition>
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5" :class="{
                                'text-success-500': notification.type === 'success',
                                'text-danger-500': notification.type === 'error',
                                'text-warning-500': notification.type === 'warning',
                                'text-primary-500': notification.type === 'info'
                            }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="notification.type === 'success'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                <path x-show="notification.type === 'error'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                <path x-show="notification.type === 'warning'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                <path x-show="notification.type === 'info'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3 w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900" x-text="notification.message"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="remove(notification.id)" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
@endcomponent

{{-- Loading Spinner Component --}}
@component('components.alpine.loading')
    <div x-data="loading" x-show="isLoading" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-primary-100">
                    <svg class="animate-spin h-6 w-6 text-primary-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">{{ __('app.loading') }}</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">{{ __('app.please_wait') }}</p>
                </div>
            </div>
        </div>
    </div>
@endcomponent

{{-- Form Validation Component --}}
@component('components.alpine.form-validation')
    <form x-data="formValidation" @submit.prevent="validateForm() && $el.submit()">
        {{ $slot }}
    </form>
@endcomponent

{{-- Table Component --}}
@component('components.alpine.table')
    <div x-data="table" class="overflow-x-auto">
        <div class="mb-4">
            <input type="text" x-model="searchTerm" @input="search($event.target.value)" 
                   placeholder="{{ __('app.search') }}" class="form-input w-full md:w-64">
        </div>
        
        <table class="table">
            <thead class="table-header">
                <tr>
                    @foreach($columns as $column)
                        <th @click="sort('{{ $column['key'] }}')" class="cursor-pointer">
                            {{ $column['label'] }}
                            <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                            </svg>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="table-body">
                <template x-for="item in paginatedItems" :key="item.id">
                    <tr>
                        @foreach($columns as $column)
                            <td x-text="item.{{ $column['key'] }}"></td>
                        @endforeach
                    </tr>
                </template>
            </tbody>
        </table>
        
        <div class="mt-4 flex justify-between items-center">
            <div class="text-sm text-gray-700">
                {{ __('app.showing') }} <span x-text="(currentPage - 1) * itemsPerPage + 1"></span> {{ __('app.to') }} 
                <span x-text="Math.min(currentPage * itemsPerPage, filteredItems.length)"></span> {{ __('app.of') }} 
                <span x-text="filteredItems.length"></span> {{ __('app.results') }}
            </div>
            
            <div class="flex space-x-2">
                <button @click="goToPage(currentPage - 1)" 
                        :disabled="currentPage === 1"
                        class="btn btn-outline" :class="{ 'opacity-50 cursor-not-allowed': currentPage === 1 }">
                    {{ __('app.previous') }}
                </button>
                
                <template x-for="page in totalPages" :key="page">
                    <button @click="goToPage(page)" 
                            :class="currentPage === page ? 'bg-primary-600 text-white' : 'bg-white text-gray-700'"
                            class="px-3 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                        <span x-text="page"></span>
                    </button>
                </template>
                
                <button @click="goToPage(currentPage + 1)" 
                        :disabled="currentPage === totalPages"
                        class="btn btn-outline" :class="{ 'opacity-50 cursor-not-allowed': currentPage === totalPages }">
                    {{ __('app.next') }}
                </button>
            </div>
        </div>
    </div>
@endcomponent 