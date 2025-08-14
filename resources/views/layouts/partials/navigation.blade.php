<nav class="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side -->
            <div class="flex items-center">
                <!-- Sidebar toggle -->
                <button id="sidebar-toggle" 
                        @click="sidebarOpen = !sidebarOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500 transition-colors duration-200">
                    <span class="sr-only">{{ __('app.open_menu') }}</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center mr-4" :class="{ 'ml-4 mr-0': direction === 'rtl' }">
                    <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                        <span class="text-primary-600">{{ \App\Helpers\AppHelper::getSiteName() }}</span>
                    </a>
                </div>

                <!-- Search -->
                <div class="hidden md:block flex-1 max-w-lg ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none" 
                             :class="{ 'right-0 left-auto pr-3': direction === 'rtl' }">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" 
                               data-search-input
                               placeholder="{{ __('app.search_placeholder') }}"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500"
                               :class="{ 'pr-10 pl-3': direction === 'rtl' }">
                    </div>
                </div>
            </div>

            <!-- Right side -->
            <div class="flex items-center space-x-4" :class="{ 'space-x-reverse': direction === 'rtl' }">
                <!-- Language Switcher -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <span class="text-gray-700 dark:text-gray-300">
                            {{ app()->getLocale() === 'ar' ? __('app.arabic') : __('app.english') }}
                        </span>
                        <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             :class="{ 'mr-2 ml-0': direction === 'rtl' }">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50"
                         :class="{ 'left-0 right-auto': direction === 'rtl' }">
                        <div class="py-1">
                            <a href="{{ url('/language/ar') }}?redirect={{ urlencode(request()->path()) }}" 
                               onclick="document.getElementById('loading').style.display='flex';"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('app.arabic') }}
                            </a>
                            <a href="{{ url('/language/en') }}?redirect={{ urlencode(request()->path()) }}" 
                               onclick="document.getElementById('loading').style.display='flex';"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('app.english') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode"
                        class="p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors duration-200">
                                            <span class="sr-only">{{ __('app.dark_mode') }}</span>
                    <svg x-show="!darkMode" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <!-- Notifications -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors duration-200">
                        <span class="sr-only">{{ __('app.notifications') }}</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.19 4.19A4 4 0 004 6v6a4 4 0 004 4h6a4 4 0 004-4V6a4 4 0 00-4-4H8a4 4 0 00-2.81 1.19z" />
                        </svg>
                        <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-danger-400 ring-2 ring-white dark:ring-gray-800"></span>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50"
                         :class="{ 'left-0 right-auto': direction === 'rtl' }">
                        <div class="py-1">
                            <div class="px-4 py-2 text-sm text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
                                <strong>{{ __('app.notifications') }}</strong>
                            </div>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-8 w-8 rounded-full bg-primary-500 flex items-center justify-center">
                                            <span class="text-white text-xs">A</span>
                                        </div>
                                    </div>
                                    <div class="ml-3" :class="{ 'mr-3 ml-0': direction === 'rtl' }">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ __('app.new_request') }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.new_purchase_request_received') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                            class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&color=7C3AED&background=EBF4FF" alt="{{ auth()->user()->name ?? 'User' }}">
                        <span class="ml-2 text-gray-700 dark:text-gray-300 hidden md:block" :class="{ 'mr-2 ml-0': direction === 'rtl' }">
                            {{ auth()->user()->name ?? 'User' }}
                        </span>
                        <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                             :class="{ 'mr-2 ml-0': direction === 'rtl' }">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 z-50"
                         :class="{ 'left-0 right-auto': direction === 'rtl' }">
                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}" 
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('app.profile') }}
                            </a>
                            <a href="{{ route('admin.settings.index') }}" 
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('app.settings') }}
                            </a>
                            <hr class="border-gray-200 dark:border-gray-700">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ __('app.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav> 