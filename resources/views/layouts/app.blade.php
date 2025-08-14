<!DOCTYPE html>
<html lang="{{ $currentLocale ?? app()->getLocale() }}" dir="{{ $currentDirection ?? (app()->getLocale() === 'ar' ? 'rtl' : 'ltr') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', \App\Helpers\AppHelper::getSiteName())</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
    
    <!-- Meta Tags -->
    <meta name="description" content="@yield('description', \App\Helpers\AppHelper::getMetaDescription())">
    <meta name="keywords" content="@yield('keywords', 'dashboard, management, business, electronic')">
            <meta name="author" content="{{ \App\Helpers\AppHelper::getAuthor() }}">
    
    <!-- Open Graph -->
            <meta property="og:title" content="@yield('title', \App\Helpers\AppHelper::getMetaTitle())">
    <meta property="og:description" content="@yield('description', \App\Helpers\AppHelper::getMetaDescription())">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-200" 
      x-data="{ 
          sidebarOpen: false,
          darkMode: localStorage.getItem('darkMode') === 'true',
          locale: '{{ app()->getLocale() }}',
          direction: '{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}'
      }"
      x-init="
          $watch('darkMode', value => {
              localStorage.setItem('darkMode', value);
              document.documentElement.classList.toggle('dark', value);
          });
          $watch('locale', value => {
              localStorage.setItem('locale', value);
              document.documentElement.lang = value;
              document.documentElement.dir = value === 'ar' ? 'rtl' : 'ltr';
              direction = value === 'ar' ? 'rtl' : 'ltr';
          });
      "
      :class="{ 'font-arabic': locale === 'ar', 'rtl': direction === 'rtl', 'ltr': direction === 'ltr' }">

    <!-- Loading Spinner -->
    <div id="loading" class="fixed inset-0 bg-white dark:bg-gray-900 z-50 flex items-center justify-center" style="display: none;">
        <div class="spinner"></div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar" 
         class="sidebar transition-transform duration-300 ease-in-out"
         :class="{ 
             'translate-x-0': sidebarOpen,
             '-translate-x-full': !sidebarOpen,
             'translate-x-full': direction === 'rtl' && !sidebarOpen,
             '-translate-x-full': direction === 'rtl' && sidebarOpen
         }"
         x-show="sidebarOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        @include('layouts.partials.sidebar')
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col">
        <!-- Top Navigation -->
        @include('layouts.partials.navigation')

        <!-- Page Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.partials.footer')
    </div>

    <!-- Modals -->
    @stack('modals')

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2" 
         :class="{ 'left-4 right-auto': direction === 'rtl' }"></div>

    <!-- Scripts -->
    @stack('scripts')
    
    <!-- Page Specific Scripts -->
    <script>
        // Language switching function
        function switchLanguage(locale) {
            // Show loading spinner
            const loading = document.getElementById('loading');
            if (loading) {
                loading.style.display = 'flex';
            }

            // Always redirect to the language switch route
            var redirectUrl = '{{ url("/language") }}/' + locale + '?redirect=' + encodeURIComponent(window.location.pathname + window.location.search);
            window.location.href = redirectUrl;
        }
        
        // Hide loading spinner when page is fully loaded
        window.addEventListener('load', function() {
            const loading = document.getElementById('loading');
            if (loading) {
                loading.style.display = 'none';
            }
        });
        
        // Show loading spinner on navigation
        document.addEventListener('click', function(e) {
            if (e.target.tagName === 'A' && e.target.href && !e.target.href.includes('#')) {
                const loading = document.getElementById('loading');
                if (loading) {
                    loading.style.display = 'flex';
                }
            }
        });
        
        // Handle form submissions
        document.addEventListener('submit', function(e) {
            if (e.target.tagName === 'FORM') {
                const loading = document.getElementById('loading');
                if (loading) {
                    loading.style.display = 'flex';
                }
            }
        });
    </script>
</body>
</html> 