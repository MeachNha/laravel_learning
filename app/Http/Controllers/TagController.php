<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        // $tag = Tag::all();
         $categories = Category::all();
        $select = $request->input('select',5);
        $search = $request->input('search');

         $query = Tag::query()->orderBy('id','desc');
        if($search){
            $query->where('tag_name','like', '%' . $search . '%');

        }
        $tag= $query->paginate($select)->appends($request->except('page') );

        //return view('admin.tag.index', ['tagg' => $tag,'categories' => $categories]);
       return view('admin.tag.index', ['tagg' => $tag,'cats' => $categories]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {    
         $categories = Category::all();

         return view('admin.tag.create_edit',['cats' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // name from form
       $val= $request->validate([
            'tag_name' => 'required|string|max:255',
            'tag_status' => 'required',
        ]);
          
        // $tag = new Tag();
        // $tag->tag_name = $request->tag_name;
        // $tag->tag_status = $request->tag_status;

        // $tag->save();

        Tag::create([
            'tag_name'=>$val['tag_name'],
            'tag_status'=>$val['tag_status']
        ]);

     //   $name = $request->input('tag_name'); //or
     //  $name = $request->tag_name;


        return redirect()->route('tag.index')->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $categories = Category::all();

        return view('admin.tag.edit', ['tag' => $tag,'cats'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id,)
    {
         $validate= $request->validate([
            'tag_name' => 'required|string|max:255',
            'tag_status' => 'required',
          ]);
        
          $tag = Tag::findOrFail($id);

          $tag->update($validate);

      // update by using array
        //   $tag->update([
        //     'tag_name'=>$validate['tag_name'],
        //     'tag_status'=>$validate['tag_status']
        //   ]);

      return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tag.index');
    }
}
