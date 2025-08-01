@extends('Layoutadmin.main')

@section('contentAdmin')

   <style>
    .myimgbox {
        width: 300px;
        height: 200px;
        background-size: cover;
        background-position: center;
        border: 1px solid #ccc;
        border-radius: 10px;
        cursor: pointer;
        
    }

    .myfile {
        display: none;
    }
    </style>

    <!-- Page content-->
    <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2">
          <h3>Edit Category</h3>
          <a class="btn btn-success" href="{{Route('post.index')}}" role="button">Back</a>
        </div>
        <!-- Blog entries-->
        <div class="col-lg-12">
          <div class="card p-3">
    <form method="POST" action="{{Route('post.update',$posts->id)}}"  enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label">Post title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $posts->title }}" />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Post description</label>
            <textarea class="form-control" name="description" id="description" cols="10" rows="5">{{ $posts->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="published_at" class="form-label">Post Date</label>
            <input type="date" class="form-control" name="published_at" id="published_at" value="{{ $posts->published_at }}" />
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label">Post Img</label>
             <input type="file" name="img"  accept="image/*">
        </div>
            @if ($posts->img !=null)
                <div>
                    <img width="200px" src="{{asset('storage/'.$posts->img)}}" alt="">
                </div>
            @endif
        <!-- Set default image using inline style -->
            {{-- <div class="myimgbox" id="previewBox"
                style="background-image: url('{{ asset($posts->img ? 'storage/' . $posts->img : 'storage/images/default.jpg') }}')"
                onclick="$('#imgInput').click();">
            </div>

            <input type="file" name="img" id="imgInput" class="myfile" accept="image/*"> --}}

        <div class="mb-3">
            <label for="od" class="form-label">Post od</label>
            <input type="number" class="form-control" name="od" id="od" value="{{ $posts->od }}" />
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" id="status">
                <option value="1" {{ $posts->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $posts->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category_id">
                <option disabled>Select Category</option>
                @foreach ($cats as $cat)
                    <option value="{{ $cat->id }}" {{ $posts->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->cat_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags</label>
            <div class="tag-wrapper">
                @foreach ($tags as $tag)
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="tags[]"
                            id="tag_{{ $tag->id }}"
                            value="{{ $tag->id }}"
                            {{ $posts->tags->contains($tag->id) ? 'checked' : '' }}
                        />
                        <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->tag_name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5">Update</button>
      </form>

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