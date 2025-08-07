<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class FetchdatainfrontendController extends Controller
{
    
    // show data in frontend
 public function showdata(Request $request){
     
         $categories = Category::all();
          $tags = Tag::all();

         
      
       // Get all remaining posts except the latest one
        $lastdata = Post::with('user')
           ->where('status', 1)
           ->orderBy('od','desc')
           ->first();

   
      //get() Gets all matching records as a collection.    
         // $po = Post::where('status', 1)
         //    ->where('id', '!=', $lastdata->id) // Exclude the latest post
         //    ->orderBy('od', 'desc')
         //    ->get();
      
         //$categoryId mk pi request http dl ban and in header dl key jea $categoryId hz value jea $cat->id orr jab beb nis kr ban dl $categoryId = request()->input('categoryId');
         //category_id nis mk pi fill in table , with('user') mean relationship with post dl mean knong model psot. so use with('user') to can acces who post ,which uesr post 
   
         $po = Post::query()->with('user')
         ->when(request('categoryId'), function ($query, $categoryId) {
            
          return $query->where('category_id',$categoryId );
          })
          ->when(request('search'),function($query,$search){
            return $query->where('title','like','%'.$search.'%');
          })
          ->when(request('tagId'),function($query,$tagId){
             return $query->whereHas('tags', function ($q) use ($tagId) {
              $q->where('tags.id', $tagId); // filter posts that have this tag , tags is name fucntion nv knong model bos post dl dak relationship many to many
            });
          })->paginate(6);

           
         return view('index',

         ['mydata' => $po,'lastdata'=>$lastdata,'cats' => $categories,'tags'=> $tags]

        );
  }

   // show page detail
 
    public function showveiwdetail($id){

             $posts = Post::findOrFail($id);
             $tags = Tag::all();
              $categories = Category::all();
             
            return view('blog',['post'=>$posts,'tags'=> $tags,'cats'=>$categories]);
}

 public function showcat(){

            //  $posts = Post::findOrFail($id);
              $tags = Tag::all();
              $categories = Category::all();
             
            return view('category',['tags'=>$tags,'cats'=> $categories ]);
}



}
