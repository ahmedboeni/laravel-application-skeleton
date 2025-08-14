@extends('layouts.app')

@section('title', __('app.provider_details'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.provider_details') }}: {{ $provider['name'] }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.provider_details_description', ['default' => 'تفاصيل مزود الخدمة وإحصائياته']) }}
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <button onclick="testProvider()" 
                            class="btn btn-warning">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __('app.test_provider') }}
                    </button>
                    <button onclick="getBalance()" 
                            class="btn btn-success">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        {{ __('app.get_balance') }}
                    </button>
                    <a href="{{ route('admin.providers.index') }}" 
                       class="btn btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('app.back_to_providers') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Provider Information -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Provider Details -->
            <div class="lg:col-span-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('app.provider_information') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.provider_name') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $provider['name'] }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.provider_type') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $provider['type'] }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.status') }}
                                </label>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $provider['is_active'] ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ $provider['is_active'] ? __('app.active') : __('app.inactive') }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.current_balance') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-white" id="currentBalance">
                                    {{ __('app.loading') }}...
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.last_test') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $provider['last_test'] ?? __('app.never') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('app.description') }}
                                </label>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $provider['description'] ?? __('app.no_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="lg:col-span-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('app.quick_statistics') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="space-y-4">
                            <!-- Total Orders -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_orders') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($stats['total_orders']) }}</span>
                            </div>
                            
                            <!-- Successful Orders -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.successful_orders') }}</span>
                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">{{ number_format($stats['successful_orders']) }}</span>
                            </div>
                            
                            <!-- Failed Orders -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.failed_orders') }}</span>
                                <span class="text-sm font-semibold text-red-600 dark:text-red-400">{{ number_format($stats['failed_orders']) }}</span>
                            </div>
                            
                            <!-- Success Rate -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.success_rate') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($stats['success_rate'], 1) }}%</span>
                            </div>
                            
                            <!-- Average Response Time -->
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.avg_response_time') }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $stats['avg_response_time'] ? number_format($stats['avg_response_time'], 2) . 's' : __('app.n/a') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        {{ __('app.recent_orders') }}
                    </h3>
                    <a href="{{ route('admin.purchase-requests.index', ['provider' => $provider['id']]) }}" 
                       class="btn btn-primary btn-sm">
                        {{ __('app.view_all_orders') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(count($recentOrders) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.order_id') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.service') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.amount') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.status') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.created_at') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $order->service->name ?? __('app.unknown_service') }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $order->service_option->name ?? '' }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {{ number_format($order->amount, 2) }} {{ __('app.currency') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                                   ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                                                   'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                                {{ __('app.status_' . $order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $order->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.purchase-requests.show', $order->id) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                {{ __('app.view') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_orders') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.no_orders_description') }}</p>
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

function testProvider() {
    showLoading('{{ __("app.testing_provider") }}...');
    
    fetch('{{ route("admin.providers.test") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ provider_id: '{{ $provider["id"] }}' })
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

function getBalance() {
    showLoading('{{ __("app.getting_balance") }}...');
    
    fetch('{{ route("admin.providers.balance") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ provider_id: '{{ $provider["id"] }}' })
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            document.getElementById('currentBalance').textContent = data.balance;
        } else {
            alert('{{ __("app.error_getting_balance") }}: ' + data.message);
        }
    })
    .catch(error => {
        hideLoading();
        alert('{{ __("app.error_getting_balance") }}: ' + error.message);
    });
}

// Load balance on page load
document.addEventListener('DOMContentLoaded', function() {
    getBalance();
});
</script>
@endsection 