@extends('layouts.app')

@section('title', 'اختبار مزود CCXT')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        🧪 اختبار مزود CCXT الموحد
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        اختبار شامل لجميع خدمات مزود CCXT للعملات الرقمية
                    </p>
                </div>
                <div class="flex space-x-3" :class="{ 'space-x-reverse': direction === 'rtl' }">
                    <a href="{{ route('admin.providers.index') }}" 
                       class="btn btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        العودة للمزودين
                    </a>
                    <button onclick="testAllCCXTServices()" 
                            class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        اختبار جميع الخدمات
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Connection Status -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-blue-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">حالة الاتصال</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="connectionStatus">غير محدد</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exchange Balance -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-green-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">رصيد المنصة</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="exchangeBalance">0.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Wallets -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-purple-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">المحافظ النشطة</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="activeWallets">0</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Withdrawals -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-yellow-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">السحوبات المعلقة</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white" id="pendingWithdrawals">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Connection & Balance Tests -->
            <div class="space-y-6">
                <!-- Connection Test -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            🔌 اختبار الاتصال
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            اختبار الاتصال مع منصة التداول
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                منصة التداول
                            </label>
                            <select id="exchangeSelect" class="form-select w-full">
                                <option value="binance">Binance</option>
                                <option value="mexc">MEXC</option>
                                <option value="kucoin">KuCoin</option>
                                <option value="kraken">Kraken</option>
                                <option value="okx">OKX</option>
                                <option value="bybit">Bybit</option>
                                <option value="gate">Gate.io</option>
                            </select>
                        </div>
                        <button onclick="testConnection()" class="btn btn-primary w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            اختبار الاتصال
                        </button>
                        <div id="connectionResult" class="mt-4 p-3 rounded-md hidden"></div>
                    </div>
                </div>

                <!-- Balance Test -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            💰 فحص الرصيد
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            جلب رصيد المنصة
                        </p>
                    </div>
                    <div class="card-body">
                        <button onclick="testBalance()" class="btn btn-success w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            فحص الرصيد
                        </button>
                        <div id="balanceResult" class="mt-4 p-3 rounded-md hidden"></div>
                    </div>
                </div>

                <!-- Services Test -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            🛠️ الخدمات المتاحة
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            عرض الخدمات المدعومة
                        </p>
                    </div>
                    <div class="card-body">
                        <button onclick="testServices()" class="btn btn-info w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            عرض الخدمات
                        </button>
                        <div id="servicesResult" class="mt-4 p-3 rounded-md hidden"></div>
                    </div>
                </div>
            </div>

            <!-- Wallet & Withdrawal Tests -->
            <div class="space-y-6">
                <!-- Wallet Creation Test -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            🏦 إنشاء المحفظة
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            إنشاء محفظة جديدة للمستخدم
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                العملة
                            </label>
                            <select id="walletCurrency" class="form-select w-full">
                                <option value="USDT">USDT</option>
                                <option value="BTC">BTC</option>
                                <option value="ETH">ETH</option>
                                <option value="BNB">BNB</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                الشبكة
                            </label>
                            <select id="walletNetwork" class="form-select w-full">
                                <option value="TRC20">TRC20</option>
                                <option value="ERC20">ERC20</option>
                                <option value="BEP20">BEP20</option>
                                <option value="Bitcoin">Bitcoin</option>
                                <option value="Ethereum">Ethereum</option>
                            </select>
                        </div>
                        <button onclick="testWalletCreation()" class="btn btn-primary w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            إنشاء المحفظة
                        </button>
                        <div id="walletResult" class="mt-4 p-3 rounded-md hidden"></div>
                    </div>
                </div>

                <!-- Withdrawal Test -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            💸 اختبار السحب
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            اختبار عملية السحب
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                العملة
                            </label>
                            <select id="withdrawalCurrency" class="form-select w-full">
                                <option value="USDT">USDT</option>
                                <option value="BTC">BTC</option>
                                <option value="ETH">ETH</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                المبلغ
                            </label>
                            <input type="number" id="withdrawalAmount" step="0.000001" min="0" 
                                   class="form-input w-full" placeholder="0.001">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                عنوان السحب
                            </label>
                            <input type="text" id="withdrawalAddress" 
                                   class="form-input w-full" placeholder="أدخل عنوان السحب">
                        </div>
                        <button onclick="testWithdrawal()" class="btn btn-warning w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            اختبار السحب
                        </button>
                        <div id="withdrawalResult" class="mt-4 p-3 rounded-md hidden"></div>
                    </div>
                </div>

                <!-- Pending Withdrawals Test -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            ⏳ فحص السحوبات المعلقة
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            فحص السحوبات قيد المعالجة
                        </p>
                    </div>
                    <div class="card-body">
                        <button onclick="testPendingWithdrawals()" class="btn btn-info w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            فحص السحوبات المعلقة
                        </button>
                        <div id="pendingWithdrawalsResult" class="mt-4 p-3 rounded-md hidden"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Results Log -->
        <div class="mt-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        📋 سجل الاختبارات
                    </h3>
                    <button onclick="clearLog()" class="btn btn-sm btn-secondary">
                        مسح السجل
                    </button>
                </div>
                <div class="card-body">
                    <div id="testLog" class="bg-gray-50 dark:bg-gray-800 p-4 rounded-md h-64 overflow-y-auto font-mono text-sm">
                        <div class="text-gray-500">سجل الاختبارات سيظهر هنا...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div id="loadingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 flex items-center space-x-4">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary-500"></div>
            <span class="text-gray-700 dark:text-gray-300">جاري الاختبار...</span>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let currentProvider = null;

// إضافة رسالة إلى السجل
function addLog(message, type = 'info') {
    const log = document.getElementById('testLog');
    const timestamp = new Date().toLocaleTimeString('ar-SA');
    const colorClass = {
        'info': 'text-blue-600',
        'success': 'text-green-600',
        'error': 'text-red-600',
        'warning': 'text-yellow-600'
    }[type] || 'text-gray-600';
    
    const logEntry = document.createElement('div');
    logEntry.className = `mb-2 ${colorClass}`;
    logEntry.innerHTML = `[${timestamp}] ${message}`;
    
    log.appendChild(logEntry);
    log.scrollTop = log.scrollHeight;
}

// إظهار/إخفاء شاشة التحميل
function showLoading(show = true) {
    const modal = document.getElementById('loadingModal');
    modal.classList.toggle('hidden', !show);
}

// اختبار الاتصال
async function testConnection() {
    try {
        showLoading(true);
        addLog('🔌 بدء اختبار الاتصال...', 'info');
        
        const exchange = document.getElementById('exchangeSelect').value;
        const response = await fetch('{{ route("admin.providers.ccxt.test-connection") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ exchange_id: exchange })
        });
        
        const result = await response.json();
        
        if (result.success) {
            addLog(`✅ الاتصال ناجح مع ${exchange}`, 'success');
            document.getElementById('connectionStatus').textContent = 'متصل';
            document.getElementById('connectionStatus').className = 'text-2xl font-semibold text-green-600';
            showResult('connectionResult', result.message, 'success');
        } else {
            addLog(`❌ فشل الاتصال مع ${exchange}: ${result.message}`, 'error');
            document.getElementById('connectionStatus').textContent = 'غير متصل';
            document.getElementById('connectionStatus').className = 'text-2xl font-semibold text-red-600';
            showResult('connectionResult', result.message, 'error');
        }
    } catch (error) {
        addLog(`❌ خطأ في اختبار الاتصال: ${error.message}`, 'error');
        showResult('connectionResult', 'خطأ في الاتصال', 'error');
    } finally {
        showLoading(false);
    }
}

// اختبار الرصيد
async function testBalance() {
    try {
        showLoading(true);
        addLog('💰 بدء فحص الرصيد...', 'info');
        
        const response = await fetch('{{ route("admin.providers.ccxt.test-balance") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            addLog(`✅ تم جلب الرصيد بنجاح: ${result.data.balance} ${result.data.currency}`, 'success');
            document.getElementById('exchangeBalance').textContent = result.data.balance;
            showResult('balanceResult', `الرصيد: ${result.data.balance} ${result.data.currency}`, 'success');
        } else {
            addLog(`❌ فشل في جلب الرصيد: ${result.message}`, 'error');
            showResult('balanceResult', result.message, 'error');
        }
    } catch (error) {
        addLog(`❌ خطأ في فحص الرصيد: ${error.message}`, 'error');
        showResult('balanceResult', 'خطأ في الاتصال', 'error');
    } finally {
        showLoading(false);
    }
}

// اختبار الخدمات
async function testServices() {
    try {
        showLoading(true);
        addLog('🛠️ بدء فحص الخدمات المتاحة...', 'info');
        
        const response = await fetch('{{ route("admin.providers.ccxt.test-services") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            addLog(`✅ تم جلب الخدمات بنجاح: ${result.data.services.length} خدمة`, 'success');
            const servicesList = result.data.services.map(s => s.name).join(', ');
            showResult('servicesResult', `الخدمات المتاحة: ${servicesList}`, 'success');
        } else {
            addLog(`❌ فشل في جلب الخدمات: ${result.message}`, 'error');
            showResult('servicesResult', result.message, 'error');
        }
    } catch (error) {
        addLog(`❌ خطأ في فحص الخدمات: ${error.message}`, 'error');
        showResult('servicesResult', 'خطأ في الاتصال', 'error');
    } finally {
        showLoading(false);
    }
}

// اختبار إنشاء المحفظة
async function testWalletCreation() {
    try {
        showLoading(true);
        addLog('🏦 بدء إنشاء المحفظة...', 'info');
        
        const currency = document.getElementById('walletCurrency').value;
        const network = document.getElementById('walletNetwork').value;
        
        const response = await fetch('{{ route("admin.providers.ccxt.test-wallet-creation") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ currency, network })
        });
        
        const result = await response.json();
        
        if (result.success) {
            addLog(`✅ تم إنشاء المحفظة بنجاح: ${result.data.address}`, 'success');
            showResult('walletResult', `العنوان: ${result.data.address}`, 'success');
        } else {
            addLog(`❌ فشل في إنشاء المحفظة: ${result.message}`, 'error');
            showResult('walletResult', result.message, 'error');
        }
    } catch (error) {
        addLog(`❌ خطأ في إنشاء المحفظة: ${error.message}`, 'error');
        showResult('walletResult', 'خطأ في الاتصال', 'error');
    } finally {
        showLoading(false);
    }
}

// اختبار السحب
async function testWithdrawal() {
    try {
        showLoading(true);
        addLog('💸 بدء اختبار السحب...', 'info');
        
        const currency = document.getElementById('withdrawalCurrency').value;
        const amount = document.getElementById('withdrawalAmount').value;
        const address = document.getElementById('withdrawalAddress').value;
        
        if (!amount || !address) {
            addLog('❌ يرجى إدخال المبلغ والعنوان', 'error');
            showResult('withdrawalResult', 'يرجى إدخال جميع البيانات المطلوبة', 'error');
            return;
        }
        
        const response = await fetch('{{ route("admin.providers.ccxt.test-withdrawal") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ currency, amount, address })
        });
        
        const result = await response.json();
        
        if (result.success) {
            addLog(`✅ تم إنشاء طلب السحب بنجاح: ${result.data.withdrawal_id}`, 'success');
            showResult('withdrawalResult', `معرف السحب: ${result.data.withdrawal_id}`, 'success');
        } else {
            addLog(`❌ فشل في إنشاء طلب السحب: ${result.message}`, 'error');
            showResult('withdrawalResult', result.message, 'error');
        }
    } catch (error) {
        addLog(`❌ خطأ في اختبار السحب: ${error.message}`, 'error');
        showResult('withdrawalResult', 'خطأ في الاتصال', 'error');
    } finally {
        showLoading(false);
    }
}

// اختبار السحوبات المعلقة
async function testPendingWithdrawals() {
    try {
        showLoading(true);
        addLog('⏳ بدء فحص السحوبات المعلقة...', 'info');
        
        const response = await fetch('{{ route("admin.providers.ccxt.test-pending-withdrawals") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            addLog(`✅ تم فحص السحوبات المعلقة: ${result.data.withdrawals.length} سحب`, 'success');
            document.getElementById('pendingWithdrawals').textContent = result.data.withdrawals.length;
            showResult('pendingWithdrawalsResult', `${result.data.withdrawals.length} سحب معلق`, 'success');
        } else {
            addLog(`❌ فشل في فحص السحوبات المعلقة: ${result.message}`, 'error');
            showResult('pendingWithdrawalsResult', result.message, 'error');
        }
    } catch (error) {
        addLog(`❌ خطأ في فحص السحوبات المعلقة: ${error.message}`, 'error');
        showResult('pendingWithdrawalsResult', 'خطأ في الاتصال', 'error');
    } finally {
        showLoading(false);
    }
}

// اختبار جميع الخدمات
async function testAllCCXTServices() {
    addLog('🚀 بدء اختبار جميع خدمات CCXT...', 'info');
    
    // اختبار الاتصال
    await testConnection();
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    // اختبار الرصيد
    await testBalance();
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    // اختبار الخدمات
    await testServices();
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    // اختبار إنشاء المحفظة
    await testWalletCreation();
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    // اختبار السحوبات المعلقة
    await testPendingWithdrawals();
    
    addLog('✅ انتهى اختبار جميع الخدمات', 'success');
}

// إظهار النتيجة
function showResult(elementId, message, type) {
    const element = document.getElementById(elementId);
    element.classList.remove('hidden');
    
    const colorClass = {
        'success': 'bg-green-100 border-green-400 text-green-700',
        'error': 'bg-red-100 border-red-400 text-red-700',
        'warning': 'bg-yellow-100 border-yellow-400 text-yellow-700',
        'info': 'bg-blue-100 border-blue-400 text-blue-700'
    }[type] || 'bg-gray-100 border-gray-400 text-gray-700';
    
    element.className = `mt-4 p-3 rounded-md border ${colorClass}`;
    element.textContent = message;
}

// مسح السجل
function clearLog() {
    const log = document.getElementById('testLog');
    log.innerHTML = '<div class="text-gray-500">تم مسح السجل...</div>';
}

// تحديث الإحصائيات عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    addLog('🚀 تم تحميل صفحة اختبار CCXT', 'info');
    addLog('📋 اختر الخدمة التي تريد اختبارها', 'info');
});
</script>
@endpush
