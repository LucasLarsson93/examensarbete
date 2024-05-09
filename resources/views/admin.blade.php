<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin dashboard
        </h2>
    </x-slot>
    {{-- Vite to include my scss. --}}
    @vite(['resources/scss/app.scss'])
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        {{-- Admin tools --}}
                        
                        <div class="">
                            <h3 class="text-lg font-semibold">{{ __("Admin tools") }}</h3>
                            <div class="flex items-center">
                                <ul>
                                    <li><a href="#">{{ __("Create Category") }}</a></li>
                                    <li><a href="#">{{ __("Manage Users") }}</a></li>
                                    <li><a href="#">{{ __("Manage Categories") }}</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
