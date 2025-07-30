<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Category;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return view('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $tags=Tag::all();
         $categories=Category::all();
         $post = Post::orderBy('id', 'desc')->first();
        //  dd($categories);
        return view('admin.post.create_edit', compact('tags', 'categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //create new post record
        $val=$request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'nullable|date',
            'od' => 'nullable|string|max:255',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|max:10240',
        ]);
        $path = "";
        if($request->hasFile('img')){
            $path = $request->file('img')->store('images', 'public');
        }
        $post=Post::create([
            'title' => $val['title'],
            'description' => $val['content'],
            'published_at' => $val['date'],
            'od' => $val['od'],
            'status' => $val['status'],
            'user_id' => 1,
            'category_id' => $val['category_id'],
            'img' => $path,
        ]);
        $post->tags()->sync($request->tags);
        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
