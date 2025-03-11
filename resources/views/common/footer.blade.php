{{-- Footer --}}
<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p class="text-sm text-gray-600">Forum built with Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP
            v{{ PHP_VERSION }}) | by <strong>Lucas Larsson</strong>.</p>
    </div>
    {{-- Forum total register users and newest member --}}
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
        <div class="text-sm text-gray-600">
            Total members: <span id="total-users" style="margin-right:2rem;"></span>
            {{-- Display latest registered user. --}}
            Newest member: <span id="latest-user"></span>
            {{-- Display online users. --}}
            <span class="ml-6">
                Online:
                    <span id="logged-in-users">Loading...</span>
                        <script>
                            function updateOnlineUsers() {
                                fetch('/online-users')
                                    .then(response => response.json())
                                    .then(data => {
                                        const loggedInUsersElement = document.getElementById('logged-in-users');
                                        if (data.no_users) {
                                            loggedInUsersElement.innerHTML = 'No users online.';
                                        } else {
                                            loggedInUsersElement.innerHTML = data.users.join(', ');
                                        }
                                    })
                                    .catch(error => console.error('Error fetching online users:', error));
                            }

                            setInterval(updateOnlineUsers, 30000);
                            updateOnlineUsers();
                        </script>
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
