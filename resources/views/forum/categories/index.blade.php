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
                            {{-- Link to create topic view. --}}
                            <?php 
                            $categoryName = $name;
                            ?>
                            <a class="btn btn-primary" href="{{ route('topics.create', ['categoryName' => $categoryName]) }}">Create Topic</a>
                        </div>
                        {{-- Check if user is admin. --}}
                        @if (Auth::user()->is_admin)
                            <a href="/admin" class="text-sm text-blue-500 hover:underline">{{ __("Admin Dashboard") }}</a>
                        @endif
                    </div>
                    <div class="border-t border-gray-200 mt-6 pt-6">

                        @if (session('success'))
                            <div class="alert alert-success">
                               <p class="alert-text">{{ session('success') }}</p>
                            </div>
                        @endif
                            <!-- Topic list goes here -->
                            @if ($topics->isEmpty())
                            <p>No topics found for this category.</p>
                        @else
                        <div class="categories-list">
                            <ul>
                                @foreach ($topics as $topic)
                                    <a href="/categories/{{ $name }}/topics/{{ $topic->id }}">
                                        <li class="category-item"><strong>{{ $topic->title }} </strong><!-- Display total number of posts plus the topic to a count --> <span style="float:right;">{{ $topic->posts->count() }}<i class="fa fa-comments" aria-hidden="true" style="margin-left:1rem;"></i></span></li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                            {{ $topics->links() }} <!-- Pagination links -->
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
