<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['topic_id', 'content', 'user_id']; 

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    /**
    * Get the user that owns the post.
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}