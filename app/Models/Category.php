<?php
 
 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
 class Category extends Model
 {
     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'name', 'description',
     ];
 
     /**
      * Get the topics for the category.
      */
     public function topics()
     {
         return $this->hasMany(Topic::class);
     }
 
    /*
    Get the posts for the topic.
    */
    public function posts()
    {
        return $this->hasManyThrough(Post::class, Topic::class);
    }
 }