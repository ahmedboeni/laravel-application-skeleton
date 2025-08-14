@extends('layouts.app')

@section('title', __('app.add_purchase_request'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ __('app.add_purchase_request') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('app.create_new_purchase_request_description') }}
                    </p>
                </div>
                <a href="{{ route('admin.purchase-requests.index') }}" 
                   class="btn btn-outline-secondary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('app.back_to_list') }}
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.purchase-requests.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User -->
                        <div class="form-group">
                            <label for="user_id" class="form-label">
                                {{ __('app.user') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="user_id" 
                                    name="user_id" 
                                    class="form-select @error('user_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_user') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service -->
                        <div class="form-group">
                            <label for="service_id" class="form-label">
                                {{ __('app.service') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="service_id" 
                                    name="service_id" 
                                    class="form-select @error('service_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_service') }}</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Option -->
                        <div class="form-group">
                            <label for="service_option_id" class="form-label">
                                {{ __('app.service_option') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="service_option_id" 
                                    name="service_option_id" 
                                    class="form-select @error('service_option_id') border-red-500 @enderror"
                                    required>
                                <option value="">{{ __('app.select_service_option') }}</option>
                                @foreach($serviceOptions as $option)
                                    <option value="{{ $option->id }}" 
                                            data-service="{{ $option->service_id }}"
                                            {{ old('service_option_id') == $option->id ? 'selected' : '' }}>
                                        {{ $option->option_name }} - {{ $option->service->name_ar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_option_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Amount USD -->
                        <div class="form-group">
                            <label for="amount_usd" class="form-label">
                                {{ __('app.amount_usd') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="amount_usd" 
                                   name="amount_usd" 
                                   value="{{ old('amount_usd') }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input @error('amount_usd') border-red-500 @enderror"
                                   required>
                            @error('amount_usd')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Identifier -->
                        <div class="form-group">
                            <label for="identifier" class="form-label">
                                {{ __('app.identifier') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="identifier" 
                                   name="identifier" 
                                   value="{{ old('identifier') }}"
                                   class="form-input @error('identifier') border-red-500 @enderror"
                                   required>
                            @error('identifier')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Extra Info -->
                        <div class="form-group">
                            <label for="extra_info" class="form-label">
                                {{ __('app.extra_info') }}
                            </label>
                            <input type="text" 
                                   id="extra_info" 
                                   name="extra_info" 
                                   value="{{ old('extra_info') }}"
                                   class="form-input @error('extra_info') border-red-500 @enderror">
                            @error('extra_info')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status" class="form-label">
                                {{ __('app.status') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="status" 
                                    name="status" 
                                    class="form-select @error('status') border-red-500 @enderror"
                                    required>
                                <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>{{ __('app.pending') }}</option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>{{ __('app.approved') }}</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>{{ __('app.rejected') }}</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 mt-8" :class="{ 'space-x-reverse': direction === 'rtl' }">
                        <a href="{{ route('admin.purchase-requests.index') }}" 
                           class="btn btn-outline-secondary">
                            {{ __('app.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ __('app.create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service_id');
    const serviceOptionSelect = document.getElementById('service_option_id');
    const serviceOptions = @json($serviceOptions);
    
    // Filter service options based on selected service
    serviceSelect.addEventListener('change', function() {
        const selectedServiceId = this.value;
        serviceOptionSelect.innerHTML = '<option value="">{{ __('app.select_service_option') }}</option>';
        
        if (selectedServiceId) {
            serviceOptions.forEach(option => {
                if (option.service_id == selectedServiceId) {
                    const optionElement = document.createElement('option');
                    optionElement.value = option.id;
                    optionElement.textContent = option.option_name + ' - ' + option.service.name_ar;
                    serviceOptionSelect.appendChild(optionElement);
                }
            });
        }
    });
});
</script>
@endsection 