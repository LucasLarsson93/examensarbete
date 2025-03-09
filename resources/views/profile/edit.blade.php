<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <?php
    $guestUserId = env('GUEST_USER_ID', 118);
    ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php
                    if(Auth::user()->id == $guestUserId) {
                        echo "You are logged in as Guest and cannot update this user's profile information."; 
                    } else {
                        ?>
                    @include('profile.partials.update-profile-information-form')
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php

                    if(Auth::user()->id == $guestUserId) {
                        echo "You cannot update this user's password.";
                    } else {
                        ?>
                    @include('profile.partials.update-password-form')
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <?php
                    if(Auth::user()->id == $guestUserId) {
                        echo "You cannot delete this user.";
                    } else {
                        ?>
                    @include('profile.partials.delete-user-form')
                    <?php
                    }
                    ?>
                </div>
            </div>
            {{-- Birthday information --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-birthday-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
