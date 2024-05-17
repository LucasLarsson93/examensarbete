<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('admin.dashboard') }}"><h2 class="font-semibold text-xl text-gray-800 leading-tight">
           {{ __('Admin Dashboard') }}
        </h2></a>
    </x-slot>
    {{-- Vite to include my scss. --}}
    @vite(['resources/scss/app.scss'])
    <div class="py-12">
        {{-- Reply option --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                    </div>
                    {{-- Display errors above the form --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- Display success. --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p class="alert-text">{{ session('success') }}</p>
                        </div>
                    @endif
                    {{-- Form to edit the category --}}
                    <p>Maximum 30 charachters.</p>
                    <form method="POST" action="{{ route('categories.update', ['id' => $category->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Category name</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $category->name }}">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" rows="3">{{ $category->description }}</textarea>
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __("Edit Category") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
