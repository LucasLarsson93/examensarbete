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
                        {{-- Jumbotron --}}
                        <div class="bg-gray-800 text-white py-20 mb-4 rounded-lg">
                            <div class="container mx-auto p-4">
                                <h1 class="text-4xl font-bold mb-4">Welcome to my Forum</h1>
                                <p class="text-lg">This has been my graduation project as a Fullstack student at Nackademin in Stockholm. If you want to read the documentation about my graduation project you will find a link to the Github Repository below. Register an account to explore the forum.</p>
                                <p class="text-lg">Since the first release, I have continued to developing this project by adding new features.</p>
                                <div class="mt-6">
                                    <a href="https://codebylucas.com/categories/announcements/" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg mt-6 text-center w-32 animate-pulse">View admin threads</a>
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8" style="margin-bottom:2rem;">
                            <div class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="relative flex w-full flex-1 items-stretch">
                                    <div class="absolute -bottom-12 -left-12 h-32 w-[calc(100%+6rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"></div>
                                </div>
                                <div class="relative flex items-center gap-6 lg:items-end">
                                    <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                        <i class="fa fa-comments fa-3x text-[#FF2D20] dark:text-white"></i>
                                    </div>
                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Engaging Topics</h2>
                                        <p class="mt-4 text-sm/relaxed">
                                            Dive into the forum with discussions covering everything from tech trends to your favorite food recipe. Join the conversation!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="relative flex w-full flex-1 items-stretch">
                                    <div class="absolute -bottom-12 -left-12 h-32 w-[calc(100%+6rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"></div>
                                </div>
                                <div class="relative flex items-center gap-6 lg:items-end">
                                    <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                        <i class="fa fa-cog fa-3x text-[#FF2D20] dark:text-white"></i>
                                    </div>
                                    <div class="pt-3 sm:pt-5 lg:pt-0">
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Forum Features</h2>
                                        <p class="mt-4 text-sm/relaxed">
                                            This forum has a lot of features such as creating topics, replying to topics, editing and deleting topics, user role management and much more.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            @include('common.footer')
        </div>
    </body>
</html>
