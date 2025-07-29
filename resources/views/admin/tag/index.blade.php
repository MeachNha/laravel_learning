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

        <div class="d-flex justify-content-between align-items-end mb-3">
          <form action="{{ route('tag.index') }}" method="GET" class="d-flex mb-3" style="width: 400px">
                {{-- value="{{ request('search') }}" keeps the value in the input after form submission (so the user sees what they searched). --}}
                <input type="text" name="search" class="form-control me-2" placeholder="Search tag...">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
            
            <div class="col-md-3">
            <form action="{{ route('tag.index') }}" method="get" onchange="this.submit()">
              
                <label for="select" class="form-label">Select</label>
                <select name="select" id="select" class="form-select">
                    <option value="">----select----</option>
                    <option value="1" {{request('select')==1 ? 'selected' : '' }} >1</option>
                    <option value="2" {{request('select')==2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{request('select')==3 ? 'selected' : '' }}>3</option>
                    <option value="4"{{request('select')==4 ? 'selected' : '' }}>4</option>
                    <option value="5"{{request('select')==5 ? 'selected' : '' }}>5</option>
                    <option value="6"{{request('select')==6 ? 'selected' : '' }}>6</option>
                </select>
            
            </form>
            </div>
       </div>


        <!-- Blog entries-->
        <div class="col-lg-12">
          <div class="card p-3">
            <table
             
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
                          <form method="POST" action="{{Route('tag.destroy',$tag->id)}}" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('Delete')

                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                              
                          </form>
                      </td>
                  </tr>
                @endforeach
              </tbody>
              
            </table>
             <!-- Pagination -->
              <div class="mt-3">
                    {{ $tagg->appends(['search' => request('search')])->links() }}
              </div>
          </div>
        </div>
      </div>
    </div>
@endsection
 

