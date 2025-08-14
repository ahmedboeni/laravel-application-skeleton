<div class="flex flex-col h-full bg-white dark:bg-gray-800 shadow-lg">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="h-8 w-8 bg-primary-600 rounded-lg flex items-center justify-center">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
            <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">{{ \App\Helpers\AppHelper::getSiteName() }}</h1>
            </div>
        </div>
        <button @click="sidebarOpen = false" 
                class="p-1 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
            <span class="sr-only">{{ __('app.close_menu') }}</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar Content -->
    <div class="flex-1 flex flex-col overflow-y-auto">
        <nav class="flex-1 px-2 py-4 space-y-1">
            @auth
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                </svg>
                {{ __('app.dashboard') }}
            </a>

            <!-- Users Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-link w-full text-left">
                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                    </svg>
                    {{ __('app.user_management') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform duration-200"
                         :class="{ 'rotate-180': open, 'mr-auto ml-0': direction === 'rtl' }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.users.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.view') }} {{ __('app.users') }}
                        </a>
                        <a href="{{ route('admin.users.create') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.add_user') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Activity Logs -->
            <a href="{{ route('admin.activity-logs.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">
                <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                {{ __('app.activity_logs') }}
            </a>

            <!-- Provider Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.providers.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-link w-full text-left">
                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    {{ __('app.provider_management') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform duration-200"
                         :class="{ 'rotate-180': open, 'mr-auto ml-0': direction === 'rtl' }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.providers.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.view') }} {{ __('app.providers') }}
                        </a>
                        <a href="{{ route('admin.providers.statistics') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.provider_statistics') }}
                        </a>
                        <a href="{{ route('admin.providers.ccxt-test') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            🧪 اختبار CCXT
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carriers Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.carriers.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-link w-full text-left">
                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ __('app.carrier_management') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform duration-200"
                         :class="{ 'rotate-180': open, 'mr-auto ml-0': direction === 'rtl' }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.carriers.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.view') }} {{ __('app.carriers') }}
                        </a>
                        <a href="{{ route('admin.carriers.create') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.add_carrier') }}
                        </a>
                        <a href="{{ route('admin.carriers.statistics') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.carrier_statistics') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Wallet Management -->
            <a href="{{ route('wallets.index') }}" 
               class="sidebar-link {{ request()->routeIs('wallets.*') ? 'active' : '' }}">
                <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                {{ __('app.my_wallets') }}
            </a>

            <!-- Available Tabs Management - REMOVED (merged into Carriers) -->

            <!-- Categories Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.categories.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-link w-full text-left">
                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    {{ __('app.category_management') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform duration-200"
                         :class="{ 'rotate-180': open, 'mr-auto ml-0': direction === 'rtl' }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.view') }} {{ __('app.categories') }}
                        </a>
                        <a href="{{ route('admin.categories.create') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.add_category') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Services Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.services.*', 'admin.service-provider-mappings.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-link w-full text-left">
                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    {{ __('app.service_management') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform duration-200"
                         :class="{ 'rotate-180': open, 'mr-auto ml-0': direction === 'rtl' }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.services.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.view') }} {{ __('app.services') }}
                        </a>
                        <a href="{{ route('admin.services.create') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.add_service') }}
                        </a>
                        <a href="{{ route('admin.service-provider-mappings.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            <svg class="mr-2 h-4 w-4" :class="{ 'ml-2 mr-0': direction === 'rtl' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            ربط الخدمات بالمزودين
                        </a>
                    </div>
                </div>
            </div>

            <!-- Transactions -->
            <a href="{{ route('admin.transactions.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}">
                <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                </svg>
                {{ __('app.transactions') }}
            </a>

            <!-- Payment Methods -->
            <a href="{{ route('admin.payment-methods.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}">
                <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                {{ __('app.payment_method') }}
            </a>

            <!-- Purchase Requests -->
            <a href="{{ route('admin.purchase-requests.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.purchase-requests.*') ? 'active' : '' }}">
                <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                {{ __('app.purchase_requests') }}
            </a>

            <!-- Advertisements -->
            <a href="{{ route('admin.advertisements.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.advertisements.*') ? 'active' : '' }}">
                <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>
                {{ __('app.advertisements') }}
            </a>

            <!-- Notifications Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.notifications.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-link w-full text-left">
                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4 19h6v-2H4v2zM20 4H4v2h16V4zM4 10h16v2H4v-2zM4 14h16v2H4v-2z" />
                    </svg>
                    {{ __('app.notifications') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform duration-200"
                         :class="{ 'rotate-180': open, 'mr-auto ml-0': direction === 'rtl' }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.notifications.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.view') }} {{ __('app.notifications') }}
                        </a>
                        <a href="{{ route('admin.notifications.create') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.send_notification') }}
                        </a>
                        <a href="{{ route('admin.notifications.statistics') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.notification_statistics') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Marketing Offers Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.marketing-offers.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-link w-full text-left">
                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                    {{ __('app.marketing_offers') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform duration-200"
                         :class="{ 'rotate-180': open, 'mr-auto ml-0': direction === 'rtl' }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.marketing-offers.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.view') }} {{ __('app.marketing_offers') }}
                        </a>
                        <a href="{{ route('admin.marketing-offers.create') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.create_offer') }}
                        </a>
                        <a href="{{ route('admin.marketing-offers.statistics') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.offer_statistics') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Service Options Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.service-options.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="sidebar-link w-full text-left">
                    <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('app.service_options') }}
                    <svg class="ml-auto h-4 w-4 transform transition-transform duration-200"
                         :class="{ 'rotate-180': open, 'mr-auto ml-0': direction === 'rtl' }"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                    <div class="mt-1 space-y-1">
                        <a href="{{ route('admin.service-options.index') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.view') }} {{ __('app.options') }}
                        </a>
                        <a href="{{ route('admin.service-options.create') }}" 
                           class="group flex items-center px-8 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-md hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-700">
                            {{ __('app.add_option') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <a href="{{ route('admin.settings.index') }}" 
               class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <svg class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     :class="{ 'ml-3 mr-0': direction === 'rtl' }">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ __('app.settings') }}
            </a>
            @endauth
        </nav>
    </div>

    @auth
    <!-- Sidebar Footer -->
    <div class="flex-shrink-0 p-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8 rounded-full" 
                         src="https://ui-avatars.com/api/?name={{ auth()->user()->username ?? 'User' }}&color=7C3AED&background=EBF4FF" 
                         alt="{{ auth()->user()->username ?? 'User' }}">
                </div>
                <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ auth()->user()->username ?? 'User' }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ auth()->user()->role === 'admin' ? __('app.admin') : __('app.user') }}
                    </p>
                </div>
            </div>
            
            <!-- User Menu Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" 
                        class="p-1 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
                
                <div x-show="open" @click.away="open = false" 
                     class="absolute bottom-full mb-2 right-0 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-1 z-50 border border-gray-200 dark:border-gray-700">
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="mr-3 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ __('app.profile') }}
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="mr-3 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            {{ __('app.logout') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth
</div> 