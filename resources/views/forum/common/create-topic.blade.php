<form method="POST" action="{{ route('topics.store', ['category_id' => $category->id]) }}">
    @csrf
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" name="title" id="title"
            class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            required>
    </div>
    <div class="mb-4">
        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
        <textarea name="content" id="content"
            class="form-textarea mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            rows="3"></textarea>
    </div>
    <div class="flex items-center justify-end">
        <button type="submit" class="btn btn-primary">
            {{ __('Create Topic') }}
        </button>
    </div>
</form>