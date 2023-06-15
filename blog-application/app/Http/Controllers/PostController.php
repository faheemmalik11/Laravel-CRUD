<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(){
        

        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts', compact('posts'));

    }

  

    public function create(){
        return view('admin.create-post');
    }

    public function store(){
        
        $inputs = request()->validate([
            'title' =>'required|min:3|max:255',
            'body' =>'required|min:3',
            'post_image' =>'file',
        ]);

        $inputs['post_image'] = request('post_image')->store('images');
        auth()->user()->posts()->create($inputs);
  
        request()->session()->flash('message-post-created', 'Post created successfully!');
        return redirect()->route('admin.posts.index');
    }
    
    public function show($id){
            $post = Post::find($id);
            return view('admin.edit-post', compact('post'));
        }

    public function update($id){
       
        
        $post = Post::find($id);

        $this->authorize('update', $post);
        $inputs = request()->validate([
            'title' =>'required|min:3|max:255',
            'body' =>'required|min:3',
            'post_image' =>'file',
        ]);

        $inputs['post_image'] = request('post_image')->store('images');
        $post->update($inputs);
      
        
        
        request()->session()->flash('message-post-updated', 'Post updated successfully!');
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
