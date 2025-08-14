@extends('layouts.app')

@section('title', __('app.wallet_details'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <div class="flex items-center">
            <a href="{{ route('wallets.index') }}" class="text-blue-600 hover:text-blue-700 mr-4">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ __('app.wallet_details') }}
            </h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- تفاصيل المحفظة -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{ __('app.wallet_information') }}
                    </h2>
                </div>

                <div class="p-6 space-y-6">
                    <!-- حالة المحفظة -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('app.status') }}
                        </span>
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

                    <!-- العملة -->
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.currency') }}</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $wallet->currency }}</p>
                    </div>

                    <!-- العنوان -->
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.address') }}</p>
                        <div class="mt-1 flex items-center">
                            <p class="text-sm font-mono text-gray-900 dark:text-white break-all flex-1">
                                {{ $wallet->full_address }}
                            </p>
                            <button onclick="copyToClipboard('{{ $wallet->full_address }}')" 
                                    class="ml-2 text-blue-600 hover:text-blue-700">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    @if($wallet->network)
                    <!-- الشبكة -->
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.network') }}</p>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $wallet->network }}</p>
                    </div>
                    @endif

                    @if($wallet->tag)
                    <!-- Tag -->
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.tag') }}</p>
                        <div class="mt-1 flex items-center">
                            <p class="text-sm font-mono text-gray-900 dark:text-white flex-1">{{ $wallet->tag }}</p>
                            <button onclick="copyToClipboard('{{ $wallet->tag }}')" 
                                    class="ml-2 text-blue-600 hover:text-blue-700">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    @endif

                    <!-- المزود -->
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.provider') }}</p>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $wallet->provider->name ?? 'Unknown' }}</p>
                    </div>

                    <!-- الرصيد الحالي -->
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.current_balance') }}</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($wallet->balance, 8) }} {{ $wallet->currency }}
                        </p>
                    </div>

                    <!-- إجمالي المستلم -->
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_received') }}</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ number_format($wallet->total_received, 8) }} {{ $wallet->currency }}
                        </p>
                    </div>

                    <!-- آخر فحص -->
                    @if($wallet->last_checked)
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.last_checked') }}</p>
                        <p class="text-sm text-gray-900 dark:text-white">
                            {{ $wallet->last_checked->format('Y-m-d H:i:s') }}
                        </p>
                    </div>
                    @endif

                    <!-- تاريخ الإنشاء -->
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.created_at') }}</p>
                        <p class="text-sm text-gray-900 dark:text-white">
                            {{ $wallet->created_at->format('Y-m-d H:i:s') }}
                        </p>
                    </div>

                    <!-- أزرار التحكم -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700 space-y-3">
                        @if($wallet->is_active)
                        <button onclick="checkDeposits({{ $wallet->id }})" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition duration-200">
                            <i class="fas fa-sync-alt mr-2"></i>
                            {{ __('app.check_deposits') }}
                        </button>
                        @endif

                        @if($wallet->is_active)
                        <button onclick="deactivateWallet({{ $wallet->id }})" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition duration-200">
                            <i class="fas fa-ban mr-2"></i>
                            {{ __('app.deactivate_wallet') }}
                        </button>
                        @else
                        <button onclick="activateWallet({{ $wallet->id }})" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm font-medium transition duration-200">
                            <i class="fas fa-check mr-2"></i>
                            {{ __('app.activate_wallet') }}
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- قائمة الإيداعات -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ __('app.deposits_history') }}
                        </h2>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $deposits->total() }} {{ __('app.deposits') }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    @if($deposits->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('app.amount') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('app.status') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('app.confirmations') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('app.date') }}
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('app.actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($deposits as $deposit)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ number_format($deposit->amount, 8) }} {{ $deposit->currency }}
                                            </div>
                                            @if($deposit->fee > 0)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('app.fee') }}: {{ number_format($deposit->fee, 8) }}
                                            </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                @if($deposit->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                                @elseif($deposit->status === 'confirmed') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                                @elseif($deposit->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                                @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                                {{ $deposit->status_text }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {{ $deposit->confirmations }}/{{ $deposit->required_confirmations }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                            {{ $deposit->deposited_at->format('Y-m-d H:i:s') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($deposit->txid)
                                            <button onclick="copyToClipboard('{{ $deposit->txid }}')" 
                                                    class="text-blue-600 hover:text-blue-700 mr-2" 
                                                    title="{{ __('app.copy_txid') }}">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                            @endif
                                            <button onclick="viewDepositDetails({{ $deposit->id }})" 
                                                    class="text-gray-600 hover:text-gray-700" 
                                                    title="{{ __('app.view_details') }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $deposits->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="mx-auto h-12 w-12 text-gray-400">
                                <i class="fas fa-inbox text-4xl"></i>
                            </div>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('app.no_deposits') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('app.no_deposits_description') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-xl">
            <div class="flex items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                <p class="ml-3 text-gray-900 dark:text-white">{{ __('app.processing') }}...</p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        showSuccess('{{ __("app.copied_to_clipboard") }}');
    }, function(err) {
        showError('{{ __("app.failed_to_copy") }}');
    });
}

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

function deactivateWallet(walletId) {
    if (!confirm('{{ __("app.confirm_deactivate_wallet") }}')) return;
    
    showLoading();
    
    fetch(`/wallets/${walletId}/deactivate`, {
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
        showError('{{ __("app.error_deactivating_wallet") }}');
        console.error('Error:', error);
    });
}

function activateWallet(walletId) {
    if (!confirm('{{ __("app.confirm_activate_wallet") }}')) return;
    
    showLoading();
    
    fetch(`/wallets/${walletId}/activate`, {
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
        showError('{{ __("app.error_activating_wallet") }}');
        console.error('Error:', error);
    });
}

function viewDepositDetails(depositId) {
    // يمكن إضافة modal لعرض تفاصيل الإيداع
    alert('{{ __("app.deposit_details_modal") }}');
}

function showLoading() {
    document.getElementById('loadingModal').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loadingModal').classList.add('hidden');
}

function showSuccess(message) {
    alert('✅ ' + message);
}

function showError(message) {
    alert('❌ ' + message);
}
</script>
@endpush 