@extends('layouts.app')

@section('title', __('app.provider_management'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.provider_management') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.manage_providers_description', ['default' => 'إدارة مزودي الخدمات الخارجية']) }}
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.providers.create') }}" 
                       class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ __('app.create_provider') }}
                    </a>
                    <button onclick="testAllProviders()" 
                            class="btn btn-warning">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __('app.test_all_providers') }}
                    </button>
                    <button onclick="processOrders()" 
                            class="btn btn-success">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        {{ __('app.process_orders') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Providers -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_providers') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ count($providers) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Providers -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.active_providers') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $activeProviders }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.pending_orders') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $pendingOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Balance -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-danger-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_balance') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($totalBalance, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Providers List -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ __('app.providers_list') }}
                </h3>
            </div>
            <div class="card-body">
                @if(count($providers) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.provider_name') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.provider_type') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.status') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.balance') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.last_test') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($providers as $provider)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="mr-4" :class="{ 'ml-4 mr-0': direction === 'rtl' }">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ $provider['name'] }}
                                                    </div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $provider['description'] ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {{ $provider['type'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $provider['is_active'] ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                {{ $provider['is_active'] ? __('app.active') : __('app.inactive') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            <span class="balance-{{ $provider['id'] }}">
                                                {{ __('app.loading') }}...
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $provider['last_test'] ?? __('app.never') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                                <a href="{{ route('admin.providers.show', $provider['id']) }}" 
                                                   class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    {{ __('app.view') }}
                                                </a>
                                                <a href="{{ route('admin.providers.edit', $provider['id']) }}" 
                                                   class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                    {{ __('app.edit') }}
                                                </a>
                                                <a href="{{ route('admin.providers.config.index', $provider['id']) }}" 
                                                   class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    <i class="fas fa-cog"></i> الإعدادات
                                                </a>
                                                <button data-provider-id="{{ $provider['id'] }}" 
                                                        class="test-provider-btn text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    {{ __('app.test') }}
                                                </button>
                                                <button data-provider-id="{{ $provider['id'] }}" 
                                                        class="get-balance-btn text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                    {{ __('app.balance') }}
                                                </button>
                                                <button data-provider-id="{{ $provider['id'] }}" 
                                                        class="get-services-btn text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300">
                                                    {{ __('app.services') }}
                                                </button>
                                                <button data-provider-id="{{ $provider['id'] }}" 
                                                        data-provider-name="{{ $provider['name'] }}"
                                                        class="delete-provider-btn text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                    {{ __('app.delete') }}
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_providers') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.no_providers_description') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900">
                <svg class="animate-spin h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mt-4" id="loadingMessage">
                {{ __('app.processing') }}...
            </h3>
        </div>
    </div>
</div>

<script>
function showLoading(message = '{{ __("app.processing") }}...') {
    document.getElementById('loadingMessage').textContent = message;
    document.getElementById('loadingModal').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loadingModal').classList.add('hidden');
}

function testAllProviders() {
    if (!confirm('{{ __("app.confirm_test_all_providers") }}')) return;
    
    showLoading('{{ __("app.testing_all_providers") }}...');
    
    fetch('{{ route("admin.providers.test-all-post") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            alert('{{ __("app.all_providers_tested_successfully") }}');
            location.reload();
        } else {
            alert('{{ __("app.error_testing_providers") }}: ' + data.message);
        }
    })
    .catch(error => {
        hideLoading();
        alert('{{ __("app.error_testing_providers") }}: ' + error.message);
    });
}

function processOrders() {
    if (!confirm('{{ __("app.confirm_process_orders") }}')) return;
    
    showLoading('{{ __("app.processing_orders") }}...');
    
    fetch('{{ route("admin.providers.process-orders") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            alert('{{ __("app.orders_processed_successfully") }}: ' + data.message);
            location.reload();
        } else {
            alert('{{ __("app.error_processing_orders") }}: ' + data.message);
        }
    })
    .catch(error => {
        hideLoading();
        alert('{{ __("app.error_processing_orders") }}: ' + error.message);
    });
}

function testProvider(providerId) {
    showLoading('{{ __("app.testing_provider") }}...');
    
    fetch('{{ route("admin.providers.test") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ provider_id: providerId })
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            alert('{{ __("app.provider_tested_successfully") }}');
            location.reload();
        } else {
            alert('{{ __("app.error_testing_provider") }}: ' + data.message);
        }
    })
    .catch(error => {
        hideLoading();
        alert('{{ __("app.error_testing_provider") }}: ' + error.message);
    });
}

function getBalance(providerId) {
    showLoading('{{ __("app.getting_balance") }}...');
    
    fetch('{{ route("admin.providers.balance") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ provider_id: providerId })
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            document.querySelector('.balance-' + providerId).textContent = data.balance;
        } else {
            alert('{{ __("app.error_getting_balance") }}: ' + data.message);
        }
    })
    .catch(error => {
        hideLoading();
        alert('{{ __("app.error_getting_balance") }}: ' + error.message);
    });
}

function getServices(providerId) {
    showLoading('{{ __("app.getting_services") }}...');
    
    fetch('{{ route("admin.providers.services") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ provider_id: providerId })
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            alert('{{ __("app.services_retrieved_successfully") }}: ' + data.count + ' {{ __("app.services") }}');
        } else {
            alert('{{ __("app.error_getting_services") }}: ' + data.message);
        }
    })
    .catch(error => {
        hideLoading();
        alert('{{ __("app.error_getting_services") }}: ' + error.message);
    });
}

function deleteProvider(providerId, providerName) {
    if (!confirm('{{ __("app.are_you_sure") }}؟ {{ __("app.delete_provider") }}: ' + providerName)) {
        return;
    }
    
    showLoading('{{ __("app.deleting_provider") }}...');
    
    fetch('{{ route("admin.providers.destroy", ":id") }}'.replace(':id', providerId), {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            alert('{{ __("app.provider_deleted_successfully") }}');
            location.reload();
        } else {
            alert('{{ __("app.error_deleting_provider") }}: ' + data.message);
        }
    })
    .catch(error => {
        hideLoading();
        alert('{{ __("app.error_deleting_provider") }}: ' + error.message);
    });
}

// Load balances on page load
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for buttons
    document.querySelectorAll('.test-provider-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const providerId = this.getAttribute('data-provider-id');
            testProvider(providerId);
        });
    });

    document.querySelectorAll('.get-balance-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const providerId = this.getAttribute('data-provider-id');
            getBalance(providerId);
        });
    });

    document.querySelectorAll('.get-services-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const providerId = this.getAttribute('data-provider-id');
            getServices(providerId);
        });
    });

    document.querySelectorAll('.delete-provider-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const providerId = this.getAttribute('data-provider-id');
            const providerName = this.getAttribute('data-provider-name');
            deleteProvider(providerId, providerName);
        });
    });

    // Load initial balances
    document.querySelectorAll('.get-balance-btn').forEach(btn => {
        const providerId = btn.getAttribute('data-provider-id');
        getBalance(providerId);
    });
});
</script>
@endsection 