{{-- Footer --}}
<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <p class="text-sm text-gray-600">Forum built with Laravel by <strong>Lucas Larsson</strong>.</p>
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