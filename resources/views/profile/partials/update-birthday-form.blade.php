<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Enter birthday') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{-- Notification --}}
            {{ __('By default your birthday will be listed in the footer of the website.') }}
        </p>
    </header>

    <form method="post" action="#" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->updateBirthday->get('birthday')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
