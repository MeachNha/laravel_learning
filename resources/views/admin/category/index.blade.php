@extends('Layoutadmin.main')

@section('contentAdmin')
    <!-- Page content-->
    
    <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2">
          <h3>Category List</h3>
          <a class="btn btn-success" href="{{Route('create_edit.create')}}" role="button"
            >Create</a
          >
        </div>
        <!-- Blog entries-->
        <div class="col-lg-12">
          <div class="card p-3">
            <table
              {{-- id="datatable" --}}
              class="table table-striped"
              style="width: 100%"
            >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Category Name</th>
                  <th>Category od</th>
                  <th>Category Status</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
               @foreach ($categories as $cat)
                  <tr>
                      <td>{{ $cat->id }}</td>
                      <td>{{ $cat->cat_name }}</td>
                      <td>{{ $cat->cat_od }}</td>
                      <td>
                        @if($cat->cat_status == 1)
                           <span class="badge bg-success">Active</span>
                        @else
                           <span class="badge bg-danger">Inactive</span>
                        @endif
                      </td>
                      <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('category.edit',$cat->id) }}">Edit</a>
                      </td>
                  </tr>
              @endforeach

              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Tag</th>
                  <th>Action</th>
                </tr>
                
              </tfoot>

               {{-- <tfoot>
              <tr>
                <td colspan="5">
                  <div class="d-flex justify-content-end">
                    {{ $categories->links() }}
                  </div>
                </td>
              </tr>
              </tfoot> --}}
                  
            </table>
              <!-- Pagination Links -->
            {{-- <div class="mt-3">
              {{ $categories->links() }}
           </div> --}}
          </div>
        </div>
      </div>
    </div>

@endsection







