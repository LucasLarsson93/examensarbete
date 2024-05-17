<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- Vite to include my scss. --}}
    @vite(['resources/scss/app.scss'])
    <div class="py-12">
        {{-- Reply option --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-semibold">{{ __("Edit your post") }}</h3>
                        </div>
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
                    {{-- Form to edit user account --}}
                    <form method="POST" action="{{ route('users.update', ['id' => $user->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->name }}">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" value="{{ $user->email }}">
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="role" class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="0" @if ($user->role == 'user') selected @endif>User</option>
                                <option value="1" @if ($user->role == 'admin') selected @endif>Admin</option>
                            </select>
                        <div class="flex items-center justify-end" style="margin-top:2rem;">
                            <button type="submit" class="btn btn-primary">
                                {{ __("Edit") }}
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ml-4">
                                {{ __("Cancel") }}
                            </a>
                        </div>
                    </form>
                    {{-- Danger download a user's logs --}}
                    <div class="flex items-center justify-end" style="margin-top:2rem;">
                        <a href="{{ route('users.logs', ['id' => $user->id]) }}" class="btn btn-danger">
                            {{ __("Download user logs") }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
