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
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">{{ __("Reply to topic") }}</h3>
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
                    {{-- Form to reply to the topic --}}
                    <form method="POST" action="/topics/{{ $topic->id }}/posts">
                        @csrf
                        <div class="mb-4">
                            <label for="post_content" class="block text-sm font-medium text-gray-700">Post content</label>
                            {{-- Textarea for ckeditor post_content --}}
                            <textarea name="post_content" id="post_content" rows="3"></textarea>
                        </div>
                        <div class="flex items-center justify-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __("Reply") }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Topic content goes here. -->
                        <div class="post post main-post">
                            <div class="post-header">
                                <div class="">
                                    <h2 class="post-title"></h2>
                                    <div class="post-options">
                                        <?php 
                                        if(Auth::user()->is_admin || Auth::user()->id == $topic->user_id)
                                        {
                                            echo '<div class="post-options-item">';
                                            echo '<a href="/topics/'.$topic->id.'/delete" class="text-sm text-blue-500 hover:underline"><i class="fa fa-trash"></i></a>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                                <div class="post-body">
                                    <?php 
                                    if(Auth::user()->id == $topic->user_id)
                                    {
                                        echo '<div class="post-body-edit">';
                                        echo '<a href="/topics/'.$topic->id.'/edit/" class="text-sm text-blue-500 hover:underline"><i class="fa fa-edit"></i></a>';
                                        echo '</div>';
                                    }
                                    ?>
                                    <p>{!! $topic->content !!}</p>
                                </div>
                                <div class="post-footer">
                                    <div class="post-footer-meta">
                                        <div class="post-metadata">
                                            <span class="post-author">{{ $topic->user->name }}</span>
                                            <span class="post-metadata-date">{{ $topic->created_at }}</span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- Posts related to the topic go here -->
                        @foreach ($posts as $post)
                            <div class="post post">
                                <div class="post-header">
                                    @if (Auth::user()->is_admin || Auth::user()->id == $post->user_id)
                                        <div class="post-options-item">
                                            <a href="/topics/{{ $topic->id }}/delete/post/{{ $post->id }}" class="text-sm text-blue-500 hover:underline"><i class="fa fa-trash"></i></a>
                                        </div>
                                    @endif
                                </div>
                                <div class="post-body">
                                    @if (Auth::user()->id == $post->user_id)
                                        <div class="post-body-edit">
                                            <a href="/topics/{{ $topic->id }}/edit/post/{{ $post->id }}" class="text-sm text-blue-500 hover:underline"><i class="fa fa-edit"></i></a>
                                        </div>
                                    @endif
                                    <div class="mt-4">
                                        <p class="post-text">{!! $post->post_content !!}</p>
                                    </div>
                                </div>
                                <div class="post-footer">
                                    <div class="post-footer-meta">
                                        <div class="post-metadata">
                                            @if ($post->user)
                                                <span class="post-author">{{ $post->user->name }}</span>
                                            @endif
                                            <span class="post-metadata-date">{{ $post->created_at }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
            @if ($topic->posts->count() > 4)
            {{ $posts->links() }} <!-- Pagination links -->

            @elseif ($topic->posts->count() == 0)
            <div class="post post">
                <div class="post-body">
                    <div class="mt-4">
                        <p>No posts related to this topic.</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
