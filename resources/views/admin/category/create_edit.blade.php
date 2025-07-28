@extends('Layoutadmin.main')

@section('contentAdmin')
    <!-- Page content-->
    <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2">
          <h3>Create Category</h3>
          <a class="btn btn-success" href="{{Route('category.index')}}" role="button">Back</a>
        </div>
        <!-- Blog entries-->
        <div class="col-lg-12">
          <div class="card p-3">
            <form method="POST" action="{{ route('category.store') }}">
               @csrf
              <div class="mb-3">
                <label for="tag" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="tag" name="cat_name" />
              </div>
              <div class="mb-3">
                <label for="tag" class="form-label">Category Od</label>
                <input type="text" class="form-control" id="tag" name="cat_od" />
              </div>
               {{-- old use for reaksa domlai kom oy vea clear  --}}
               <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="cat_status" class="form-control">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
               </select>
             </div>
            
             
              <button type="submit" class="btn btn-primary mt-5 ">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection