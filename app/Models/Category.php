<?php

namespace Journey\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Journey\Models\Post;

class Category extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Attach a hasMany relationship to Category and Post
     * 
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static $validationRules = [
        'name' => 'required|unique:categories|min:3|max:191'
    ];
}
