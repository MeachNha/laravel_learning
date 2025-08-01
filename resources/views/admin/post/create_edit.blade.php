@extends('Layout.main')
@section('content')
    <!-- Page content-->
    <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2 ">
          <h3>Create Post</h3>
          <a class="btn btn-success" href="{{Route('post.index')}}" role="button">Back</a>
        </div>
        <!-- Blog entries-->
         <div class="d-flex justify-content-center align-items-center">
             <div class="col-lg-10">
          <div class="card p-3">
            <form method="POST" action="{{Route('post.store')}}" enctype="multipart/form-data">
               @csrf
              <div class="mb-3">
                <label for="tag" class="form-label">Post title</label>
                <input type="text" class="form-control"  name="title" />
              </div>
              <div class="mb-3">
                <label for="tag" class="form-label">Post description</label>
                <textarea cols="10" rows="5"class="form-control" id="tag" name="description"></textarea>
              </div>
              <div class="mb-3">
                <label for="tag" class="form-label">Post Date</label>
                <input type="date" class="form-control" id="tag" name="published_at" />
              </div>
               <div class="mb-3">
                <label for="tag" class="form-label">Post Img</label>
                <input type="file" class="form-control" id="tag" name="img" />
              </div>
              <div class="mb-3">
                <label for="tag" class="form-label">Post od</label>
                <input type="number" class="form-control" id="tag" value="{{$post->id+1}}" name="od" />
              </div>
               <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
               </select>
             </div> 
              <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select
                  class="form-select"
                  name="category_id"
                  aria-label="Default select example"
                >
                  <option selected>Select Category</option>
                  @foreach ($cats as $cat )
                     <option  value="{{$cat->id}}">{{$cat->cat_name}}</option>
                  @endforeach
                  
                 
                </select>
              </div>
              <div class="mb-3">
                <label for="tags" class="form-label">Tag</label>
                <div class="tag-wrapper">
                  @foreach ($tags as $tag)
                     <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="tags[]"
                      value="{{$tag->id}}"
                      id="tag1"
                    />
                    <label class="form-check-label" for="tag1">{{$tag->tag_name}}</label>
                  </div>
                  @endforeach
                  
               
                </div>
              </div>
              <button type="submit" class="btn btn-primary mt-5 ">Submit</button>
            </form>
          </div>
        </div>
         </div>
      </div>
        @if ($errors->any())
        <div style="color: red;">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

          @if (session('success'))
          <div style="color: green;">
            {{ session('success') }}
          </div>
          @endif

    </div>
@endsection
 
