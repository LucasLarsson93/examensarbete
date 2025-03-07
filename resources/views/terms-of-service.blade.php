<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('common.head')
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50" id="top">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                @include('common.header')
                <main class="mt-6">
                    <!-- Terms of service -->
                    <section id="terms-service"
                        class="my-10 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] rounded-lg bg-white p-6 dark:bg-zinc-900 dark:ring-zinc-800 dark:ring-1 dark:ring-white/[0.05] dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                        <h3 class="text-2xl font-semibold text-[#FF2D20] mb-4">Terms of Service</h3>
                        <p class="text-lg text-black/50 dark:text-white/50">
                            Please read these terms of service carefully before using our website.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Conditions of Use</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            We will provide their services to you, which are subject to the conditions stated below in
                            this document. Every time you visit this website, use its services or make a purchase, you
                            accept the following conditions. This is why we urge you to read them carefully.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">License and Site Access</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            We grant you a limited license to access and make personal use of this website. You are not
                            allowed to download or modify it. This may be done only with written consent from us.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">User Account</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            If you are provided with an account, you are responsible for maintaining the confidentiality
                            of your account and password and for restricting access to your computer. You agree to
                            accept responsibility for all activities that occur under your account or password.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">User Content</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            We do not own any data, information or material that you submit to the website for the
                            purpose of the service. You are responsible for your created content.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Applicable Law</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            By visiting this website, you agree that the laws of the country without regard to
                            principles of conflict laws will govern these terms of service, or any dispute of any sort
                            that might come between us and you, or its business partners and associates.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Disputes</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            Any dispute related in any way to your visit to this website or to products you purchase
                            from us shall be arbitrated by state or federal court and you consent to exclusive
                            jurisdiction and venue of such courts.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Comments, Reviews, and Emails</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            Visitors may post content as long as it is not obscene, illegal, defamatory, threatening,
                            infringing of intellectual property rights, invasive of privacy or injurious in any other
                            way to third parties. Content has to be free of software viruses, political campaign, and
                            commercial solicitation.
                        </p>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            We reserve all rights (but not the obligation) to remove and/or edit such content. When you
                            post your content, you grant us non-exclusive, royalty-free and irrevocable right to use,
                            reproduce, publish, modify such content throughout the world in any media.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">License and Site Access</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            We grant you a limited license to access and make personal use of this website. You are not
                            allowed to download or modify it. This may be done only with written consent from us.
                        </p>
                    </section>
            </div>
        </div>
        </main>
        @include('common.footer')
    </div>
</body>

</html>
