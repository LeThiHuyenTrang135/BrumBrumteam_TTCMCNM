<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $table = 'blog_comments';
    protected $primaryKey = 'id';
    protected $quarded = [];

    //relation with blog
    public function blog()
    {
        return $this->hasMany(Blog::class, 'blog_id', 'id');
    }
}
