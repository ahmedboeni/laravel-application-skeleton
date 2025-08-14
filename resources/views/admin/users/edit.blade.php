@extends('layouts.app')

@section('title', __('app.edit_user'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        <i class="fas fa-user-edit ml-2"></i>{{ __('app.edit_user') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ $user->name ?? $user->username }}
                    </p>
                </div>
                <div class="flex space-x-4 space-x-reverse">
                    <a href="{{ route('admin.users.show', $user) }}" 
                       class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-eye ml-2"></i>{{ __('app.view') }}
                    </a>
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-arrow-right ml-2"></i>{{ __('app.back') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-info-circle ml-2"></i>{{ __('app.user_details') }}
                        </h3>
                        
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-at text-blue-600 ml-2"></i>{{ __('app.username') }} *
                            </label>
                            <input type="text" name="username" id="username" 
                                   value="{{ old('username', $user->username) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                   required>
                            @error('username')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-user text-blue-600 ml-2"></i>{{ __('app.name') }}
                            </label>
                            <input type="text" name="name" id="name" 
                                   value="{{ old('name', $user->name) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-envelope text-blue-600 ml-2"></i>{{ __('app.email') }} *
                            </label>
                            <input type="email" name="email" id="email" 
                                   value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-phone text-blue-600 ml-2"></i>{{ __('app.phone') }}
                            </label>
                            <input type="text" name="phone" id="phone" 
                                   value="{{ old('phone', $user->phone) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-user-tag text-blue-600 ml-2"></i>{{ __('app.user_role') }} *
                            </label>
                            <select name="role" id="role" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>{{ __('app.user') }}</option>
                                <option value="employee" {{ old('role', $user->role) == 'employee' ? 'selected' : '' }}>{{ __('app.employee') }}</option>
                                <option value="moderator" {{ old('role', $user->role) == 'moderator' ? 'selected' : '' }}>{{ __('app.moderator') }}</option>
                                <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>{{ __('app.manager') }}</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>{{ __('app.admin') }}</option>
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="is_active" class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                       {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="mr-2 text-sm text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-toggle-on text-green-600 ml-2"></i>{{ __('app.active') }}
                                </span>
                            </label>
                            @error('is_active')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Financial Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-dollar-sign text-green-600 ml-2"></i>{{ __('app.financial_information') }}
                        </h3>
                        
                        <div>
                            <label for="account_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-credit-card text-green-600 ml-2"></i>{{ __('app.account_number') }}
                            </label>
                            <input type="text" name="account_number" id="account_number" 
                                   value="{{ old('account_number', $user->account_number) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('account_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="balance" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-wallet text-green-600 ml-2"></i>{{ __('app.balance') }}
                            </label>
                            <input type="number" name="balance" id="balance" step="0.01" min="0"
                                   value="{{ old('balance', $user->balance) }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('balance')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="currency" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-money-bill text-green-600 ml-2"></i>{{ __('app.currency') }}
                            </label>
                            <select name="currency" id="currency" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="USD" {{ old('currency', $user->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                <option value="SAR" {{ old('currency', $user->currency) == 'SAR' ? 'selected' : '' }}>SAR</option>
                                <option value="EUR" {{ old('currency', $user->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                                <option value="YER" {{ old('currency', $user->currency) == 'YER' ? 'selected' : '' }}>YER</option>
                            </select>
                            @error('currency')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="id_verification_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-shield-alt text-orange-600 ml-2"></i>{{ __('app.id_verification_status') }}
                            </label>
                            <select name="id_verification_status" id="id_verification_status" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="pending" {{ old('id_verification_status', $user->id_verification_status) == 'pending' ? 'selected' : '' }}>{{ __('app.pending') }}</option>
                                <option value="approved" {{ old('id_verification_status', $user->id_verification_status) == 'approved' ? 'selected' : '' }}>{{ __('app.approved') }}</option>
                                <option value="rejected" {{ old('id_verification_status', $user->id_verification_status) == 'rejected' ? 'selected' : '' }}>{{ __('app.rejected') }}</option>
                            </select>
                            @error('id_verification_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        <i class="fas fa-lock text-purple-600 ml-2"></i>{{ __('app.password') }}
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-key text-purple-600 ml-2"></i>{{ __('app.password') }}
                            </label>
                            <input type="password" name="password" id="password" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                   placeholder="{{ __('app.leave_blank_to_keep_current') }}">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i class="fas fa-key text-purple-600 ml-2"></i>{{ __('app.confirm_password') }}
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                   placeholder="{{ __('app.confirm_new_password') }}">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="mt-8 flex justify-end space-x-4 space-x-reverse">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-times ml-2"></i>{{ __('app.cancel') }}
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-save ml-2"></i>{{ __('app.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 