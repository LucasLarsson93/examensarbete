{{-- resources/views/errors/404.blade.php --}}
<x-app-layout>
    <div class="mt-4 mb-4 border border-gray-200 rounded-lg p-6">
        <div class="flex flex-col items-center justify-center h-screen">
            <h1 class="text-6xl font-bold text-red-500">404</h1>
            <p class="text-lg text-gray-600 mt-4">Oops! The page you're looking for doesn't exist.</p>
            <a href="{{ route('dashboard') }}" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Go Back Home</a>
        </div>
    </div>
</x-app-layout>
