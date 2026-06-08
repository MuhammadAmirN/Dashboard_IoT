@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Assign Role</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Update role untuk pengguna</p>
            </div>

            <div class="p-6">
                <!-- User Info -->
                <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('user-management.update-role', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pilih Role</label>
                        
                        <div class="space-y-3">
                            @foreach($roles as $roleOption)
                                @php
                                    $roleDescriptions = [
                                        'user' => 'Pengguna regular - Akses dasar dashboard dan data sensor',
                                        'admin' => 'Admin - Akses management dan monitoring user',
                                        'super_admin' => 'Super Admin - Akses penuh, bisa assign role ke pengguna',
                                    ];
                                    $roleColors = [
                                        'user' => 'green',
                                        'admin' => 'orange',
                                        'super_admin' => 'red',
                                    ];
                                    $color = $roleColors[$roleOption];
                                @endphp
                                
                                <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer transition-colors {{ $user->role === $roleOption ? 'border-blue-500 bg-blue-50 dark:bg-blue-900' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500' }}">
                                    <input type="radio" name="role" value="{{ $roleOption }}" 
                                        {{ $user->role === $roleOption ? 'checked' : '' }}
                                        class="mt-1 h-4 w-4 text-blue-600">
                                    <div class="ml-4">
                                        <div class="flex items-center gap-2">
                                            <p class="font-semibold text-gray-900 dark:text-white">
                                                {{ ucfirst(str_replace('_', ' ', $roleOption)) }}
                                            </p>
                                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full 
                                                {{ $color === 'green' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' : '' }}
                                                {{ $color === 'orange' ? 'bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200' : '' }}
                                                {{ $color === 'red' ? 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' : '' }}
                                            ">
                                                @if($roleOption === 'super_admin')
                                                    Super
                                                @elseif($roleOption === 'admin')
                                                    Admin
                                                @else
                                                    User
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $roleDescriptions[$roleOption] }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Role Permissions Table -->
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-3">Permissions by Role</h3>
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <th class="text-left py-2 font-medium text-gray-700 dark:text-gray-300">Feature</th>
                                    <th class="text-center py-2 font-medium text-gray-700 dark:text-gray-300">User</th>
                                    <th class="text-center py-2 font-medium text-gray-700 dark:text-gray-300">Admin</th>
                                    <th class="text-center py-2 font-medium text-gray-700 dark:text-gray-300">Super Admin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                <tr>
                                    <td class="py-2 text-gray-700 dark:text-gray-300">View Dashboard</td>
                                    <td class="text-center">✓</td>
                                    <td class="text-center">✓</td>
                                    <td class="text-center">✓</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-700 dark:text-gray-300">View Sensor Data</td>
                                    <td class="text-center">✓</td>
                                    <td class="text-center">✓</td>
                                    <td class="text-center">✓</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-700 dark:text-gray-300">View User Management</td>
                                    <td class="text-center">✗</td>
                                    <td class="text-center">✓</td>
                                    <td class="text-center">✓</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-700 dark:text-gray-300">Assign/Change Roles</td>
                                    <td class="text-center">✗</td>
                                    <td class="text-center">✗</td>
                                    <td class="text-center">✓</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-700 dark:text-gray-300">Delete Users</td>
                                    <td class="text-center">✗</td>
                                    <td class="text-center">✗</td>
                                    <td class="text-center">✓</td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-gray-700 dark:text-gray-300">System Configuration</td>
                                    <td class="text-center">✗</td>
                                    <td class="text-center">✗</td>
                                    <td class="text-center">✓</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Update Role
                        </button>
                        <a href="{{ route('user-management.index') }}" class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-white rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 transition-colors text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
