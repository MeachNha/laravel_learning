<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{Route('index')}}">Blog Name</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            {{-- @foreach ($categories as $cat)
              <li class="nav-item">
                <a class="nav-link active" href="">{{ $cat->cat_name }}</a>
              </li>
            @endforeach --}}
           
             @if (Auth::check())
              <li class=" border border-1 border-warning rounded px-3">
                <a class="nav-link active" href="{{ route('logout') }}">Logout</a>
              </li>
              @endif
            
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Manage
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="{{Route('category.index')}}">Category</a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{Route('tag.index')}}">Tag</a>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item" href="{{Route('post.index')}}">Post</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>


    