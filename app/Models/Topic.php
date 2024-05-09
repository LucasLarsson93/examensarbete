<?php
 
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 class Topic extends Model
 {
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'title', 'content', 'user_id', 'category_id', 'topic_id'
     ];
 
     /**
      * Get the topics for the category.
      */
     public function topics()
     {
         return $this->hasMany(Topic::class);
     }

    /**
    * Get the user that owns the topic.
    */
     public function user()
     {
         return $this->belongsTo(User::class); 
     }

    /**
     * Get the posts for the topic.
     */ 
     public function posts()
     {
        return $this->hasMany(Post::class, 'post_topic', 'id');
     }
 
 }