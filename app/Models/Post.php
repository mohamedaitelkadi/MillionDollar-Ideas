<?php

namespace App\Models;

use app\models\user;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'image',
    ];
    
    public function comment()
    {
            return $this->hasMany(Comment::class,'id','id_comment','comments');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id','users');
    }

    
    public function category(){
       return $this->belongsToMany(Category::class,'category_posts','id_post','id_category');
    }
    
}
