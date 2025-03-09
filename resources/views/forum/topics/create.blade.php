<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <?php
    $guestUserId = env('GUEST_USER_ID', 118);
    ?>
    {{-- Vite to include my scss. --}}
    @vite(['resources/scss/app.scss'])
    <div class="py-12">
        {{-- Form to create a topic --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-semibold">{{ __('Create new topic') }}</h3>
                        </div>
                    </div>
                    <?php
                        if(Auth::user()->id == $guestUserId) {
                            echo "You are logged in as Guest and cannot create a topic."; 
                        } else {
                            ?>
                        @include('forum.common.create-topic')
                            <?php
                        }
                    ?>
                </div>
            </div>

        </div>
</x-app-layout>
