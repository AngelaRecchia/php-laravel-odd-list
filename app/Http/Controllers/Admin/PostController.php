<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.index', compact('posts', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'cat_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->all();
        $newPost = new Post();

        $slug = Str::slug($data['title'],'-');
        $slugBase = $slug;
        $slugPresent = Post::where('slug', $slug)->first();

        $count = 1;
        while($slugPresent){
            $slug = $slugBase . '-' .$count;
            $slugPresent = Post::where('slug', $slug)->first();
            $count++;
        }

        $newPost->slug =  $slug;
        $newPost->fill($data);
        $newPost->save();

        if(array_key_exists('tags', $data)) {
           $newPost->tags()->attach($data['tags']); 
        }
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $cat = Category::where('id', $post->cat_id)->first();
        $tags = Tag::where('tag_id');
        return view('admin.posts.show', compact('post', 'cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'cat_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->all();

        if($data['title'] != $post->title){

            $slug = Str::slug($data['title'],'-');
            $slugBase = $slug;
            $slugPresent = Post::where('slug', $slug)->first();

            $contatore = 1;
            while($slug_presente){
                $slug = $slug_base . '-' . $contatore;
                $slugPresent = Post::where('slug', $slug)->first();
                $contatore++;
            }
            $data['slug'] = $slug;
        } 

        $post->update($data);

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('updated', 'Post successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $post->tags()->detach();
        return redirect()->route('admin.posts.index')->with('deleted', 'The post has been deleted');
    }
}
