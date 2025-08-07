@extends('Layoutadmin.main')

@section('contentAdmin')
    <!-- Page content-->
    <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2">
          <h3>Edit Category</h3>
          <a class="btn btn-success" href="{{Route('category.index')}}" role="button">Back</a>
        </div>
        <!-- Blog entries-->
        <div class="col-lg-12">
          <div class="card p-3">
            <form method="POST" action="{{ route('category.edit', $cat->id) }}">
               @csrf
                 {{-- PATCH jea ka comban knea POST hz ng GET --}}
                 @method('PATCH')
              <div class="mb-3">
                <label for="tag" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="tag" value="{{$cat->cat_name}}"  name="cat_name" />
              </div>
              <div class="mb-3">
                <label for="tag" class="form-label">Category od</label>
                <input type="text" class="form-control" id="tag" value="{{$cat->cat_od}}"  name="cat_od" />
              </div>
                <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="cat_status" class="form-control">
                    <option value="1" {{ $cat->cat_status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $cat->cat_status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
             </div>
              <button type="submit" class="btn btn-primary mt-5">Edit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection