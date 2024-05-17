<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Admin extends Model
{

    protected $table = 'users';

    // Local scope for filtering admins
    public function scopeIsAdmin($query)
    {
        return $query->where('is_admin', true);
    }


    public function categories ()
    {
        return $this->hasMany(Category::class);
    }



}