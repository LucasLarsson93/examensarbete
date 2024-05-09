<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- Vite to include my scss. --}}
    @vite(['resources/scss/app.scss'])
    <div class="py-12">
    {{-- Form to create a topic --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-semibold">{{ __("Create new topic") }}</h3>
                    </div>
                </div>

                <form method="POST" action="{{ route('topics.store', ['category_id' => $category->id]) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content" id="content" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" rows="3" required></textarea>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="btn btn-primary">
                            {{ __("Create Topic") }}
                        </button>
                    </div>
                </form>

    </div>
</div>

    </div>
</x-app-layout>
