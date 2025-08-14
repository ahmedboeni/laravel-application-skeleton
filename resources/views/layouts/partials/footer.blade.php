<footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                © {{ date('Y') }} {{ \App\Helpers\AppHelper::getSiteName() }}. {{ __('app.all_rights_reserved') }}
            </div>
            <div class="flex items-center space-x-4" :class="{ 'space-x-reverse': direction === 'rtl' }">
                <a href="#" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                    {{ __('app.terms_of_service') }}
                </a>
                <a href="#" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                    {{ __('app.privacy_policy') }}
                </a>
                <a href="#" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                    {{ __('app.help') }}
                </a>
            </div>
        </div>
    </div>
</footer> 