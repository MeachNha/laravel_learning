@extends('Layoutadmin.main')

@section('contentAdmin')
    <!-- Page content-->
      <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2">
          <h3>Create Post</h3>
          <a class="btn btn-success" href="{{Route('post.index')}}" role="button">Back</a>
        </div>
        <!-- Blog entries-->
        <div class="col-lg-12">
          <div class="card p-3">
            <form method="POST" action="{{ route('post.update',$post->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
                  value="{{$post->title}}"
                />
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea
                  class="form-control"
                  id="content"
                  name="content"
                  rows="5"
                >{{$post->description}}</textarea>
              </div>
                <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control">
                  <option value="1" {{$post->id==1 ? 'avtive':''}}>Active</option>
                  <option value="0" {{$post->id==0 ? 'avtive':''}}>Inactive</option>
               </select>
             </div>
                <div class="mb-3">
                <label for="od" class="form-label">Od</label>
                <input
                  type="integer"
                  class="form-control"
                  id="od"
                  name="od"
                  value="{{$post->od}}"
                />
              </div>
              <div class="mb-3">
                <label for="Date" class="form-label">Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="date"
                  name="date"
                 value="{{ $post->published_at}}"
                />
              </div>
              <div class="mb-3">
                <label for="img" class="form-label"
                  >Choose Thumbnail</label
                >
                <input
                  class="form-control"
                  type="file"
                  id="img"
                  name="img"
                />
              </div>
              <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select
                  class="form-select"
                  name="category_id"
                  aria-label="Default select example"
                >
                  <option selected>Select Category</option>
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{$category->id==$post->category_id ? 'selected':''}}>{{ $category->cat_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="tags" class="form-label">Tag</label>
                <div class="tag-wrapper">
                  @foreach($tags as $tag)
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="tags[]"
                      value="{{$tag->id}}"
                      id="{{$tag->id}}"
                      {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'checked' : '' }}
                    />
                    <label class="form-check-label" for="tag{{$tag->id}}">{{$tag->tag_name}}</label>
                  </div>
                  @endforeach
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
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

@endsection