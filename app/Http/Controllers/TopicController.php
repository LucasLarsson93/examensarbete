<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Import the Auth facade.
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Log; // Import the Log facade.
use Illuminate\Support\Facades\Validator; // Import the Validator facade.
use Illuminate\Support\Str; // Import the Str facade.
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Illuminate\Support\Facades\Storage; // Import the Storage facade.

class TopicController extends Controller
{
    public function single($categoryName, $id)
    {
        // Retrieve the category by name.
        $category = Category::where('name', $categoryName)->firstOrFail();
        // Retrieve the topic by ID within the specified category.
        $topic = Topic::where('id', $id)->orderBy('id','ASC')
        ->where('category_id', $category->id)
        ->with('user') // Load the user relationship.
        ->with('posts') // Load the posts relationship.
        ->firstOrFail();
        
        // Retrieve posts related to the topic and load the user relationship.
        $posts = $topic->posts()
        ->with('user') // Load the user relationship for each post.
        ->orderBy('id', 'ASC')
        ->paginate(4);


        return view('forum.topics.index', [
            'topic' => $topic,
            'title' => $topic->title,
            'category' => $category,
            'posts' => $posts
        ]);
    }

    //Google text to speech function.

    public function generateSpeech(Request $request)
    {
        try {
            // Content text from a topic.
            $content = $request->input('content');
            
            // Create a new TextToSpeechClient.
            $client = new TextToSpeechClient();

            // Create the SynthesisInput using the content
            $synthesisInput = new SynthesisInput();
            $synthesisInput->setText($content);
    
            // Create VoiceSelectionParams object
            $voiceSelectionParams = new VoiceSelectionParams();
            $voiceSelectionParams->setLanguageCode('sv-SE');
            $voiceSelectionParams->setSsmlGender(SsmlVoiceGender::NEUTRAL);
    
            // Create AudioConfig object
            $audioConfig = new AudioConfig();
            $audioConfig->setAudioEncoding(\Google\Cloud\TextToSpeech\V1\AudioEncoding::MP3);
    
            // Make the API call
            $response = $client->synthesizeSpeech($synthesisInput, $voiceSelectionParams, $audioConfig);
            $audioContent = $response->getAudioContent();
    
            $client->close();
    
            // Log success information
            Log::info('Text-to-Speech successfully generated for content: ' . $content);
    
            // Return the audio content as a response
            return response($audioContent)->header('Content-Type', 'audio/mpeg');
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Text-to-Speech error: ' . $e->getMessage());
            
            // Optionally, return a response with error information
            return response()->json(['error' => 'An error occurred while generating speech.'], 500);
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
                // Retrive category slug
                $categoryName = Category::where('id', $topic->category_id)->firstOrFail()->name;
                // Generate slug from category name.
                $slug = Str::slug($categoryName); // Generate slug from category name.
                //Redirect the user back to the category with a success message.
                return redirect()->route('category.single', [
                    'slug' => $slug, 
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

    // Create topic view.
    public function create($categoryName)
    {
        // Retrieve the category by ID.
        $category = Category::where('name', $categoryName)->firstOrFail();
        return view('forum.topics.create', [
            'category' => $category,
        ]);
    }


    public function store(Request $request, $category_id)
    {
        // Validate the form data.
        $request->validate([
            'title' => 'required|string|max:30|min:2',
            'content' => 'required|string|max:10000|min:2',
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
                'slug' => $category->slug,
            ])->with('success', 'Your topic has been created successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message.
            Log::error('Error creating topic: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while creating the topic.');
        }
    }

    // Edit topic view.
    public function editTopic($id)
    {
        // Find the topic by ID.
        $topic = Topic::findOrFail($id);
        $category = Category::findOrFail($topic->category_id);


        // Check if the authenticated user is authorized to edit the topic.
        if (Auth::user()->is_admin || Auth::id() === $topic->user_id) {
            return view('forum.topics.edit', [
                'topic' => $topic,
                'category' => $category,
            ]);
        } else {
            // Redirect back with an error message if user is not authorized.
            return back()->with('error', 'Unauthorized to edit this topic.');
        }
    }

    // Update topic in the database.
    public function update(Request $request, $id)
    {
        // Validate the form data.
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:2', 'max:30', 'not_regex:/<script>/', 'not_regex:/<iframe>/', 'not_regex:/<object>/', 'not_regex:/<embed>/'],
            'content' => ['required', 'string', 'min:2', 'max:10000', 'not_regex:/<script>/', 'not_regex:/<iframe>/', 'not_regex:/<object>/', 'not_regex:/<embed>/'],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 

        // Find the topic by ID.
        $topic = Topic::findOrFail($id);

        // Check if the authenticated user is authorized to update the topic.
        if (Auth::user()->is_admin || Auth::id() === $topic->user_id) {
            // Update the topic attributes.
            $topic->title = $request->input('title');
            $topic->content = $request->input('content');
            
            // Save the updated topic to the database.
            $topic->save();
            $categoryName = Category::where('id', $topic->category_id)->firstOrFail()->name;
            $slug = strtolower($categoryName);
            // Redirect the user back to the topic with a success message.
            return redirect()->route('topic.single', [
                'categoryName' => $slug,
                'id' => $topic->id,
            ])->with('success', 'Your topic has been updated successfully.');
        } else {
            // Redirect back with an error message if user is not authorized.
            return back()->with('error', 'Unauthorized to update this topic.');
        }
    }
}