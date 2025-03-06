<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('common.head')
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50" id="top">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                @include('common.header')
                <main class="mt-6">
                    <!-- Shop cards -->
                    <section id="shop" class="my-10 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] rounded-lg bg-white p-6 dark:bg-zinc-900 dark:ring-zinc-800 dark:ring-1 dark:ring-white/[0.05] dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                        <h3 class="text-2xl font-semibold text-[#FF2D20] mb-4">Shop</h3>
                        <p>
                            Welcome to our shop! We are still working on adding products to our shop. Please check back later.
                        </p>
                    </section>
                </div>
            </div>
        </main>
            @include('common.footer')
        </div>
    </body>
</html>
