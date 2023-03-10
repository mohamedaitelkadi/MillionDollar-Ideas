<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function post(){
        $this->belongsToMany(Post::class,'category_posts','id_post','id_category');
    }
}
