<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- Vite to include my scss. --}}
    @vite(['resources/scss/app.scss'])
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-semibold">{{ __("Welcome back!") }}</h3>
                            <p class="text-sm text-gray-600">{{ __("You're logged in as") }} <span class="font-semibold">{{ Auth::user()->name }}</span>.</p>
                        </div>
                        {{-- Check if user is admin. --}}
                        @if (Auth::user()->is_admin)
                            <a href="#" class="text-sm text-blue-500 hover:underline">{{ __("Admin Dashboard") }}</a>
                        @endif
                    </div>
                    <div class="border-t border-gray-200 mt-6 pt-6">
                        <h4 class="text-lg font-semibold mb-4">Categories</h4>
                            <!-- Categories list goes here -->
                            <div class="categories-list">
                                <ul>
                                    @foreach($categories as $category)
                                    <a href="/categories/{{ $category->name }}">
                                        <li class="category-item">
                                            {{ $category->name }}
                                        </li>
                                    </a>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
