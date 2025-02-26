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
            <div class="flex-rowrow">
            {{-- arrow button to top --}}
            <button onclick="topFunction()" id="myBtn" title="Go to top" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-full mt-6" style="margin-left:2rem;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
            </div>
        </div>
    </div>
</footer>
@vite('resources/js/topFunction.js')
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