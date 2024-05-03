<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}/{{ $name }} 
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
                            <button style="cursor:pointer; margin-top:4px; float:right; margin-bottom:4px; border:2px solid #0d6efd; border-radius:6px; padding:4px; font-weight:bold;" type="submit" class="btn btn-primary">Create Topic</button>
                        </div>
                        {{-- Check if user is admin. --}}
                        @if (Auth::user()->is_admin)
                            <a href="#" class="text-sm text-blue-500 hover:underline">{{ __("Admin Dashboard") }}</a>
                        @endif
                    </div>
                    <!-- Topic content goes here. -->


                    <!-- Posts related to the topic goes here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
