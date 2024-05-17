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
                    {{-- Form to edit the post --}}
                    <form method="POST" action="{{ route('posts.update', ['topic_id' => $topic->id, 'post_id' => $post->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="post_content" class="block text-sm font-medium text-gray-700">Post content</label>
                            <textarea name="post_content" id="post_content" class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" rows="3">{{ $post->post_content }}</textarea>
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __("Edit") }}
                            </button>
                            <a href="{{ route('topic.single', ['categoryName' => strtolower($category->name), 'id' => $topic->id]) }}" class="btn btn-secondary ml-4">
                                {{ __("Cancel") }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
