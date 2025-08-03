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
    public function index(Request $request)
    { 
            $search = $request->input('search');
            $select = $request->input('select',5);
            $query =Post::query()->orderBy('id','desc');  // same select*from category
            if ($search) {
            $query->where('title', 'like', '%' . $search . '%');  // same as WHERE tag_name LIKE '%search%'
            }
            $posts =$query->paginate($select)->appends($request->except('page') );
            return view('admin.post.index',compact('posts'));
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
            $path = $request->file('img')->storeAs('images','public');
        }
        // $post=Post::create([
        //     'title' => $val['title'],
        //     'description' => $val['content'],
        //     'published_at' => $val['date'],
        //     'od' => $val['od'],
        //     'status' => $val['status'],
        //     'user_id' => 1,
        //     'category_id' => $val['category_id'],
        //     'img' => $path,
        // ]);
        $post=new Post();
        $post->title = $val['title'];
        $post->description = $val['content'];
        $post->published_at = $val['date'];
        $post->od = $val['od'];
        $post->status = $val['status'];
        $post->user_id = 1; // Assuming a static user ID for now
        $post->category_id = $val['category_id'];
        $post->img = $path;
        $post->save();
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
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
           $val=$request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'nullable|date',
            'od' => 'nullable|string|max:255',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'img' => 'nullable|image|max:10240',
        ]);
        if ($request->hasFile('img')) {
                $oldImage = $post->img; 
                $path = $request->file('img')->store('images', 'public');
                $post->img = $path;
                if ($oldImage && file_exists(storage_path('app/public/' . $oldImage))) {
                    unlink(storage_path('app/public/' . $oldImage));
                }
            }

        $post->title = $val['title'];
        $post->description = $val['content'];
        $post->published_at = $val['date'];
        $post->od = $val['od'];
        $post->status = $val['status'];
        $post->user_id = 1; // Assuming a static user ID for now
        $post->category_id = $val['category_id'];
        $post->save();
        $post->tags()->sync($request->tags);
        return redirect()->route('post.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
