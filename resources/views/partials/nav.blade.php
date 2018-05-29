<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tag"></i> Categories</a>
                <div class="dropdown-menu" aria-labelledby="dropdown07">
                    @foreach(\App\Category::all() as $category)
                    <a class="dropdown-item" href="/category/{{ $category->slug }}">{{ $category->title }}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/shopping-cart"><i class="fas fa-shopping-cart"></i> Shopping Cart <span class="badge">{{ Session::get('cart')->totalQty ?? 0 }}</span><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> User Management</a>
                <div class="dropdown-menu" aria-labelledby="dropdown07">
                @if(Auth::check())
                    <a class="dropdown-item" href="/user/profile">Profile</a>
                    @if(in_array('admin', \App\User::find(Auth::id())->roles->pluck('name')->toArray()))
                        <a class="dropdown-item" href="/admin/dashbord">Admin Panel</a>
                    @endif
                    <a class="dropdown-item" href="/logout">Logout</a>
                @else
                    <a class="dropdown-item" href="/register">Signup</a>
                    <a class="dropdown-item" href="/signin">Signin</a>
                @endif
                </div>
            </li>
        </ul>
    </div>
    </div>
</nav>