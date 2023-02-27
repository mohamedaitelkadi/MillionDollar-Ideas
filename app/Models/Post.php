<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\models\user;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class,'id');
    }

    
}
