<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class CommentController extends Controller
{
    public function find_comments(Request $request)
    {
        $id = $request->input('id_post');
        $comments = DB::table('comments')
        ->join('users', 'comments.id_user', '=', 'users.id')
        ->where('id_post', '=' , $id)
        ->get();
        echo (json_encode($comments));
    }
}
