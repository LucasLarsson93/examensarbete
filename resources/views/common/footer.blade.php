{{-- Footer --}}
<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p class="text-sm text-gray-600">Forum built with Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) | by <strong>Lucas Larsson</strong>.</p>
    </div>
    {{-- Forum total register users and newest member --}}
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
        <div class="text-sm text-gray-600">
            Total members: <span id="total-users" style="margin-right:2rem;"></span>
            {{-- Display latest registered user. --}}
            Newest member: <span id="latest-user"></span>
            {{-- Display online users. --}}
            <span class="ml-6">
                Online: <span id="logged-in-users">
                    <?PHP
                    // Get names of logged in users.
                    $users = DB::table('users')->where('is_online', 1)->get();
                    $usernames = [];
    
                    foreach ($users as $user) {
                        $backgroundColor = $user->is_admin ? 'bg-red-600' : 'bg-gray-600';
                        $usernames[] = '<span class="' . $backgroundColor . ' text-white font-bold px-2 py-1 rounded">' . $user->name . '</span>';
                    }
                    echo implode(', ', $usernames);
                    ?>
                </span>
            </span>
        </div>
        <!-- //style this button -->
        <a href="#top" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-2 rounded-md text-xs">Top</a>
    </div>
</footer>
<script>
    // Select all elements with IDs 'post_content' and 'content'
    const textareas = document.querySelectorAll('#post_content, #content');

    // Loop through each selected textarea element
    textareas.forEach(textarea => {
        // Initialize CKEditor for each textarea
        ClassicEditor.create(textarea)
            .then(editor => {
                console.log('CKEditor initialized:', editor);
            })
            .catch(error => {
                console.error('Error initializing CKEditor:', error);
            });
    });
</script>
