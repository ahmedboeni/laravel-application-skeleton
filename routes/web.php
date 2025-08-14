<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\ServiceOptionController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\AdminMarketingOfferController;
use App\Http\Controllers\CarrierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Language routes
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');
Route::get('/language-settings', [LanguageController::class, 'getLanguageSettings'])->name('language.settings');

// Authentication routes with security middleware
Route::middleware(['login.throttle'])->group(function () {
    Auth::routes();
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.edit', ['user' => auth()->user()]);
    })->name('profile.edit');
    
    Route::put('/profile', function () {
        return redirect()->back()->with('status', __('app.profile_updated_success'));
    })->name('profile.update');
});

// Redirect to admin dashboard after login
Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->name('home');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/api/dashboard/stats', [App\Http\Controllers\DashboardController::class, 'getStats'])->name('api.dashboard.stats');
    
    Route::get('/api/dashboard/site-info', [App\Http\Controllers\DashboardController::class, 'getSiteInfo'])->name('api.dashboard.site-info');

    // Users Management
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    
    // User Activities
    Route::get('/users/{user}/activities', [UserController::class, 'activities'])->name('admin.users.activities');
    
    // User Ban Management
    Route::post('/users/{user}/ban', [UserController::class, 'banUser'])->name('admin.users.ban');
    Route::post('/users/{user}/unban', [UserController::class, 'unbanUser'])->name('admin.users.unban');
    Route::post('/users/{user}/warning', [UserController::class, 'addWarning'])->name('admin.users.warning');
    Route::get('/users/ban-statistics', [UserController::class, 'banStatistics'])->name('admin.users.ban-statistics');
    Route::get('/users/banned-devices', [UserController::class, 'bannedDevices'])->name('admin.users.banned-devices');
    Route::post('/users/banned-devices/{device}/unban', [UserController::class, 'unbanDevice'])->name('admin.users.unban-device');
    
    // Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity-logs.index');
    Route::get('/activity-logs/{activityLog}', [ActivityLogController::class, 'show'])->name('admin.activity-logs.show');
    Route::get('/activity-logs/export', [ActivityLogController::class, 'export'])->name('admin.activity-logs.export');
    Route::post('/activity-logs/clear', [ActivityLogController::class, 'clearOldActivities'])->name('admin.activity-logs.clear');
    
    // Activity Logs API
    Route::get('/activity-logs/user/{userId}', [ActivityLogController::class, 'getUserActivities'])->name('admin.activity-logs.user');
    Route::get('/activity-logs/type/{type}', [ActivityLogController::class, 'getActivitiesByType'])->name('admin.activity-logs.type');
    Route::get('/activity-logs/ip/{ipAddress}', [ActivityLogController::class, 'getActivitiesByIP'])->name('admin.activity-logs.ip');
    
    // Categories Management
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
    
    // Carrier Actions (specific routes before resource)
    Route::get('/carriers/statistics', [CarrierController::class, 'statistics'])->name('admin.carriers.statistics');
    Route::post('/carriers/{carrier}/toggle-status', [CarrierController::class, 'toggleStatus'])->name('admin.carriers.toggle-status');
    Route::post('/carriers/reorder', [CarrierController::class, 'reorder'])->name('admin.carriers.reorder');
    
    // Carriers Management
    Route::resource('carriers', CarrierController::class)->names([
        'index' => 'admin.carriers.index',
        'create' => 'admin.carriers.create',
        'store' => 'admin.carriers.store',
        'show' => 'admin.carriers.show',
        'edit' => 'admin.carriers.edit',
        'update' => 'admin.carriers.update',
        'destroy' => 'admin.carriers.destroy',
    ]);
    
    // Carriers API
    Route::get('/api/carriers', [CarrierController::class, 'getCarriers'])->name('api.carriers.index');
    
    // Available Tabs Management - REMOVED (merged into Carriers)
    // التبويبات المتاحة تم دمجها في نظام الشركات
    
    // Provider Management
    Route::get('/providers', [ProviderController::class, 'index'])->name('admin.providers.index');
    Route::get('/providers/create', [ProviderController::class, 'create'])->name('admin.providers.create');
    Route::post('/providers', [ProviderController::class, 'store'])->name('admin.providers.store');
    Route::get('/providers/statistics', [ProviderController::class, 'statistics'])->name('admin.providers.statistics');
    
    // CCXT Test Routes - يجب أن تكون قبل المسارات العامة
    Route::get('/providers/ccxt-test', [App\Http\Controllers\CCXTTestController::class, 'index'])->name('admin.providers.ccxt-test');
    Route::post('/providers/ccxt-test/connection', [App\Http\Controllers\CCXTTestController::class, 'testConnection'])->name('admin.providers.ccxt.test-connection');
    Route::post('/providers/ccxt-test/balance', [App\Http\Controllers\CCXTTestController::class, 'testBalance'])->name('admin.providers.ccxt.test-balance');
    Route::post('/providers/ccxt-test/services', [App\Http\Controllers\CCXTTestController::class, 'testServices'])->name('admin.providers.ccxt.test-services');
    Route::post('/providers/ccxt-test/wallet-creation', [App\Http\Controllers\CCXTTestController::class, 'testWalletCreation'])->name('admin.providers.ccxt.test-wallet-creation');
    Route::post('/providers/ccxt-test/withdrawal', [App\Http\Controllers\CCXTTestController::class, 'testWithdrawal'])->name('admin.providers.ccxt.test-withdrawal');
    Route::post('/providers/ccxt-test/pending-withdrawals', [App\Http\Controllers\CCXTTestController::class, 'testPendingWithdrawals'])->name('admin.providers.ccxt.test-pending-withdrawals');
    Route::post('/providers/ccxt-test/all-services', [App\Http\Controllers\CCXTTestController::class, 'testAllServices'])->name('admin.providers.ccxt.test-all-services');
    
    // Provider API Routes
    Route::post('/providers/test-all', [ProviderController::class, 'testAll'])->name('admin.providers.test-all-post');
    Route::post('/providers/test', [ProviderController::class, 'test'])->name('admin.providers.test');
    Route::post('/providers/balance', [ProviderController::class, 'getBalance'])->name('admin.providers.balance');
    Route::post('/providers/services', [ProviderController::class, 'getServices'])->name('admin.providers.services');
    Route::post('/providers/process-orders', [ProviderController::class, 'processOrders'])->name('admin.providers.process-orders');
    Route::post('/providers/check-order-status', [ProviderController::class, 'checkOrderStatus'])->name('admin.providers.check-order-status');
    Route::post('/providers/submit-order', [ProviderController::class, 'submitOrder'])->name('admin.providers.submit-order');
    Route::post('/providers/check-order-status-by-id', [ProviderController::class, 'checkOrderStatusById'])->name('admin.providers.check-order-status-by-id');
    Route::post('/providers/resubmit-order', [ProviderController::class, 'resubmitOrder'])->name('admin.providers.resubmit-order');
    Route::post('/providers/get-provider-response', [ProviderController::class, 'getProviderResponse'])->name('admin.providers.get-provider-response');
    
    // Provider Individual Routes - يجب أن تكون في النهاية
    Route::get('/providers/{providerId}', [ProviderController::class, 'show'])->name('admin.providers.show');
    Route::get('/providers/{providerId}/edit', [ProviderController::class, 'edit'])->name('admin.providers.edit');
    Route::put('/providers/{providerId}', [ProviderController::class, 'update'])->name('admin.providers.update');
    Route::delete('/providers/{providerId}', [ProviderController::class, 'destroy'])->name('admin.providers.destroy');
    
    // Provider Config Management
    Route::get('/providers/{providerId}/config', [App\Http\Controllers\ProviderConfigController::class, 'index'])->name('admin.providers.config.index');
    Route::get('/providers/{providerId}/config/create', [App\Http\Controllers\ProviderConfigController::class, 'create'])->name('admin.providers.config.create');
    Route::post('/providers/{providerId}/config', [App\Http\Controllers\ProviderConfigController::class, 'store'])->name('admin.providers.config.store');
    Route::get('/providers/{providerId}/config/{configId}/edit', [App\Http\Controllers\ProviderConfigController::class, 'edit'])->name('admin.providers.config.edit');
    Route::put('/providers/{providerId}/config/{configId}', [App\Http\Controllers\ProviderConfigController::class, 'update'])->name('admin.providers.config.update');
    Route::delete('/providers/{providerId}/config/{configId}', [App\Http\Controllers\ProviderConfigController::class, 'destroy'])->name('admin.providers.config.destroy');
    Route::post('/providers/{providerId}/config/test', [App\Http\Controllers\ProviderConfigController::class, 'test'])->name('admin.providers.config.test');
    Route::post('/providers/{providerId}/config/balance', [App\Http\Controllers\ProviderConfigController::class, 'getBalance'])->name('admin.providers.config.balance');
    Route::post('/providers/{providerId}/config/reorder', [App\Http\Controllers\ProviderConfigController::class, 'reorder'])->name('admin.providers.config.reorder');

    // App Variables routes
    Route::resource('app-variables', App\Http\Controllers\AppVariableController::class)->names('admin.app-variables');
    Route::post('/app-variables/clear-cache', [App\Http\Controllers\AppVariableController::class, 'clearCache'])->name('admin.app-variables.clear-cache');
    Route::get('/api/app-variables/category/{category}', [App\Http\Controllers\AppVariableController::class, 'getByCategory'])->name('admin.app-variables.api.category');
    Route::get('/api/app-variables/select-options/{category}', [App\Http\Controllers\AppVariableController::class, 'getSelectOptions'])->name('admin.app-variables.api.select-options');
    
    // Category Status Toggle
    Route::post('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('admin.categories.toggle-status');
    
    // Categories API
    Route::get('/api/categories', [CategoryController::class, 'getCategories'])->name('api.categories.index');
    
    // Services Management
    Route::resource('services', ServiceController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'show' => 'admin.services.show',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);
    
    // Service Status Toggle
    Route::post('/services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('admin.services.toggle-status');
    
    // Services API
    Route::get('/api/services', [ServiceController::class, 'getServices'])->name('api.services.index');
    
    // Service Provider Mappings Management
    Route::resource('service-provider-mappings', App\Http\Controllers\ServiceProviderMappingController::class)->names([
        'index' => 'admin.service-provider-mappings.index',
        'create' => 'admin.service-provider-mappings.create',
        'store' => 'admin.service-provider-mappings.store',
        'show' => 'admin.service-provider-mappings.show',
        'edit' => 'admin.service-provider-mappings.edit',
        'update' => 'admin.service-provider-mappings.update',
        'destroy' => 'admin.service-provider-mappings.destroy',
    ]);
    
    // Service Provider Mapping Actions
    Route::post('/service-provider-mappings/{serviceProviderMapping}/toggle-status', [App\Http\Controllers\ServiceProviderMappingController::class, 'toggleStatus'])->name('admin.service-provider-mappings.toggle-status');
    
    // Transactions Management
    Route::resource('transactions', TransactionController::class)->names([
        'index' => 'admin.transactions.index',
        'create' => 'admin.transactions.create',
        'store' => 'admin.transactions.store',
        'show' => 'admin.transactions.show',
        'edit' => 'admin.transactions.edit',
        'update' => 'admin.transactions.update',
        'destroy' => 'admin.transactions.destroy',
    ]);
    
    // Transaction Status Update
    Route::put('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('admin.transactions.update-status');
    
    // Transactions API
    Route::get('/api/transactions', [TransactionController::class, 'getTransactions'])->name('api.transactions.index');
    
    // Purchase Requests Management
    Route::resource('purchase-requests', PurchaseRequestController::class)->names([
        'index' => 'admin.purchase-requests.index',
        'create' => 'admin.purchase-requests.create',
        'store' => 'admin.purchase-requests.store',
        'show' => 'admin.purchase-requests.show',
        'edit' => 'admin.purchase-requests.edit',
        'update' => 'admin.purchase-requests.update',
        'destroy' => 'admin.purchase-requests.destroy',
    ]);
    
    // Purchase Request Actions
    Route::post('/purchase-requests/{purchaseRequest}/approve', [PurchaseRequestController::class, 'approve'])->name('admin.purchase-requests.approve');
    Route::post('/purchase-requests/{purchaseRequest}/reject', [PurchaseRequestController::class, 'reject'])->name('admin.purchase-requests.reject');
    
    // Purchase Requests API
    Route::get('/api/purchase-requests', [PurchaseRequestController::class, 'getPurchaseRequests'])->name('api.purchase-requests.index');
    
    // Payment Methods Management
    Route::resource('payment-methods', PaymentMethodController::class)->names([
        'index' => 'admin.payment-methods.index',
        'create' => 'admin.payment-methods.create',
        'store' => 'admin.payment-methods.store',
        'show' => 'admin.payment-methods.show',
        'edit' => 'admin.payment-methods.edit',
        'update' => 'admin.payment-methods.update',
        'destroy' => 'admin.payment-methods.destroy',
    ]);
    
    // Payment Method Status Toggle
    Route::post('/payment-methods/{paymentMethod}/toggle-status', [PaymentMethodController::class, 'toggleStatus'])->name('admin.payment-methods.toggle-status');
    
    // Payment Methods API
    Route::get('/api/payment-methods', [PaymentMethodController::class, 'getPaymentMethods'])->name('api.payment-methods.index');
    
    // Advertisements Management
    Route::resource('advertisements', AdvertisementController::class)->names([
        'index' => 'admin.advertisements.index',
        'create' => 'admin.advertisements.create',
        'store' => 'admin.advertisements.store',
        'show' => 'admin.advertisements.show',
        'edit' => 'admin.advertisements.edit',
        'update' => 'admin.advertisements.update',
        'destroy' => 'admin.advertisements.destroy',
    ]);
    
    // Advertisement Status Toggle
    Route::post('/advertisements/{advertisement}/toggle-status', [AdvertisementController::class, 'toggleStatus'])->name('admin.advertisements.toggle-status');
    
    // Advertisements API
    Route::get('/api/advertisements', [AdvertisementController::class, 'getAdvertisements'])->name('api.advertisements.index');
    
    // Service Options Management
    Route::resource('service-options', ServiceOptionController::class)->names([
        'index' => 'admin.service-options.index',
        'create' => 'admin.service-options.create',
        'store' => 'admin.service-options.store',
        'show' => 'admin.service-options.show',
        'edit' => 'admin.service-options.edit',
        'update' => 'admin.service-options.update',
        'destroy' => 'admin.service-options.destroy',
    ]);
    
    // Service Option Status Toggle
    Route::post('/service-options/{serviceOption}/toggle-status', [ServiceOptionController::class, 'toggleStatus'])->name('admin.service-options.toggle-status');
    
    // Service Options API
    Route::get('/api/service-options', [ServiceOptionController::class, 'getServiceOptions'])->name('api.service-options.index');
    
    // Settings
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('admin.settings.index');
    
    Route::put('/settings', [App\Http\Controllers\SettingController::class, 'update'])->name('admin.settings.update');
    
    Route::put('/settings/single', [App\Http\Controllers\SettingController::class, 'updateSetting'])->name('admin.settings.update-single');
    
    Route::get('/api/settings/contact', [App\Http\Controllers\SettingController::class, 'getContactSettings'])->name('api.settings.contact');
    
    Route::get('/api/settings/site', [App\Http\Controllers\SettingController::class, 'getSiteSettings'])->name('api.settings.site');
    
    Route::get('/api/settings/all', [App\Http\Controllers\SettingController::class, 'getAllSettings'])->name('api.settings.all');
    
    Route::put('/settings/email', function () {
        return redirect()->back()->with('status', __('app.email_settings_saved'));
    })->name('admin.settings.email');
    
    Route::put('/settings/security', function () {
        return redirect()->back()->with('status', __('app.security_settings_saved'));
    })->name('admin.settings.security');
    
    Route::post('/settings/backup', function () {
        return redirect()->back()->with('status', __('app.backup_created_success'));
    })->name('admin.settings.backup');
    
    Route::put('/settings/backup-auto', function () {
        return redirect()->back()->with('status', __('app.backup_auto_settings_saved'));
    })->name('admin.settings.backup-auto');
    
    // Providers Management
    Route::get('/providers', [ProviderController::class, 'index'])->name('admin.providers.index');
    Route::get('/providers/{providerId}', [ProviderController::class, 'show'])->name('admin.providers.show');
    Route::get('/providers/test-all', [ProviderController::class, 'testAll'])->name('admin.providers.test-all-get');
    Route::post('/providers/test', [ProviderController::class, 'test'])->name('admin.providers.test');
    Route::post('/providers/balance', [ProviderController::class, 'getBalance'])->name('admin.providers.balance');
    Route::post('/providers/services', [ProviderController::class, 'getServices'])->name('admin.providers.services');
    Route::post('/providers/process-orders', [ProviderController::class, 'processOrders'])->name('admin.providers.process-orders');
    Route::post('/providers/submit-order', [ProviderController::class, 'submitOrder'])->name('admin.providers.submit-order');
    Route::post('/providers/check-status', [ProviderController::class, 'checkOrderStatus'])->name('admin.providers.check-status');
    Route::get('/providers/statistics', [ProviderController::class, 'statistics'])->name('admin.providers.statistics');
    
    // Notifications Management
    Route::get('/notifications', [AdminNotificationController::class, 'index'])->name('admin.notifications.index');
    Route::get('/notifications/create', [AdminNotificationController::class, 'create'])->name('admin.notifications.create');
    Route::get('/notifications/{id}', [AdminNotificationController::class, 'show'])->name('admin.notifications.show');
    Route::post('/notifications/send-to-user', [AdminNotificationController::class, 'sendToUser'])->name('admin.notifications.send-to-user');
    Route::post('/notifications/send-to-all', [AdminNotificationController::class, 'sendToAll'])->name('admin.notifications.send-to-all');
    Route::post('/notifications/send-to-specific', [AdminNotificationController::class, 'sendToSpecific'])->name('admin.notifications.send-to-specific');
    Route::post('/notifications/send-by-criteria', [AdminNotificationController::class, 'sendByCriteria'])->name('admin.notifications.send-by-criteria');
    Route::post('/notifications/{id}/mark-read', [AdminNotificationController::class, 'markAsRead'])->name('admin.notifications.mark-read');
    Route::delete('/notifications/{id}', [AdminNotificationController::class, 'destroy'])->name('admin.notifications.destroy');
    Route::get('/notifications/statistics', [AdminNotificationController::class, 'statistics'])->name('admin.notifications.statistics');
    Route::post('/notifications/delete-expired', [AdminNotificationController::class, 'deleteExpired'])->name('admin.notifications.delete-expired');
    
    // Marketing Offers Management
    Route::resource('marketing-offers', AdminMarketingOfferController::class)->names([
        'index' => 'admin.marketing-offers.index',
        'create' => 'admin.marketing-offers.create',
        'store' => 'admin.marketing-offers.store',
        'show' => 'admin.marketing-offers.show',
        'edit' => 'admin.marketing-offers.edit',
        'update' => 'admin.marketing-offers.update',
        'destroy' => 'admin.marketing-offers.destroy',
    ]);
    Route::get('/marketing-offers/statistics', [AdminMarketingOfferController::class, 'statistics'])->name('admin.marketing-offers.statistics');
    Route::post('/marketing-offers/{id}/toggle-status', [AdminMarketingOfferController::class, 'toggleStatus'])->name('admin.marketing-offers.toggle-status');
});

// Test route to verify routes are working
Route::get('/test-routes', function () {
    return response()->json([
        'admin.transactions.index' => route('admin.transactions.index'),
        'admin.users.index' => route('admin.users.index'),
        'admin.categories.index' => route('admin.categories.index'),
        'admin.services.index' => route('admin.services.index'),
        'admin.payment-methods.index' => route('admin.payment-methods.index'),
        'admin.advertisements.index' => route('admin.advertisements.index'),
        'admin.purchase-requests.index' => route('admin.purchase-requests.index'),
        'admin.service-options.index' => route('admin.service-options.index'),
    ]);
})->name('test.routes');

// Support routes
Route::get('/contact-support', [App\Http\Controllers\SupportController::class, 'contact'])->name('contact.support');

Route::get('/support', [App\Http\Controllers\SupportController::class, 'index'])->name('support.index');

Route::post('/support/send-message', [App\Http\Controllers\SupportController::class, 'sendMessage'])->name('support.send-message');

Route::get('/api/support/info', [App\Http\Controllers\SupportController::class, 'getSupportInfo'])->name('api.support.info');

// Wallet Management Routes
Route::middleware(['auth'])->prefix('wallets')->group(function () {
    Route::get('/', [WalletController::class, 'index'])->name('wallets.index');
    Route::get('/create', [WalletController::class, 'create'])->name('wallets.create');
    Route::post('/', [WalletController::class, 'store'])->name('wallets.store');
    Route::get('/{wallet}', [WalletController::class, 'show'])->name('wallets.show');
    Route::post('/{wallet}/check-deposits', [WalletController::class, 'checkDeposits'])->name('wallets.check-deposits');
    Route::get('/{wallet}/deposits', [WalletController::class, 'getDeposits'])->name('wallets.deposits');
    Route::post('/{wallet}/deactivate', [WalletController::class, 'deactivate'])->name('wallets.deactivate');
    Route::post('/{wallet}/activate', [WalletController::class, 'activate'])->name('wallets.activate');
    Route::get('/statistics', [WalletController::class, 'getStatistics'])->name('wallets.statistics');
    
    // API Routes
    Route::prefix('api')->group(function () {
        Route::post('/create', [WalletController::class, 'apiCreateWallet'])->name('api.wallets.create');
        Route::get('/', [WalletController::class, 'apiGetWallets'])->name('api.wallets.index');
        Route::get('/deposits', [WalletController::class, 'apiGetDeposits'])->name('api.wallets.deposits');
        Route::post('/check-deposits', [WalletController::class, 'apiCheckDeposits'])->name('api.wallets.check-deposits');
    });
});
