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
                    <!-- Privacy Policy Section -->
                    <section id="privacy-policy"
                        class="my-10 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] rounded-lg bg-white p-6 dark:bg-zinc-900 dark:ring-zinc-800 dark:ring-1 dark:ring-white/[0.05] dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                        <h2 class="text-2xl font-semibold text-[#FF2D20] mb-4">Privacy Policy</h2>
                        <p class="text-lg text-black/50 dark:text-white/50">
                            Your privacy is important to us. This privacy policy outlines the types of personal
                            information that we collect and how we use it.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Log Files</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            We follow a standard procedure of using log files. These files log visitors when they visit
                            websites. All hosting companies do this and a part of hosting services' analytics. The
                            information collected by log files include internet protocol (IP) addresses, browser type,
                            Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the
                            number of clicks. These are not linked to any information that is personally identifiable.
                            The purpose of the information is for analyzing trends, administering the site, tracking
                            users' movement on the website, and gathering demographic information.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Cookies and Web Beacons</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            Like any other website, we use 'cookies'. These cookies are used to store information
                            including visitors' preferences, and the pages on the website that the visitor accessed or
                            visited. The information is used to optimize the users' experience by customizing our web
                            page content based on visitors' browser type and/or other information.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Privacy Policies</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            You may consult this list to find the Privacy Policy for each of the advertising partners of
                            our website. Our Privacy Policy was created with the help of the Privacy Policy Generator
                            and the Privacy Policy Generator Online.
                        </p>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web
                            Beacons that are used in their respective advertisements and links that appear on our
                            website, which are sent directly to users' browser. They automatically receive your IP
                            address when this occurs. These technologies are used to measure the effectiveness of their
                            advertising campaigns and/or to personalize the advertising content that you see on websites
                            that you visit.
                        </p>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            Note that our website has no access to or control over these cookies that are used by
                            third-party advertisers.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Third Party Privacy Policies</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            Our website's Privacy Policy does not apply to other advertisers or websites. Thus, we are
                            advising you to consult the respective Privacy Policies of these third-party ad servers for
                            more detailed information. It may include their practices and instructions about how to
                            opt-out of certain options.
                        </p>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            You can choose to disable cookies through your individual browser options. To know more
                            detailed information about cookie management with specific web browsers, it can be found at
                            the browsers' respective websites.
                        </p>
                        <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Children's Information</h3>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            Another part of our priority is adding protection for children while using the internet. We
                            encourage parents and guardians to observe, participate in, and/or monitor and guide their
                            online activity.
                        </p>
                        <table>
                            <ul>
                                <li>
                                    <h3 class="text-xl font-semibold text-[#FF2D20] mt-6">Online Privacy Policy Only
                                    </h3>
                                    <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                                        This Privacy Policy applies only to our online activities and is valid for
                                        visitors to our website with regards to the information that they shared and/or
                                        collect in our website. This policy is not applicable to any information
                                        collected offline or via channels other than this website.
                                    </p>
                                </li>
                            </ul>
                        </table>
                        <p class="text-lg text-black/50 dark:text-white/50 mt-4">
                            By using our website, you agree to the collection and use of information in accordance with
                            this policy.
                        </p>
                    </section>
            </div>
        </div>
        </main>
        @include('common.footer')
    </div>
</body>

</html>
