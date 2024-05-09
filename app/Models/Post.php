<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'id'; // Assuming 'id' is the primary key
    protected $fillable = ['post_topic', 'content', 'post_by']; // Adjust fillable attributes as needed

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'post_topic', 'id');
    }

    /**
    * Get the user that owns the post.
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'post_by', 'id');
    }
}