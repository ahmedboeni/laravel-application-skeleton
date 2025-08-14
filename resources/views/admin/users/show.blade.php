@extends('layouts.app')

@section('title', __('app.user_details'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-user ml-2"></i>{{ __('app.user_details') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ $user->name ?? $user->username }}
                    </p>
                </div>
                <div class="flex space-x-4 space-x-reverse">
                    <a href="{{ route('admin.users.edit', $user) }}" 
                       class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-edit ml-2"></i>{{ __('app.edit') }}
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-arrow-right ml-2"></i>{{ __('app.back') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- User Details -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- User Avatar and Basic Info -->
                <div class="lg:col-span-1">
                    <div class="text-center mb-6">
                        <div class="w-32 h-32 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name ?? $user->username }}</h3>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full mt-2
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                               ($user->role === 'manager' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' : 
                               ($user->role === 'moderator' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 
                               ($user->role === 'employee' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                               'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200'))) }}">
                            {{ $user->role === 'admin' ? __('app.admin') : 
                               ($user->role === 'manager' ? __('app.manager') : 
                               ($user->role === 'moderator' ? __('app.moderator') : 
                               ($user->role === 'employee' ? __('app.employee') : __('app.user')))) }}
                        </span>
                    </div>
                </div>

                <!-- User Information -->
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                <i class="fas fa-info-circle ml-2"></i>{{ __('app.user_details') }}
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-hashtag text-blue-600 ml-2"></i>{{ __('app.user_id') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ $user->id }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-user text-blue-600 ml-2"></i>{{ __('app.name') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ $user->name ?? '-' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-at text-blue-600 ml-2"></i>{{ __('app.username') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ $user->username }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-envelope text-blue-600 ml-2"></i>{{ __('app.email') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-phone text-blue-600 ml-2"></i>{{ __('app.phone') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ $user->phone ?? '-' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-toggle-on text-blue-600 ml-2"></i>{{ __('app.status') }}
                                    </label>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full mt-1 {{ $user->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $user->is_active ? __('app.active') : __('app.inactive') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                                <i class="fas fa-dollar-sign text-green-600 ml-2"></i>{{ __('app.financial_information') }}
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-credit-card text-green-600 ml-2"></i>{{ __('app.account_number') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ $user->account_number ?? '-' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-wallet text-green-600 ml-2"></i>{{ __('app.balance') }}
                                    </label>
                                    <p class="mt-1 text-sm font-bold text-green-600 dark:text-green-400 bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ number_format($user->balance, 2) }} {{ $user->currency }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-money-bill text-green-600 ml-2"></i>{{ __('app.currency') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ $user->currency }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-shopping-cart text-blue-600 ml-2"></i>{{ __('app.orders_count') }}
                                    </label>
                                    <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                        {{ $user->purchaseRequests->count() + $user->transactions->count() }} {{ __('app.order') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-calendar text-purple-600 ml-2"></i>{{ __('app.account_information') }}
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-calendar-plus text-purple-600 ml-2"></i>{{ __('app.created_at') }}
                                </label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                    {{ $user->created_at->format('Y-m-d H:i:s') }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-calendar-check text-purple-600 ml-2"></i>{{ __('app.updated_at') }}
                                </label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 px-3 py-2 rounded">
                                    {{ $user->updated_at->format('Y-m-d H:i:s') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Identity Verification Section -->
            <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-6">
                    <i class="fas fa-id-card text-orange-600 ml-2"></i>{{ __('app.identity_verification') }}
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Front ID Image -->
                    <div class="text-center">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <i class="fas fa-credit-card text-green-600 ml-2"></i>{{ __('app.id_front') }}
                        </label>
                        <div class="identity-image-container">
                            @if($user->id_front_image)
                                <img src="{{ $user->id_front_image }}" alt="{{ __('app.id_front') }}" 
                                     class="identity-image cursor-pointer" onclick="openImageModal('{{ $user->id_front_image }}')">
                            @else
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-500">{{ __('app.no_image_uploaded') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Back ID Image -->
                    <div class="text-center">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <i class="fas fa-credit-card text-yellow-600 ml-2"></i>{{ __('app.id_back') }}
                        </label>
                        <div class="identity-image-container">
                            @if($user->id_back_image)
                                <img src="{{ $user->id_back_image }}" alt="{{ __('app.id_back') }}" 
                                     class="identity-image cursor-pointer" onclick="openImageModal('{{ $user->id_back_image }}')">
                            @else
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-500">{{ __('app.no_image_uploaded') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Selfie Image -->
                    <div class="text-center">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            <i class="fas fa-camera text-purple-600 ml-2"></i>{{ __('app.id_selfie') }}
                        </label>
                        <div class="identity-image-container">
                            @if($user->id_selfie_image)
                                <img src="{{ $user->id_selfie_image }}" alt="{{ __('app.id_selfie') }}" 
                                     class="identity-image cursor-pointer" onclick="openImageModal('{{ $user->id_selfie_image }}')">
                            @else
                                <div class="no-image-placeholder">
                                    <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-500">{{ __('app.no_image_uploaded') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Verification Status -->
                <div class="mt-6 text-center">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-shield-alt text-blue-600 ml-2"></i>{{ __('app.verification_status') }}
                    </label>
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                        {{ $user->id_verification_status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                           ($user->id_verification_status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 
                           'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200') }}">
                        @if($user->id_verification_status === 'approved')
                            <i class="fas fa-check-circle ml-2"></i>{{ __('app.verified') }}
                        @elseif($user->id_verification_status === 'rejected')
                            <i class="fas fa-times-circle ml-2"></i>{{ __('app.rejected') }}
                        @else
                            <i class="fas fa-clock ml-2"></i>{{ __('app.pending_verification') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="modal fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="modal-content max-w-4xl max-h-full p-4">
        <div class="relative">
            <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white text-2xl hover:text-gray-300 z-10">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="{{ __('app.id_image') }}" class="max-w-full max-h-full object-contain">
        </div>
    </div>
</div>

<style>
.identity-image-container {
    width: 100%;
    height: 200px;
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
    background-color: #f9fafb;
    margin-top: 8px;
}

.identity-image {
    max-width: 100%;
    max-height: 100%;
    border-radius: 8px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.identity-image:hover {
    transform: scale(1.05);
}

.no-image-placeholder {
    text-align: center;
    color: #6b7280;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.modal {
    backdrop-filter: blur(5px);
}

.modal-content {
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
</style>

<script>
function openImageModal(imageUrl) {
    document.getElementById('modalImage').src = imageUrl;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// إغلاق النافذة المنبثقة عند النقر خارجها
window.onclick = function(event) {
    const modal = document.getElementById('imageModal');
    if (event.target === modal) {
        closeImageModal();
    }
}
</script>
@endsection 