<?php

namespace Journey\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Journey\Models\Post;

class Tag extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
