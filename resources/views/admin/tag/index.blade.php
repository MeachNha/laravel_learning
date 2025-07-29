@extends('Layoutadmin.main')

@section('contentAdmin')
    <!-- Page content-->
    <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2">
          <h3>Tag List</h3>
          <a class="btn btn-success" href="{{Route('tag.create')}}" role="button"
            >Create</a>
        </div>
        <!-- Blog entries-->
        <div class="col-lg-12">
          <div class="card p-3">
            <table
              id="datatable"
              class="table table-striped"
              style="width: 100%"
            >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tag Name</th>
                  <th>Tag Status</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>

                @foreach ($tagg as $tag)
                   <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $tag->tag_name }}</td>
                       <td>
                        @if($tag->tag_status == 1)
                           <span class="badge bg-success">Active</span>
                        @else
                           <span class="badge bg-danger">Inactive</span>
                        @endif
                      </td>
                      <td>
                          <a class="btn btn-primary btn-sm" href="{{Route('tag.edit',$tag->id)}}">Edit</a>
                      </td>

                      <td>
                          
                          <form method="POST" action="{{Route('tag.destroy',$tag->id)}}">
                            @csrf
                            @method('Delete')
                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                          </form>
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
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
 

