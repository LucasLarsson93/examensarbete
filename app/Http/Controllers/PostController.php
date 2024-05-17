<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Import the Auth facade.
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Log; // Import the Log facade.
use Illuminate\Support\Facades\Validator; // Import the Validator facade.

class PostController extends Controller
{
    // Store a new post in the database.
    public function storePost(Request $request, $topic_id)
    {
    // Validate the form data
    $validator = Validator::make($request->all(), [
        // Validate the post content field and strip certain tags.
        'post_content' => ['required', 'string', 'min:1', 'max:1000', 'not_regex:/<script>/', 'not_regex:/<iframe>/', 'not_regex:/<object>/', 'not_regex:/<embed>/'],
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }        
    
        // Find the topic by ID
        $topic = Topic::findOrFail($topic_id);
    
        // Retrieve the category details based on the category_id of the topic
        $category = Category::findOrFail($topic->category_id);
    
        // Create a new post instance and set its attributes
        $post = new Post();
        $post->topic_id = $topic->id;
        $post->post_content = $request->input('post_content');
        $post->post_date = now(); 
        $post->user_id = Auth::id(); // Current authenticated user id
        
        // Save the new post to the database
        $post->save();
    
        // Redirect the user back to the topic with a success message
        return redirect()->route('topic.single', [
            'categoryName' => strtolower($category->name),
            'id' => $topic->id,
        ])->with('success', 'Your reply has been posted successfully.');
    }
    // Delete a post from the database.
    public function destroyPost($topicId, $postId)
    {
        try {
            // Find the post by ID within the specified topic.
            $post = Post::where('topic_id', $topicId)
                        ->findOrFail($postId);
                        
            // Retrieve the associated topic.
            $topic = $post->topic;
    
            // Check if the authenticated user is authorized to delete the post
            if (Auth::user()->is_admin || Auth::id() === $post->user_id) {
                // Log the deletion of the post.
                Log::info('Post deleted', [
                    'post_id' => $post->id,
                    'topic_id' => $post->topic_id,
                    'category_id' => $topic->category_id,
                    'deleted_by' => Auth::user()->name, // Log the user who deleted the post
                ]);
    
                // Delete the post from the database.
                $post->delete();
    
                // Redirect the user back to the topic with a success message.
                return redirect()->route('topic.single', [
                    'categoryName' => strtolower($topic->category->name),
                    'id' => $topicId,
                ])->with('success', 'Your reply has been deleted successfully.');
            } else {
                // Redirect back with an error message if user is not authorized
                return back()->with('error', 'Unauthorized to delete this post.');
            }
        } catch (\Exception $e) {
            // Log any errors that occur during post deletion.
            Log::error('Error deleting post', [
                'post_id' => $postId,
                'error_message' => $e->getMessage(),
            ]);
    
            // Redirect back with an error message.
            return back()->with('error', 'An error occurred while deleting the post.');
        }
    }

    // Edit post view.
    public function editPost($id, $post_id)
    {
        // Find the topic by ID.
        $topic = Topic::findOrFail($id);
        // Find the post by ID.
        $post = Post::where('topic_id', $id)->findOrFail($post_id);
        // Retrieve the category details based on the category_id of the topic.
        $category = Category::findOrFail($topic->category_id);
        // Check if the authenticated user is authorized to edit the post.
        if (Auth::user()->is_admin || Auth::id() === $post->user_id) {
            return view('editPost', [
                'topic' => $topic,
                'post' => $post,
                'category' => $category,
            ]);
        } else {
            // Redirect back with an error message if user is not authorized.
            return back()->with('error', 'Unauthorized to edit this topic.');
        }
    }

    // Store the updated post in the database.
    public function updatePost(Request $request, $id, $post_id)
    {

        $validator = Validator::make($request->all(), [
            'post_content' => ['required', 'string', 'min:1', 'max:1000', 'not_regex:/<script>/', 'not_regex:/<iframe>/', 'not_regex:/<object>/', 'not_regex:/<embed>/'],
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
    
        // Find the topic by ID.
        $topic = Topic::findOrFail($id);
        // Find the post by ID.
        $post = Post::where('topic_id', $id)->findOrFail($post_id);
        // Retrieve the category details based on the category_id of the topic.
        $category = Category::findOrFail($topic->category_id);

        // Check if the authenticated user is authorized to edit the post.
        if (Auth::user()->is_admin || Auth::id() === $post->user_id) {
            // Update the post content.
            $post->post_content = $request->input('post_content');
            // Save the updated post to the database.
            $post->save();
            // Redirect the user back to the topic with a success message.
            return redirect()->route('topic.single', [
                'categoryName' => strtolower($category->name),
                'id' => $id,
            ])->with('success', 'Your reply has been updated successfully.');
        } else {
            // Redirect back with an error message if user is not authorized.
            return back()->with('error', 'Unauthorized to edit this post.');
        }
    }
}