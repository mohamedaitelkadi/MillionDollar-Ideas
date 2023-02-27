<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
    public function accueil(Request $request)
    {
        if(Auth::check()){
            $posts = Post::with('user','comment')->get();
            // echo '<pre>';
            // die(print_r($posts));
            // echo '</pre>';
            return view('accueil',['posts' => $posts]);


            }
        return redirect('/login');
    }
    public function store(Request $request){
        $user = Auth::user();

        $post = new Post;
        $post->image = $request->image; 
        $post->body = $request->body; 
        $post->id_user = $user->id;
        $post->save();
        return redirect('/')->with('flash_message','post added ');
    }

    public function edit(){
        return view('accueil');
    }

}
