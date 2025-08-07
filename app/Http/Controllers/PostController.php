<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $po = Post::all();
         $categories = Category::all();
          $search = $request->input('search');
          $select = $request->input('select');
        
          $query =Post::query()->orderBy('id','desc')->where('user_id',Auth::User()->id);  

        if ($search) {
         $query->where('title', 'like', '%' . $search . '%');  
       
         }
         
         $po =$query->paginate($select)->appends($request->except('page') );

         return view('admin.post.index',

         ['posts' => $po,'cats' => $categories]
        );
    }

// show data in frontend
//  public function showdata(){
     
//          $categories = Category::all();
//          $tags = Tag::all();
        
      
//     // Get all remaining posts except the latest one
//         $lastdata = Post::where('status', 1)
//            ->orderBy('od','desc')
//            ->first();
   
//       //get() Gets all matching records as a collection.    
//          $po = Post::where('status', 1)
//             ->where('id', '!=', $lastdata->id) // Exclude the latest post
//             ->orderBy('od', 'desc')
//             ->get();
           
//          return view('index',

//          ['mydata' => $po,'lastdata'=>$lastdata,'categories' => $categories,'tags'=> $tags]
//         );
// }



    // show page detail
 
//     public function showveiwdetail($id){

//              $posts = Post::findOrFail($id);
//              $tags = Tag::all();
              
             
//             return view('blog',['post'=>$posts,'tags'=> $tags]);
// }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        $cats = Category::all();
        // $posts= Post::orderBy('id','desc')->limit(1)->get(); 
         
        $post = Post::orderBy('id', 'desc')->first();

        //dd($posts);
        return view('admin.post.create_edit',['tags'=>$tags,'cats'=>$cats,'post'=>$post]);
       
}

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
    {
       $val = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'published_at' => 'required|date',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20240',
            'od' => 'nullable|integer',
            'status' => 'required'
            ]);

           // time() control file name oy jenh leak 09343423
           //getClientOriginalExtension() jab yk jpg,png or part jong kray bos img
          //store()	Auto-generated, storeAs() Your specify name

            $part ="";
            if ($request->hasFile('img')) {
                $filename = time().'.'.$request->file('img')->getClientOriginalExtension();
                $part = $request->file('img')->storeAs('images', $filename, 'public');
            }
            $post = new Post();
            $post->title= $request->title;
            $post->description= $request->description;
            $post->published_at = $request->published_at;
            $post->od = $request->od;
            $post->status= $request->status;
            $post->user_id=Auth::id();
            $post->category_id=$request->category_id;
            $post->img= $part;

        /* $post->tags()  is from public function tags(): BelongsToMany
                 {
                     return $this->belongsToMany(Tag::class);
                 }
           that has in Models Post  
          */
          /* $request->tags tags in sync ng jab yk name jenh pi tags dl mean name=tags[]
           sync() use for when table many to many jg vea jab dak domreb oy trov srab srab 

          */
          $post->save();
          $post->tags()->sync($request->tags);

         return redirect()->route('post.index')->with('success', 'post created successfully.');
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
         $posts = Post::findOrFail($id);
         $tags = Tag::all();
         $cats = Category::all();
          
        return view('admin.post.edit',['tags'=>$tags,'cats'=>$cats,'posts'=>$posts]);
}

    /**
     * Update the specified resource in storage.
     */
 


  public function update(Request $request,$id)
    {
        $val = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'published_at' => 'required|date',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20240',
            'od' => 'nullable|integer',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id'
            ]);
        
                 $posts = Post::findOrFail($id);
                 $data = $val;

                $oldimg = $posts->img; // Example: "images/oldimg.jpg"
                
                // If a new image is uploaded
                if ($request->hasFile('img')) {

                    // Delete old image if it exists
                    if ($oldimg && file_exists(storage_path('app/public/' . $oldimg))) {
                        unlink(storage_path('app/public/' . $oldimg));
                    }

                    // Save new image
                    $filename = time() . '.' . $request->file('img')->getClientOriginalExtension();
                    $path = $request->file('img')->storeAs('images', $filename, 'public'); // returns "images/filename.jpg"
                    
                     // Add image filename to data
                    $data['img'] = $path; // store "images/filename.jpg" into DB
                  
                    //  $data->img = $part;

                 }
   
            // Update post
            $posts->update($data);

            $posts->tags()->sync($request->tags);

           return redirect()->route('post.index')->with('success', 'post updated successfully.');
           
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post= Post::findOrFail($id);
        $post->delete();

        return redirect()->route('post.index');
    }
}
