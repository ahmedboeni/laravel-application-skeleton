@extends('layouts.app')

@section('title', __('app.my_wallets'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ __('app.my_wallets') }}
            </h1>
            <a href="{{ route('wallets.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>
                {{ __('app.create_wallet') }}
            </a>
        </div>
        <p class="text-gray-600 dark:text-gray-400 mt-2">
            {{ __('app.wallets_description') }}
        </p>
    </div>

    <!-- إحصائيات المحافظ -->
    @if(isset($statistics) && $statistics['success'])
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                    <i class="fas fa-wallet text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('app.total_balance') }}
                    </p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ number_format($statistics['statistics']['total_balance'], 2) }} USDT
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                    <i class="fas fa-arrow-down text-green-600 dark:text-green-400 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('app.total_received') }}
                    </p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ number_format($statistics['statistics']['total_received'], 2) }} USDT
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                    <i class="fas fa-clock text-yellow-600 dark:text-yellow-400 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('app.pending_deposits') }}
                    </p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ $statistics['statistics']['pending_deposits'] }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                    <i class="fas fa-chart-line text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('app.success_rate') }}
                    </p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ number_format($statistics['statistics']['success_rate'], 1) }}%
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- قائمة المحافظ -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ __('app.wallets_list') }}
            </h2>
        </div>

        <div class="p-6">
            @if(isset($wallets) && count($wallets) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($wallets as $wallet)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 border border-gray-200 dark:border-gray-600">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $wallet->currency }} {{ __('app.wallet') }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $wallet->provider->name ?? 'Unknown Provider' }}
                                </p>
                            </div>
                            <div class="flex items-center">
                                @if($wallet->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        {{ __('app.active') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        {{ __('app.inactive') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.address') }}</p>
                                <p class="text-sm font-mono text-gray-900 dark:text-white break-all">
                                    {{ $wallet->full_address }}
                                </p>
                            </div>

                            @if($wallet->network)
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.network') }}</p>
                                <p class="text-sm text-gray-900 dark:text-white">{{ $wallet->network }}</p>
                            </div>
                            @endif

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.balance') }}</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($wallet->balance, 8) }} {{ $wallet->currency }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('app.total_received') }}</p>
                                <p class="text-sm text-gray-900 dark:text-white">
                                    {{ number_format($wallet->total_received, 8) }} {{ $wallet->currency }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 flex space-x-2">
                            <a href="{{ route('wallets.show', $wallet) }}" 
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-lg text-sm font-medium transition duration-200">
                                {{ __('app.view_details') }}
                            </a>
                            
                            @if($wallet->is_active)
                            <button onclick="checkDeposits({{ $wallet->id }})" 
                                    class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition duration-200">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mx-auto h-12 w-12 text-gray-400">
                        <i class="fas fa-wallet text-4xl"></i>
                    </div>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('app.no_wallets') }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('app.no_wallets_description') }}
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('wallets.create') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-plus mr-2"></i>
                            {{ __('app.create_first_wallet') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-xl">
            <div class="flex items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <p class="ml-3 text-gray-900 dark:text-white">{{ __('app.checking_deposits') }}...</p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function checkDeposits(walletId) {
    if (!confirm('{{ __("app.confirm_check_deposits") }}')) return;
    
    showLoading();
    
    fetch(`/wallets/${walletId}/check-deposits`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        
        if (data.success) {
            showSuccess(data.message);
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            showError(data.message);
        }
    })
    .catch(error => {
        hideLoading();
        showError('{{ __("app.error_checking_deposits") }}');
        console.error('Error:', error);
    });
}

function showLoading() {
    document.getElementById('loadingModal').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loadingModal').classList.add('hidden');
}

function showSuccess(message) {
    // يمكن استخدام مكتبة إشعارات أو alert بسيط
    alert('✅ ' + message);
}

function showError(message) {
    // يمكن استخدام مكتبة إشعارات أو alert بسيط
    alert('❌ ' + message);
}
</script>
@endpush 