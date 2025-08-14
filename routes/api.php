<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PurchaseRequestController;
use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\MarketingOfferController;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Api\CarrierController;
use App\Http\Controllers\Api\InquiryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Webhook Routes (لا تحتاج مصادقة)
Route::post('/webhooks/telecom', [WebhookController::class, 'handleTelecomWebhook']);

// Public API Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Public Categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/active', [CategoryController::class, 'active']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/categories/{category}/services', [CategoryController::class, 'withServices']);

// Public Services
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/search', [ServiceController::class, 'search']);
Route::get('/services/{service}', [ServiceController::class, 'show']);
Route::get('/services/{service}/options', [ServiceController::class, 'getServiceOptions']);

// Public Carriers - Enhanced
Route::get('/carriers', [CarrierController::class, 'index']);
Route::get('/carriers/{carrier}', [CarrierController::class, 'show']);
Route::get('/carriers/{carrier}/services', [CarrierController::class, 'services']); // جديد
Route::get('/carriers/{carrier}/available-tabs', [CarrierController::class, 'availableTabs']); // جديد
Route::post('/carriers/detect', [CarrierController::class, 'detectFromPhone']);
Route::get('/services/category/{categoryId}', [ServiceController::class, 'getServicesByCategory']);
Route::get('/service-options', [ServiceController::class, 'getAllServiceOptions']);

// Public Inquiries
Route::post('/inquiries/balance', [InquiryController::class, 'queryBalance']);
Route::post('/inquiries/offers', [InquiryController::class, 'queryOffers']);

// Public Advertisements
Route::get('/advertisements', [AdvertisementController::class, 'index']);
Route::get('/advertisements/active', [AdvertisementController::class, 'active']);
Route::get('/advertisements/{advertisement}', [AdvertisementController::class, 'show']);
Route::get('/advertisements/type/{type}', [AdvertisementController::class, 'getByType']);

// Public Payment Methods
Route::get('/payment-methods', [PaymentMethodController::class, 'index']);
Route::get('/payment-methods/{paymentMethod}', [PaymentMethodController::class, 'show']);
Route::get('/payment-methods/type/{type}', [PaymentMethodController::class, 'getByType']);

// Protected API Routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    
    // Balance
    Route::get('/balance', [BalanceController::class, 'getBalance']);
    Route::post('/balance/add', [BalanceController::class, 'addBalance']);
    Route::get('/balance/transactions', [BalanceController::class, 'getTransactionHistory']);
    
    // Purchase Requests
    Route::get('/purchase-requests', [PurchaseRequestController::class, 'index']);
    Route::post('/purchase-requests', [PurchaseRequestController::class, 'store']);
    Route::get('/purchase-requests/{purchaseRequest}', [PurchaseRequestController::class, 'show']);
    Route::post('/purchase-requests/{purchaseRequest}/cancel', [PurchaseRequestController::class, 'cancel']);
    Route::get('/purchase-requests/{purchaseRequest}/provider-response', [PurchaseRequestController::class, 'getProviderResponse']);
    
    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show']);
    Route::get('/transactions/statistics', [TransactionController::class, 'getStatistics']);
    Route::get('/transactions/type/{type}', [TransactionController::class, 'getByType']);
    
    // Upload
    Route::post('/upload/receipt', [UploadController::class, 'uploadReceipt']);
    Route::post('/upload/identity', [UploadController::class, 'uploadIdentity']);
    Route::post('/upload/file', [UploadController::class, 'uploadFile']);
    Route::delete('/upload/file/{fileId}', [UploadController::class, 'deleteFile']);
    
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/{id}', [NotificationController::class, 'show']);
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
    Route::get('/notifications/unread/count', [NotificationController::class, 'getUnreadCount']);
    Route::get('/notifications/statistics', [NotificationController::class, 'getStatistics']);
    
    // Marketing Offers
    Route::get('/marketing-offers', [MarketingOfferController::class, 'index']);
    Route::get('/marketing-offers/{id}', [MarketingOfferController::class, 'show']);
    Route::post('/marketing-offers/{id}/use', [MarketingOfferController::class, 'useOffer']);
    Route::get('/marketing-offers/available', [MarketingOfferController::class, 'getAvailableOffers']);
    Route::get('/marketing-offers/used', [MarketingOfferController::class, 'getUsedOffers']);
    Route::get('/marketing-offers/statistics', [MarketingOfferController::class, 'getStatistics']);
});

// Admin Routes (if needed)
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('/balance/update', [BalanceController::class, 'updateBalance']);
    Route::get('/balance/pending-deposits', [BalanceController::class, 'getPendingDeposits']);
    Route::post('/balance/approve-deposit/{transactionId}', [BalanceController::class, 'approveDeposit']);
});
