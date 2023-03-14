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

class PostController extends Controller
{
    public function accueil(Request $request)
    {
        if(Auth::check()){
            
            
            $posts = Post::orderBy('created_at', 'desc')->get();
            $categories = category::all();
            return view('accueil',['posts'=>$posts, 'categories'=>$categories]);
            }
        return redirect('/login');
    }
    public function store(Request $request){
        $user = Auth::user();
        $post = new Post;
        $post->image = $request->file('image')->store('image','public');
        $post->body = $request->body; 
        $post->id_user = $user->id;
        // dd($request->category);
        $post->save();
        $post->category()->attach($request->category);

        
        return redirect('/')->with('flash_message','post added ');
    }

    public function addComment(Request $request){
        
        $user = Auth::user();
       
        $comment = new Comment;
        $comment->comment = $request->comment; 
        $comment->id_user = $user->id;
        $comment->id_post = $request->id_post;
        $comment->save();
        // return redirect('/')->with('flash_message','post added ');
        return response($comment);
        
    }

    // public function search(Request $request){
    //     $search_word = $request->search;
    //     $categories = category::all();
    //     $posts = Post::all();
        
    //     return view('accueil',['posts'=>$posts , 'comments'=>$comments,'categories'=>$categories]);
    // }

    public function remove($id){
        $post = Post::find($id);
        $post->delete();
        return redirect('/');
    }

    public function l(Request $request){
        $user = Auth::user();
        // dd($request);
        // $post->image = $request->file('image')->store('image','public');
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('image','public');
        }
        $post->body = $request->body; 
        $post->id_user = $user->id;
        $postId = $request->postId;
        
        $post::where('id',$postId)->save();
        $post->category()->attach($request->category);

        
        return redirect('/')->with('flash_message','post added ');
    }



    public function update(Request $request) {
        $user = Auth::user();
        $postId = $request->postId;
        $post = Post::find($postId);
        // dd($request);

        $post->body = $request->body;
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('image','public');
        }
        $categories = category::find($request->category);
        $post->category()->sync($categories);
        $post->save();
        return redirect('/')->with('flash_message','post updated');
    }
}


?>