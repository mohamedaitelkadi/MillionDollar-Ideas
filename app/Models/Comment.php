<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'id_post',
    ];

    public function Post()
    {
        return $this->belongsTo(Post::class,'id_post','id','posts');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id','users');
    }
}
