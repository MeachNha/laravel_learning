@extends('Layout.main')
@section('title','Blog Page ')

@section('content')
<style>
  .mybigimg{
    width: 900px;
    height:500px;
  }
</style>
<div class="container mt-5">

      <div class="row">
        <div class="col-lg-8">
          <!-- Post content-->
          <article>
            <!-- Post header-->
            <header class="mb-4">
              <!-- Post title-->
              <h1 class="fw-bolder mb-1"> {{$post->title}}</h1>
              <!-- Post meta content-->
              <div class="text-muted fst-italic mb-2">
                Posted on January 1, 2022 by Start Bootstrap
              </div>
              <!-- Post categories-->
              <a
                class="badge bg-secondary text-decoration-none link-light"
                href="#!"
                >Web Design</a
              >
              <a
                class="badge bg-secondary text-decoration-none link-light"
                href="#!"
                >Freebies</a
              >
            </header>
            <!-- Preview image figure-->
            <figure class="mb-4">
              <img
                class="img-fluid rounded mybigimg"
                src="{{ asset('storage/' . $post->img) }}"
                alt="..."
              />
            </figure>
            <!-- Post content-->
            <section class="mb-5">
              <p class="fs-5 mb-4">
                 {{$post->description}}
              </p>
             
              
            </section>
          </article>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
          <!-- Search widget-->
          <div class="card mb-4">
            <div class="card-header">Search</div>
            <div class="card-body">
              <div class="input-group">
                <input
                  class="form-control"
                  type="text"
                  placeholder="Enter search term..."
                  aria-label="Enter search term..."
                  aria-describedby="button-search"
                />
                <button
                  class="btn btn-primary"
                  id="button-search"
                  type="button"
                >
                  Go!
                </button>
              </div>
            </div>
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
                        <a style="text-decoration: none; color:black; font-size:18px;" href="#!">{{$tag->tag_name}}</a>
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