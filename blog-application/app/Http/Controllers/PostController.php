<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(){
        

        $posts = auth()->user()->posts()->paginate(5);
        return view('admin-posts', compact('posts'));

    }

  

    public function create(){
        return view('create-post');
    }

    public function store(Request $request){
        
        $validated = $request->validate([
            'title' =>'required|min:3|max:255',
            'content' =>'required|min:3',
            'post_image' =>'file',
        ]);

        $file = $request->file('post_image');
        $name = $file->getClientOriginalName();
        $file->move('images/posts', $name);
        $user = auth()->user();
        $post = new Post(['title'=> $request->title , 'body'=>$request->content, 'post_image'=>$name]);
        $user->posts()->save($post);
        $request->session()->flash('message-post-created', 'Post created successfully!');
        return redirect()->route('admin.posts.index');
    }
    
    public function show($id){
            $post = Post::find($id);
            return view('edit-post', compact('post'));
        }

    public function update($id, Request $request){
       
        
        $post = Post::find($id);
        $this->authorize('update', $post);
        $validated = $request->validate([
            'title' =>'required|min:3|max:255',
            'content' =>'required|min:3',
            'post_image' =>'file',
        ]);

        $file = $request->file('post_image');
        $name = $file->getClientOriginalName();
        $file->move('images/posts', $name);
        $user = auth()->user();
        
        Post::where('id',$post->id)->update(['title'=> $request->title , 'body'=>$request->content, 'post_image'=>$name, 'user_id'=>$user->id]);
        $request->session()->flash('message-post-updated', 'Post updated successfully!');
        return redirect()->route('admin.posts.index');
    }

    public function delete(  $id, Request $request){

 
        $post = Post::find($id);
        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('message', 'Post deleted successfully!');
        return redirect()->route('admin.posts.index');
    }
    
    public function showBlogPost($id){
        $post = Post::find($id);
        return view('blog-post',compact('post'));
    }
}
