<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Import the Auth facade.
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Log; // Import the Log facade.

class TopicController extends Controller
{
    public function single($categoryName, $id)
    {
        // Retrieve the category by name.
        $category = Category::where('name', $categoryName)->firstOrFail();
        // Retrieve the topic by ID within the specified category.
        $topic = Topic::where('id', $id)->orderBy('id','DESC')
        ->where('category_id', $category->id)
        ->with('user') // Load the user relationship.
        ->with('posts') // Load the posts relationship.
        ->firstOrFail();
        
        // Retrieve posts related to the topic and eager load the user relationship.
        $posts = $topic->posts()
        ->with('user') // Load the user relationship for each post.
        ->orderBy('id', 'DESC')
        ->paginate(4);


        return view('topic', [
            'topic' => $topic,
            'category' => $category,
            'posts' => $posts
        ]);
    }

    // Store a new post in the database.
    public function storePost(Request $request, $topic_id)
    {
        // Validate the form data.
        $request->validate([
            'post_content' => 'required|string|max:255',
        ]);
    
        // Find the topic by ID
        $topic = Topic::findOrFail($topic_id);

        
        // Retrieve the category details based on the category_id of the topic.
        $category = Category::findOrFail($topic->category_id);

        // Create a new post instance and set its attributes
        $post = new Post();
        $post->post_topic = $topic->id;
        $post->post_content = $request->input('post_content');
        $post->post_date = now(); 
        $post->post_by = Auth::id(); // Current authenticated user id.
    
        // Save the new post to the database.
        $post->save();
        // Redirect the user back to the topic with a success message.
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
            $post = Post::where('post_topic', $topicId)
                        ->findOrFail($postId);
                        
            // Retrieve the associated topic.
            $topic = $post->topic;
    
            // Check if the authenticated user is authorized to delete the post
            if (Auth::user()->is_admin || Auth::id() === $post->post_by) {
                // Log the deletion of the post.
                Log::info('Post deleted', [
                    'post_id' => $post->id,
                    'post_topic' => $post->topic_id,
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

    //Delete a topic from the database.
    public function destroyTopic($id)
    {
        try {
            // Find the topic by ID.
            $topic = Topic::findOrFail($id);

            // Retrieve the category details based on the category_id of the topic.
            $category = Category::findOrFail($topic->category_id);

            // Check if the authenticated user is authorized to delete the topic.
            if (Auth::user()->is_admin || Auth::id() === $topic->user_id) {
                // Log the deletion of the topic and associated posts.
                Log::info('Topic deleted', [
                    'topic_id' => $topic->id,
                    'category_id' => $topic->category_id,
                    'user_id' => $topic->user_id,
                    'posts_deleted' => $topic->posts()->count(), // Log the number of posts deleted
                    'deleted_by' => Auth::user()->name, // Log the user who deleted the topic
                ]);

                //Delete the topic from the database.
                $topic->delete();

                //Delete all posts associated with the topic.
                $topic->posts()->delete();

                //Redirect the user back to the category with a success message.
                return redirect()->route('category.single', [
                    'name' => strtolower($category->name), 
                ])->with('success', 'The topic has been deleted successfully.');
            } else {
                //Redirect back with an error message if user is not authorized
                return back()->with('error', 'Unauthorized to delete this topic.');
            }
        } catch (\Exception $e) {
            //Log any errors that occur during topic deletion.
            Log::error('Error deleting topic', [
                'topic_id' => $id,
                'error_message' => $e->getMessage(),
            ]);

            //Redirect back with an error message.
            return back()->with('error', 'An error occurred while deleting the topic.');
        }
    }

    // Create a topic view.
    public function create($categoryName)
    {
        // Retrieve the category by ID.
        $category = Category::where('name', $categoryName)->firstOrFail();
        
        return view('create', [
            'category' => $category,
        ]);
    }

    // Store new topic into the database.
    public function store(Request $request, $category_id)
    {
        // Validate the form data.
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        try {
            // Find the category by ID.
            $category = Category::findOrFail($category_id);
    
            // Create a new topic instance and set its attributes.
            $topic = new Topic();
            $topic->title = $request->input('title');
            $topic->content = $request->input('content');
            $topic->user_id = Auth::id(); // Current authenticated user id.
            $topic->category_id = $category->id; // Use the category_id obtained from the category object.
    
            // Save the new topic to the database.
            $topic->save();
    
            // Redirect the user back to the category with a success message.
            return redirect()->route('category.single', [
                'name' => strtolower($category->name),
            ])->with('success', 'Your topic has been created successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message.
            Log::error('Error creating topic: ' . $e->getMessage());
    
            return back()->with('error', 'An error occurred while creating the topic.');
        }
    }
}