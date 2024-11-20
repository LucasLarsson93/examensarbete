<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin dashboard
        </h2>
    </x-slot>
    {{-- Vite to include my scss. --}}
    @vite(['resources/scss/app.scss'])
    <div class="container mx-auto px-4 sm:px-8 max-w-3xl">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Success message --}}
        @if (session('success'))
            <div class="alert alert-success">
                <p class="alert-text">{{ session('success') }}</p>
            </div>
        @endif
        {{-- Error message --}}
        @if (session('error'))
            <div class="alert alert-danger">
                <p class="alert-text
                ">{{ session('error') }}</p>
            </div>
        @endif
        <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
            <h2 class="text-2xl leading-tight">
                Manage Users
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal shadow rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __("Name") }}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __("Email") }}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __("Role") }}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __("Actions") }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $user->is_admin ? __("Admin") : __("User") }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="text-indigo-600 hover:text-indigo-900">{{ __("Edit") }}</a>
                            <a href="{{ route('users.delete', ['id' => $user->id]) }}" class="text-red-600 hover:text-red-900 ml-4">{{ __("Delete") }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
    </div>
    {{-- Manage categories table --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
            <h2 class="text-2xl leading-tight">
                Manage Categories
            </h2>
            <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __("Create New Category") }}
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal shadow rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __("Name") }}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __("Slug") }}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __("Topics") }}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{ __("Actions") }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $category->name }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $category->slug }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $category->topics->count() }}</p>
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200 bg-white text-sm">
                            <div class="flex space-x-4">
                                <a href="/admin/categories/{{ $category->id }}/edit" class="text-indigo-600 hover:text-indigo-900 font-medium transition-all duration-300 ease-in-out">{{ __("Edit") }}</a>
                                <a href="/admin/categories/{{ $category->id }}/delete" class="text-red-600 hover:text-red-900 font-medium transition-all duration-300 ease-in-out">{{ __("Delete") }}</a>
                                <a href="/admin/categories/{{ $category->id }}/lock" class="text-yellow-600 hover:text-yellow-900 font-medium transition-all duration-300 ease-in-out">{{ __("Lock") }}</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
    </div>
</div>
</x-app-layout>
