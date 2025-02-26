{{-- Footer --}}
<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p class="text-sm text-gray-600">Forum built with Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) |  by <strong>Lucas Larsson</strong>.</p>
    </div>
    {{-- Forum total register users and newest member --}}
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <a href="#top" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Top</a>
        <div class="text-sm text-gray-600">
            Total members: <span id="total-users" style="margin-right:2rem;"></span>
            {{-- Display latest registered user. --}}
            Newest member: <span id="latest-user"></span>
        </div>
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
