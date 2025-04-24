<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{


    protected $fillable = ['id', 'user_id', 'title', 'slug', 'content', 'thumbnail', 'status', 'published_at', 'created_at', 'update_at'];

}
