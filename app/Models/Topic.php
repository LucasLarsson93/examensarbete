<?php
 
 namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Topic extends Model
{
    /** 
* The table associated with the model. 
* 
* @var string 
*/
    protected $table = 'topics';
    /** 
* The attributes that are mass assignable. 
* 
* @var array 
*/
    protected $fillable = [
        'topic_cat', 'topic_subject', 'topic_message', 'topic_by'
    ];
}