@extends('layouts.app')

@section('title', __('app.user_management'))

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('app.user_management') }}</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('app.user_management') }}
                    </p>
                </div>
                <a href="{{ route('admin.users.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    {{ __('app.add_user') }}
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-primary-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.total_employees') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Managers -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-success-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.managers') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $users->whereIn('role', ['admin', 'manager'])->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Moderators -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-warning-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.moderators') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $users->where('role', 'moderator')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Regular Employees -->
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-md bg-danger-500 flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4" :class="{ 'mr-4 ml-0': direction === 'rtl' }">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('app.regular_employees') }}</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $users->where('role', 'employee')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-8">
            <div class="card-body">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="flex-1 w-full lg:w-auto">
                    <div class="relative">
                        <input type="text" placeholder="{{ __('app.search_placeholder') }}" 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white bg-white">
                        <option value="">{{ __('app.all_roles') }}</option>
                        <option value="admin">{{ __('app.admin') }}</option>
                        <option value="manager">{{ __('app.manager') }}</option>
                        <option value="moderator">{{ __('app.moderator') }}</option>
                        <option value="employee">{{ __('app.employee') }}</option>
                    </select>
                    
                    <select class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white bg-white">
                        <option value="">{{ __('app.all_status') }}</option>
                        <option value="active">{{ __('app.active') }}</option>
                        <option value="inactive">{{ __('app.inactive') }}</option>
                    </select>
                    
                    <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        {{ __('app.search') }}
                    </button>
                    
                    <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-success-600 hover:bg-success-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-success-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        {{ __('app.export') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card">
            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.employee_name') }}
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.user_role') }}
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.username') }}
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.phone') }}
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.email') }}
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.balance') }}
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.orders_count') }}
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.status') }}
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('app.actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($users as $user)
                                <tr class="hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-200 hover:shadow-sm">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12">
                                                <img class="h-12 w-12 rounded-full ring-2 ring-gray-200 dark:ring-gray-600" 
                                                     src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? $user->username) }}&color=7C3AED&background=EBF4FF" 
                                                     alt="{{ $user->name ?? $user->username }}">
                                            </div>
                                            <div class="mr-4">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                    {{ $user->name ?? $user->username }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    ID: {{ $user->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 dark:text-white">
                                        <span class="font-medium">{{ $user->username }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 dark:text-white">
                                        {{ $user->phone ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 dark:text-white">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="text-sm font-bold text-green-600 dark:text-green-400">
                                            {{ number_format($user->balance, 2) }} {{ $user->currency }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $user->purchaseRequests->count() + $user->transactions->count() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <!-- حالة الحساب -->
                                        <div class="space-y-1">
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                                <span class="w-2 h-2 rounded-full {{ $user->is_active ? 'bg-green-400' : 'bg-red-400' }} ml-1"></span>
                                                {{ $user->is_active ? __('app.active') : __('app.inactive') }}
                                            </span>
                                            
                                            <!-- حالة الحظر -->
                                            @if($user->isBanned())
                                                <div class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                    <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                                                    </svg>
                                                    {{ $user->is_permanently_banned ? __('app.permanent_ban') : __('app.temporary_ban') }}
                                                </div>
                                            @endif
                                            
                                            <!-- عدد التحذيرات -->
                                            @if($user->warning_count > 0)
                                                <div class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                    <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                    </svg>
                                                    {{ $user->warning_count }} {{ __('app.warnings') }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center space-x-3 space-x-reverse">
                                            <!-- Edit Button -->
                                            <button onclick="editEmployee('{{ $user->id }}', '{{ $user->name ?? $user->username }}', '{{ $user->username }}', '{{ $user->email }}', '{{ $user->role }}')" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-sm"
                                                    title="{{ __('app.edit') }}">
                                                <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span class="mr-1">{{ __('app.edit') }}</span>
                                            </button>
                                            
                                            <!-- View Button -->
                                            <a href="{{ route('admin.users.show', $user) }}" 
                                               class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-sm"
                                               title="{{ __('app.view') }}">
                                                <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span class="mr-1">{{ __('app.view') }}</span>
                                            </a>
                                            
                                            <!-- Activity Log Button -->
                                            <button onclick="showUserActivity('{{ $user->id }}', '{{ $user->name ?? $user->username }}')" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-sm"
                                                    title="{{ __('app.activity_log') }}">
                                                <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="mr-1">{{ __('app.activity_log') }}</span>
                                            </button>
                                            
                                            <!-- Ban/Unban Button -->
                                            @if($user->isBanned())
                                                <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-sm"
                                                            onclick="return confirm('{{ __('app.unban_confirmation') }}')"
                                                            title="{{ __('app.unban_user') }}">
                                                        <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <span class="mr-1">{{ __('app.unban_user') }}</span>
                                                    </button>
                                                </form>
                                            @else
                                                <button onclick="openBanModal('{{ $user->id }}', '{{ $user->name ?? $user->username }}')" 
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-sm"
                                                        title="{{ __('app.ban_user') }}">
                                                    <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728" />
                                                    </svg>
                                                    <span class="mr-1">{{ __('app.ban_user') }}</span>
                                                </button>
                                            @endif
                                            
                                            <!-- Warning Button -->
                                            <button onclick="openWarningModal('{{ $user->id }}', '{{ $user->name ?? $user->username }}')" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-sm"
                                                    title="{{ __('app.add_warning') }}">
                                                <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                </svg>
                                                <span class="mr-1">{{ __('app.add_warning') }}</span>
                                            </button>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200 shadow-sm"
                                                        onclick="return confirm('{{ __('app.delete_confirmation') }}')"
                                                        title="{{ __('app.delete') }}">
                                                    <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span class="mr-1">{{ __('app.delete') }}</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- ================= Pagination ================ -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                    {{ $users->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="card-body">
                    <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_users') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.empty_state_message') }}</p>
                <div class="mt-6">
                    <a href="{{ route('admin.users.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                {{ __('app.add_user') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Employee Modal -->
<div id="editEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-2xl rounded-xl bg-white dark:bg-gray-800 transform transition-all duration-300 ease-out -translate-y-4 opacity-0">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.edit_employee') }}</h3>
                <button onclick="closeModal('editEmployeeModal')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.users.update', 0) }}" id="editEmployeeForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="employee_id" id="edit_employee_id">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.name') }}:</label>
                        <input type="text" name="name" id="edit_name" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.username') }}:</label>
                        <input type="text" name="username" id="edit_username" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.email') }}:</label>
                        <input type="email" name="email" id="edit_email" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.user_role') }}:</label>
                        <select name="role" id="edit_role" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="admin">{{ __('app.admin') }}</option>
                            <option value="manager">{{ __('app.manager') }}</option>
                            <option value="moderator">{{ __('app.moderator') }}</option>
                            <option value="employee">{{ __('app.employee') }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 space-x-reverse mt-8">
                    <button type="button" onclick="closeModal('editEmployeeModal')" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        {{ __('app.cancel') }}
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        {{ __('app.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- User Activity Modal -->
<div id="userActivityModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-4/5 max-w-4xl shadow-2xl rounded-xl bg-white dark:bg-gray-800 transform transition-all duration-300 ease-out -translate-y-4 opacity-0">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    <svg class="h-5 w-5 inline ml-2 text-warning-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('app.activity_log') }} - <span id="activityUserName"></span>
                </h3>
                <button onclick="closeModal('userActivityModal')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div id="activityContent" class="space-y-4">
                <!-- Activity content will be loaded here -->
            </div>
        </div>
    </div>
</div>
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-2xl rounded-xl bg-white dark:bg-gray-800 transform transition-all duration-300 ease-out -translate-y-4 opacity-0">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.edit_employee') }}</h3>
                <button onclick="closeModal('editEmployeeModal')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.users.update', 0) }}" id="editEmployeeForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="employee_id" id="edit_employee_id">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.name') }}:</label>
                        <input type="text" name="name" id="edit_name" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.username') }}:</label>
                        <input type="text" name="username" id="edit_username" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.email') }}:</label>
                        <input type="email" name="email" id="edit_email" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.user_role') }}:</label>
                        <select name="role" id="edit_role" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="admin">{{ __('app.admin') }}</option>
                            <option value="manager">{{ __('app.manager') }}</option>
                            <option value="moderator">{{ __('app.moderator') }}</option>
                            <option value="employee">{{ __('app.employee') }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 space-x-reverse mt-8">
                    <button type="button" onclick="closeModal('editEmployeeModal')" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        {{ __('app.cancel') }}
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        {{ __('app.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Ban User Modal -->
<div id="banUserModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-2xl rounded-xl bg-white dark:bg-gray-800 transform transition-all duration-300 ease-out -translate-y-4 opacity-0">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.ban_user') }}</h3>
                <button onclick="closeModal('banUserModal')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="" id="banUserForm">
                @csrf
                <input type="hidden" name="user_id" id="ban_user_id">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.user') }}:</label>
                        <p class="text-sm text-gray-900 dark:text-white font-medium" id="ban_user_name"></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.ban_reason') }}:</label>
                        <textarea name="reason" required rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                  placeholder="{{ __('app.enter_ban_reason') }}"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.ban_type') }}:</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="permanent" value="0" checked
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300"
                                       onchange="toggleBanDuration()">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('app.temporary_ban') }}</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="permanent" value="1"
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300"
                                       onchange="toggleBanDuration()">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('app.permanent_ban') }}</span>
                            </label>
                        </div>
                    </div>
                    
                    <div id="banDurationFields">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.duration') }}:</label>
                                <input type="number" name="duration" min="1" value="1"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.duration_type') }}:</label>
                                <select name="duration_type"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="hours">{{ __('app.hours') }}</option>
                                    <option value="days" selected>{{ __('app.days') }}</option>
                                    <option value="weeks">{{ __('app.weeks') }}</option>
                                    <option value="months">{{ __('app.months') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="ban_device" value="1"
                                   class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('app.ban_device_also') }}</span>
                        </label>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 space-x-reverse mt-8">
                    <button type="button" onclick="closeModal('banUserModal')" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('app.cancel') }}
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        {{ __('app.ban_user') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Warning Modal -->
<div id="warningModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-2xl rounded-xl bg-white dark:bg-gray-800 transform transition-all duration-300 ease-out -translate-y-4 opacity-0">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('app.add_warning') }}</h3>
                <button onclick="closeModal('warningModal')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form method="POST" action="" id="warningForm">
                @csrf
                <input type="hidden" name="user_id" id="warning_user_id">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.user') }}:</label>
                        <p class="text-sm text-gray-900 dark:text-white font-medium" id="warning_user_name"></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('app.warning_reason') }}:</label>
                        <textarea name="reason" required rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                  placeholder="{{ __('app.enter_warning_reason') }}"></textarea>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 space-x-reverse mt-8">
                    <button type="button" onclick="closeModal('warningModal')" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        {{ __('app.cancel') }}
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        {{ __('app.add_warning') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ================= Scripts ================ -->
<script>
function editEmployee(id, name, username, email, role) {
    document.getElementById('edit_employee_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_role').value = role;
    document.getElementById('editEmployeeForm').action = '{{ route("admin.users.update", "") }}/' + id;
    
    const modal = document.getElementById('editEmployeeModal');
    modal.classList.remove('hidden');
    // إضافة تأثير الحركة
    setTimeout(() => {
        modal.querySelector('.relative').classList.add('translate-y-0', 'opacity-100');
        modal.querySelector('.relative').classList.remove('-translate-y-4', 'opacity-0');
    }, 10);
}

function showUserActivity(userId, userName) {
    document.getElementById('activityUserName').textContent = userName;
    
    // تحميل أنشطة المستخدم
    fetch(`/admin/users/${userId}/activities`)
        .then(response => response.json())
        .then(data => {
            const activityContent = document.getElementById('activityContent');
            
            if (data.activities && data.activities.length > 0) {
                let html = '<div class="space-y-4">';
                data.activities.forEach(activity => {
                    // تحديد لون النشاط حسب النوع
                    let activityColor = 'bg-gray-100 text-gray-800';
                    let activityIcon = `<svg class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>`;
                    
                    switch(activity.type) {
                        case 'login':
                            activityColor = 'bg-green-100 text-green-800';
                            activityIcon = `<svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>`;
                            break;
                        case 'logout':
                            activityColor = 'bg-red-100 text-red-800';
                            activityIcon = `<svg class="h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>`;
                            break;
                        case 'create':
                            activityColor = 'bg-blue-100 text-blue-800';
                            activityIcon = `<svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>`;
                            break;
                        case 'update':
                            activityColor = 'bg-yellow-100 text-yellow-800';
                            activityIcon = `<svg class="h-4 w-4 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>`;
                            break;
                        case 'delete':
                            activityColor = 'bg-red-100 text-red-800';
                            activityIcon = `<svg class="h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>`;
                            break;
                        case 'password_change':
                            activityColor = 'bg-purple-100 text-purple-800';
                            activityIcon = `<svg class="h-4 w-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>`;
                            break;
                    }
                    
                    html += `
                        <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                        ${activityIcon}
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">${activity.description}</p>
                                    <div class="flex items-center space-x-2 space-x-reverse mt-1">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">${activity.created_at}</p>
                                        ${activity.ip_address ? `<span class="text-xs text-gray-400">•</span><p class="text-xs text-gray-500 dark:text-gray-400">{{ __('app.ip_address') }}: ${activity.ip_address}</p>` : ''}
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${activityColor}">
                                    ${activity.formatted_action || activity.type}
                                </span>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                activityContent.innerHTML = html;
            } else {
                activityContent.innerHTML = `
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.no_activities') }}</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.no_activities_message') }}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('{{ __('app.error_loading_activities') }}:', error);
            document.getElementById('activityContent').innerHTML = `
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('app.error_loading_activities') }}</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('app.try_again_later') }}</p>
                </div>
            `;
        });
    
    const modal = document.getElementById('userActivityModal');
    modal.classList.remove('hidden');
    // إضافة تأثير الحركة
    setTimeout(() => {
        modal.querySelector('.relative').classList.add('translate-y-0', 'opacity-100');
        modal.querySelector('.relative').classList.remove('-translate-y-4', 'opacity-0');
    }, 10);
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    const modalContent = modal.querySelector('.relative');
    
    // إضافة تأثير الإغلاق
    modalContent.classList.add('-translate-y-4', 'opacity-0');
    modalContent.classList.remove('translate-y-0', 'opacity-100');
    
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

window.onclick = function(event) {
    const editModal = document.getElementById('editEmployeeModal');
    const activityModal = document.getElementById('userActivityModal');
    const banModal = document.getElementById('banUserModal');
    const warningModal = document.getElementById('warningModal');
    
    if (event.target === editModal) {
        closeModal('editEmployeeModal');
    }
    if (event.target === activityModal) {
        closeModal('userActivityModal');
    }
    if (event.target === banModal) {
        closeModal('banUserModal');
    }
    if (event.target === warningModal) {
        closeModal('warningModal');
    }
}

// Ban Modal Functions
function openBanModal(userId, userName) {
    document.getElementById('ban_user_id').value = userId;
    document.getElementById('ban_user_name').textContent = userName;
    document.getElementById('banUserForm').action = '{{ url("/admin/users") }}/' + userId + '/ban';
    
    const modal = document.getElementById('banUserModal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.relative').classList.add('translate-y-0', 'opacity-100');
        modal.querySelector('.relative').classList.remove('-translate-y-4', 'opacity-0');
    }, 10);
}

// Toggle Ban Duration Fields
function toggleBanDuration() {
    const permanentBan = document.querySelector('input[name="permanent"][value="1"]');
    const durationFields = document.getElementById('banDurationFields');
    
    if (permanentBan.checked) {
        durationFields.style.display = 'none';
    } else {
        durationFields.style.display = 'block';
    }
}

// Warning Modal Functions
function openWarningModal(userId, userName) {
    document.getElementById('warning_user_id').value = userId;
    document.getElementById('warning_user_name').textContent = userName;
    document.getElementById('warningForm').action = '{{ url("/admin/users") }}/' + userId + '/warning';
    
    const modal = document.getElementById('warningModal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.relative').classList.add('translate-y-0', 'opacity-100');
        modal.querySelector('.relative').classList.remove('-translate-y-4', 'opacity-0');
    }, 10);
}
</script>


@endsection 