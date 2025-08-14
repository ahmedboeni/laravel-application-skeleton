@extends('layouts.app')

@section('title', __('app.transactions'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.transactions') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.manage_transactions_description', ['default' => 'إدارة المعاملات المالية في النظام']) }}
                    </p>
                </div>
                <a href="{{ route('admin.transactions.create') }}" 
                   class="btn btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('app.add_transaction') }}
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <!-- Total Transactions -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_transactions') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Transactions -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.pending_transactions') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['pending'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Transactions -->
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.completed_transactions') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['completed'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Failed Transactions -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-danger-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.failed_transactions') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $stats['failed'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Amount -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-info-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_amount') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['total_amount'], 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.transactions') }}</h3>
            </div>
            <div class="card-body">
            @if($transactions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.id') }}
                                </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('app.user') }}
                                </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('app.amount') }}
                                </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.currency') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.payment_method') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.payment_data') }}
                                </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('app.status') }}
                                </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        {{ __('app.date') }}
                                </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    {{ __('app.actions') }}
                                </th>
                            </tr>
                        </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($transactions as $transaction)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $transaction->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">
                                            <div class="font-medium text-gray-900 dark:text-white">
                                                {{ $transaction->user->username ?? __('app.user_not_found') }}
                                            </div>
                                            <div class="text-gray-500 dark:text-gray-400">
                                                {{ $transaction->user->email ?? '' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $transaction->currency }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $transaction->paymentMethod->name_ar ?? __('app.not_specified') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        @if($transaction->payment_data)
                                            <div class="payment-data-preview">
                                                @foreach($transaction->payment_data as $key => $value)
                                                    @if(!empty($value))
                                                        <div class="mb-1">
                                                            <small><strong>{{ $key }}:</strong> 
                                                            @if(strpos($value, 'رابط صورة الإشعار:') !== false)
                                                                @php
                                                                    $imageUrl = trim(str_replace('رابط صورة الإشعار:', '', $value));
                                                                @endphp
                                                                @if(!empty($imageUrl) && filter_var($imageUrl, FILTER_VALIDATE_URL))
                                                                    <button type="button" class="btn btn-xs btn-success" onclick="showImage('{{ $imageUrl }}')">
                                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                        </svg>
                                                                        {{ __('app.view_receipt') }}
                                                                    </button>
                                                                @else
                                                                    <span class="text-warning">{{ __('app.invalid_link') }}</span>
                                                                @endif
                                                            @else
                                                                {{ $value }}
                                                            @endif
                                                            </small>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted">{{ __('app.no_data') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $transaction->status_class }}-100 text-{{ $transaction->status_class }}-800">
                                            {{ $transaction->status_text }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $transaction->formatted_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2" :class="{ 'space-x-reverse': direction === 'rtl' }">
                                            <a href="{{ route('admin.transactions.show', $transaction) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            {{ __('app.view') }}
                                        </a>
                                            <a href="{{ route('admin.transactions.edit', $transaction) }}" 
                                               class="btn btn-sm btn-outline-warning">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            {{ __('app.edit') }}
                                        </a>
                                            <form action="{{ route('admin.transactions.destroy', $transaction) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('{{ __('app.delete_confirmation')}}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    {{ __('app.delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_transactions') }}</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.empty_state_message') }}</p>
                    <div class="mt-6">
                            <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ __('app.add_transaction') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">
                    <svg class="w-5 h-5 text-primary inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ __('app.view_receipt') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="imageContainer">
                    <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">{{ __('app.loading') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    {{ __('app.close') }}
                </button>
                <button type="button" class="btn btn-primary" id="downloadBtn" onclick="downloadImage()">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ __('app.download_image') }}
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentImageUrl = '';

function showImage(imageUrl) {
    currentImageUrl = imageUrl;
    const container = document.getElementById('imageContainer');
    
    // إظهار مؤشر التحميل
    container.innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">{{ __('app.loading') }}</span>
            </div>
        </div>
    `;
    
    // إنشاء عنصر الصورة
    const img = new Image();
    img.onload = function() {
        container.innerHTML = `
            <img src="${imageUrl}" class="img-fluid rounded shadow" 
                 style="max-width: 100%; max-height: 70vh; object-fit: contain;" 
                 alt="{{ __('app.receipt_image') }}">
            <br><br>
            <small class="text-muted">{{ __('app.image_url') }}: <a href="${imageUrl}" target="_blank">${imageUrl}</a></small>
        `;
    };
    img.onerror = function() {
        container.innerHTML = `
            <div class="alert alert-danger" role="alert">
                <svg class="w-5 h-5 text-danger inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                {{ __('app.image_load_error') }}
                <br><br>
                <a href="${imageUrl}" target="_blank" class="btn btn-sm btn-outline-primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    {{ __('app.open_in_new_tab') }}
                </a>
            </div>
        `;
    };
    img.src = imageUrl;
    
    // إظهار Modal
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

function downloadImage() {
    if (currentImageUrl) {
        const link = document.createElement('a');
        link.href = currentImageUrl;
        link.download = 'receipt_' + Date.now() + '.jpg';
        link.target = '_blank';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}
</script>
@endpush
@endsection 