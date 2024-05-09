<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- Head --}}
        @include('common.head')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 parentWrapper">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <footer>
                {{-- Footer --}}
                @include('common.footer')
            </footer>
        </div>
    </body>
</html>
