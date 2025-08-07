@extends('Layout.main')
@section('title','First page ')

@section('content')
  
<style>
  .imgbox{
    width: 100%;
    height:230px;

  }
  .myimg{
    width: 100%;
    height:100%;
    object-fit: cover;  
  }
</style>

 <!-- Page content-->
    <div class="container mt-5">
      <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
          <!-- Nested row for non-featured blog posts-->
          <div class="row">

            <div class="col-lg-12">
              <!-- Featured blog post-->
              <div class="card mb-4 mt-6">
                <a href="{{ route('blog',$lastdata->id) }}">
                  <img
                    class="card-img-top"
                    src="{{ asset('storage/' . $lastdata->img) }}"
                    alt="..."
                  />
                </a>
                <div class="card-body">
                  <div class="small text-muted">{{ $lastdata->published_at }}</div>
                  <br>
                    <h6>Post by : {{$lastdata->user->name}}</h6>
                  <h2 class="card-title">{{ $lastdata->title }}</h2>
                  <p class="card-text">
                    {{ Str::limit($lastdata->description, 150) }}
                  </p>
                  <a class="btn btn-primary" href="{{ route('blog',$lastdata->id) }}">Read more →</a>
                </div>
              </div>
            </div>

            

           
            @foreach ($mydata as $data)
                <div class="col-lg-6">
                  <!-- Blog post-->
                  <div class="card mb-4">
                      <a href="{{Route('blog',$data->id)}}" class="imgbox">
                        <img
                        class="card-img-top myimg"
                        src="{{ asset('storage/' . $data->img) }}"
                        alt="..."   />
                      </a>
                    <div class="card-body">
                      <div class="small text-muted">{{ $data->published_at }}</div>
                         <br>
                        <h6>Post by : {{$data->user->name}}</h6>
                      <h2 class="card-title h4">{{ $data->title }}</h2>
                      <p class="card-text">
                        {{Str::limit($data->description, 100)}}
                      </p>
                      <a class="btn btn-primary" href="{{Route('blog',$data->id)}}">Read more →</a>
                    </div>
                  </div>
                </div>
            @endforeach
    
    
      </div>
             <!-- Pagination -->
              <div class="mt-3">
                    {{ $mydata->appends(['search' => request('search')])->links() }}
              </div>
        </div>


        <!-- Side widgets-->
        <div class="col-lg-4">
          <!-- Search widget-->
          <div class="card mb-4">
            <div class="card-header">Search</div>
            <form action="{{Route('index')}}" method="GET">
              <div class="card-body">
              <div class="input-group">
                <input
                  class="form-control"
                  type="text"
                  placeholder="Enter search term..."
                  aria-label="Enter search term..."
                  aria-describedby="button-search"
                  value="{{ request('search') }}"
                  name="search"
                />
                <button
                  class="btn btn-primary"
                  id="button-search"
                  type="submit"
                >
                  Go!
                </button>
              </div>
            </div>
            </form>
          </div>
          <!-- Tags widget-->
          <div class="card mb-4">
            <div class="card-header">Tags</div>
            <div class="card-body">
              <div class="row">
                  @foreach ($tags as $tag)
                <div class="col-sm-6">
                  <ul class="list-unstyled mb-0">
                       <li>
                        <a style="text-decoration: none; color:black; font-size:18px;" href="{{Route('index',['tagId'=>$tag->id])}}">{{$tag->tag_name}}</a>
                      </li>
                  </ul>
                </div>
                 @endforeach
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection