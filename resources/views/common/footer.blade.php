{{-- Footer --}}
<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p class="text-sm text-gray-600">Forum built with Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) |  by <strong>Lucas Larsson</strong>.</p>
    </div>
    {{-- Forum total register users and newest member --}}
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
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
    console.log('Textarea:', textarea);

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