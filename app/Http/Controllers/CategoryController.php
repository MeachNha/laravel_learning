<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $categories = Category::all();

        // using by Query bulider
        $search = $request->input('search');
        $select = $request->input('select',5);

         $query =Category::query();  // same select*from category


        
         if ($search) {
         $query->where('cat_name', 'like', '%' . $search . '%');  // same as WHERE tag_name LIKE '%search%'
        //    $query->where('cat_name', 'like', '%' . $search . '%')->where('cat_status',1);
        //   Category::query()->where('cat_name', $search );


        //    select * from tbl where cat_name = $search ;
         }
         

         $categories =$query->paginate($select)->appends($request->except('page') );

        return view('admin.category.index',

         ['cats' => $categories]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
         $category = Category::all(); 
        
         return view('admin.category.create_edit', ['cats' => $category]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_od' => 'nullable|integer',
            'cat_status' => 'required',
        ]);
          
        $category = new Category();
        $category->cat_name = $request->cat_name;
        $category->cat_od = $request->cat_od;
        $category->cat_status = $request->cat_status;

        $category->save();

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
        // return redirect('/category')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Show form with data for edit
    //compact('category'):
    // This is a PHP helper function that creates an array like this:
    // ['category' => $category]
   //It passes the $category data to the view, so in the Blade file, you can access it like {{ $category->cat_name }}, etc.


    public function edit($id)
    {
       
            $category = Category::findOrFail($id);
            $allCategories = Category::all();

        //  $cats = Category::all();
       // dd($category);
          
        return view('admin.category.edit',
        [
             'cat' => $category,    // one item
             'cats' => $allCategories // collection used in header
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validated=$request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_od' => 'nullable|integer',
            'cat_status' => 'required',
        ]);
         
        $category = Category::findOrFail($id);
        $category->update($validated); 
          

        // $category ->update([
        //     'cat_name' => $request->cat_name,
        //     'cat_od' => $request->cat_od,
        //     'cat_status' => $request->cat_status,
        // ]);

       
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category= Category::findOrFail($id);
        $category->delete();
        
        return redirect()->route('category.index');

    }
}
