<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>
{{-- Vite to include my scss. --}}
@vite(['resources/scss/app.scss'])
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex items-center mb-4">
        {{-- Fa fa icon as user. --}}
        <i class="fa fa-user-circle fa-5x text-blue-500 mr-4"></i>
        {{-- User name --}}
        <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
    </div>

    <div class="mb-4">
        <p class="text-gray-600">{{ $user->email }}</p>
    </div>
    {{-- Display if user is Administrator or a normal registered user. --}}
    @if ($user->is_admin)
        <div class="mb-4">
            <span class="bg-red-500 text-white font-semibold py-1 px-2 rounded">Administrator</span>
        </div>
    @else
    <div class="mb-4">
        <span class="bg-green-500 text-white font-semibold py-1 px-2 rounded">Registered user</span>
    </div>
    @endif
    {{-- Display the user's topics --}}
    <div class="mb-4">
        <h3 class="text-lg font-semibold">Topics</h3>
        <ul>
            {{-- Display maximum 5 topics then add a load more button. --}}
            @if ($user->topics->count() > 0)
                @foreach ($user->topics->take(5) as $topic)
                    <li>
                        <a href="#" class="text-blue-500 hover:underline">{{ $topic->title }}</a>
                    </li>
                @endforeach
                @if ($user->topics->count() > 5)
                    <li>
                        <a href="#" class="text-blue-500 hover:underline">Load more...</a>
                    </li>
                @endif
            @else
                <li>No topics found.</li>
            @endif

        </ul>
    </div>

    <div class="flex items-center">
        <a href="{{ route('inbox', $user->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            <i class="fa fa-envelope mr-2"></i> Inbox
        </a>
    </div>
</div>
        </div>
    </div>
</div>
</x-app-layout>