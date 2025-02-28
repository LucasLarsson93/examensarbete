<x-app-layout>
    <x-slot name="header">
        <h5 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Link back to admin dashboard --}}
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">{{ __('Dashboard') }}</a> / {{ __('Users') }}
        </h5>
    </x-slot>
    {{-- Vite to include my scss. --}}
    @vite(['resources/scss/app.scss'])
<div class="mb-6">
    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.users') }}" class="flex items-center space-x-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." class="w-1/3 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200">Search</button>
    </form>
</div>

<!-- User Table -->
<div class="overflow-x-auto bg-white shadow-lg rounded-lg">
    <table class="min-w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-gray-700 font-semibold">Name</th>
                <th class="px-6 py-3 text-left text-gray-700 font-semibold">Email</th>
                <th class="px-6 py-3 text-left text-gray-700 font-semibold">Role</th>
                <th class="px-6 py-3 text-left text-gray-700 font-semibold">IP Address</th>
                <th class="px-6 py-3 text-left text-gray-700 font-semibold">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-gray-800">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $user->is_admin ? "Administrator" : "User" }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $user->ip_address }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach

            @if($users->isEmpty())
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-600">No users found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $users->links('pagination::tailwind') }}
</div>
</x-app-layout>
