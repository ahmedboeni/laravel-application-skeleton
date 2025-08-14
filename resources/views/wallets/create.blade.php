@extends('layouts.app')

@section('title', __('app.create_wallet'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="flex items-center">
                <a href="{{ route('wallets.index') }}" class="text-blue-600 hover:text-blue-700 mr-4">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ __('app.create_wallet') }}
                </h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                {{ __('app.create_wallet_description') }}
            </p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{ __('app.wallet_information') }}
                </h2>
            </div>

            <form action="{{ route('wallets.store') }}" method="POST" class="p-6">
                @csrf

                <!-- العملة -->
                <div class="mb-6">
                    <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('app.currency') }} <span class="text-red-500">*</span>
                    </label>
                    <select id="currency" name="currency" required 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">{{ __('app.select_currency') }}</option>
                        <option value="USDT" {{ old('currency') == 'USDT' ? 'selected' : '' }}>USDT (Tether)</option>
                        <option value="BTC" {{ old('currency') == 'BTC' ? 'selected' : '' }}>BTC (Bitcoin)</option>
                        <option value="ETH" {{ old('currency') == 'ETH' ? 'selected' : '' }}>ETH (Ethereum)</option>
                        <option value="BNB" {{ old('currency') == 'BNB' ? 'selected' : '' }}>BNB (Binance Coin)</option>
                    </select>
                    @error('currency')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- الشبكة -->
                <div class="mb-6">
                    <label for="network" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('app.network') }}
                    </label>
                    <select id="network" name="network" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">{{ __('app.select_network') }}</option>
                        <option value="TRC20" {{ old('network') == 'TRC20' ? 'selected' : '' }}>TRC20 (Tron)</option>
                        <option value="BSC" {{ old('network') == 'BSC' ? 'selected' : '' }}>BSC (Binance Smart Chain)</option>
                        <option value="ERC20" {{ old('network') == 'ERC20' ? 'selected' : '' }}>ERC20 (Ethereum)</option>
                        <option value="BTC" {{ old('network') == 'BTC' ? 'selected' : '' }}>BTC (Bitcoin)</option>
                    </select>
                    @error('network')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- المزود -->
                @if(isset($providers) && count($providers) > 0)
                <div class="mb-6">
                    <label for="provider_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('app.provider') }}
                    </label>
                    <select id="provider_id" name="provider_id" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="">{{ __('app.select_provider') }}</option>
                        @foreach($providers as $provider)
                            <option value="{{ $provider->id }}" {{ old('provider_id') == $provider->id ? 'selected' : '' }}>
                                {{ $provider->name }} ({{ $provider->type }})
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {{ __('app.provider_optional_description') }}
                    </p>
                    @error('provider_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <!-- معلومات إضافية -->
                <div class="mb-6">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                    {{ __('app.wallet_creation_info') }}
                                </h3>
                                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>{{ __('app.wallet_creation_info_1') }}</li>
                                        <li>{{ __('app.wallet_creation_info_2') }}</li>
                                        <li>{{ __('app.wallet_creation_info_3') }}</li>
                                        <li>{{ __('app.wallet_creation_info_4') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- أزرار التحكم -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('wallets.index') }}" 
                       class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                        {{ __('app.cancel') }}
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        {{ __('app.create_wallet') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const currencySelect = document.getElementById('currency');
    const networkSelect = document.getElementById('network');
    
    // تحديث الشبكات المتاحة حسب العملة المختارة
    currencySelect.addEventListener('change', function() {
        const currency = this.value;
        networkSelect.innerHTML = '<option value="">{{ __("app.select_network") }}</option>';
        
        if (currency === 'USDT') {
            networkSelect.innerHTML += `
                <option value="TRC20">TRC20 (Tron)</option>
                <option value="BSC">BSC (Binance Smart Chain)</option>
                <option value="ERC20">ERC20 (Ethereum)</option>
            `;
        } else if (currency === 'BTC') {
            networkSelect.innerHTML += `
                <option value="BTC">BTC (Bitcoin)</option>
            `;
        } else if (currency === 'ETH') {
            networkSelect.innerHTML += `
                <option value="ERC20">ERC20 (Ethereum)</option>
            `;
        } else if (currency === 'BNB') {
            networkSelect.innerHTML += `
                <option value="BSC">BSC (Binance Smart Chain)</option>
            `;
        }
    });
});
</script>
@endpush 