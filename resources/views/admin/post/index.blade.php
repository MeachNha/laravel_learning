@extends('Layoutadmin.main')

@section('contentAdmin')
    <!-- Page content-->
    
    <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2">
          <h3>Category List</h3>
          <a class="btn btn-success" href="{{Route('post.create')}}" role="button">Create</a>
        </div>
        
    
   <div class="d-flex justify-content-between align-items-end mb-3">
     <form action="{{ route('post.index') }}" method="GET" class="d-flex mb-3" style="width: 400px">
          {{-- value="{{ request('search') }}" keeps the value in the input after form submission (so the user sees what they searched). --}}
          <input type="text" name="search" class="form-control me-2" placeholder="Search category..." value="{{ request('search') }}">
          <button class="btn btn-primary" type="submit">Search</button>
      </form>
      
      <div class="col-md-3">
      <form action="{{ route('post.index') }}" method="get" onchange="this.submit()">
        
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
                  <th>Title</th>
                  <th>Des</th>
                  <th>Img</th>
                  <th>Status</th>
                  <th>Tag</th>
                  <th>categoryname</th>
                  <th style="width: 100px">Action</th>
                </tr>
              </thead>
              <tbody>
               @foreach ($posts as $post)
                  <tr>
                      <td>{{ $post->id }}</td>
                      <td>{{ $post->title }}</td>
                      <td>{{ $post->description }}</td>
                      <td><img src="{{asset('storage/'.$post->img)}}" alt="" width="100" height="100"></td>
                       <td>{{ $post->status }}</td>
                       <td><ul>
                        @foreach ($post->tags as $tag)
                          <li>{{ $tag->tag_name }}</li>
                          @endforeach
                       </ul>
                      </td>
                      <td>{{$post->category->cat_name}}</td>
                      <td>
                        @if($post->status == 1)
                           <span class="badge bg-success">Active</span>
                        @else
                           <span class="badge bg-danger">Inactive</span>
                        @endif
                      </td>
                      <td>
                          <a class="btn btn-primary btn-sm" href="{{ route('post.edit',$post->id) }}">Edit</a>
                      </td>
                      <td>
                          <form method="POST" action="{{Route('post.destroy',$post->id)}}" onsubmit="return confirm('Are you sure?')">
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
                    {{ $posts->appends(['search' => request('search')])->links() }}
              </div>
          </div>
        </div>
      </div>
    </div>

@endsection





