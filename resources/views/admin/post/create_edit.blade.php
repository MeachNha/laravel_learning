@extends('Layout.main')
@section('content')
    <!-- Page content-->
    <div class="container my-5">
      <div class="row">
        <div class="d-flex justify-content-between mb-2">
          <h3>Create Post</h3>
          <a class="btn btn-success" href="{{Route('post')}}" role="button">Back</a>
        </div>
        <!-- Blog entries-->
        <div class="col-lg-12">
          <div class="card p-3">
            <form method="POST">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
                />
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea
                  class="form-control"
                  id="content"
                  name="content"
                  rows="5"
                ></textarea>
              </div>
              <div class="mb-3">
                <label for="thumbnail" class="form-label"
                  >Choose Thumbnail</label
                >
                <input
                  class="form-control"
                  type="file"
                  id="thumbnail"
                  name="thumbnail"
                />
              </div>
              <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select
                  class="form-select"
                  name="category"
                  aria-label="Default select example"
                >
                  <option selected>Select Category</option>
                  <option value="1">Category 1</option>
                  <option value="2">Category 2</option>
                  <option value="3">Category 3</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="tags" class="form-label">Tag</label>
                <div class="tag-wrapper">
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="tags[]"
                      value="tag1"
                      id="tag1"
                    />
                    <label class="form-check-label" for="tag1">Tag 1</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="tags[]"
                      value="tag2"
                      id="tag2"
                    />
                    <label class="form-check-label" for="tag2">Tag 2</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="tags[]"
                      value="tag3"
                      id="tag3"
                    />
                    <label class="form-check-label" for="tag3">Tag 3</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="tags[]"
                      value="tag4"
                      id="tag4"
                    />
                    <label class="form-check-label" for="tag4">Tag 4</label>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
 
