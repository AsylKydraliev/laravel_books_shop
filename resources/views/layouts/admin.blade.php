<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="{{ mix('js/app.js') }}"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="antialiased">
<nav class="navbar navbar-expand-lg bg-body-secondary py-3 mb-5">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.books.index') }}">Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item {{ Request::is('admin/books') ? 'fw-bold' : '' }}">
                    <a class="nav-link" href="{{ route('admin.books.index') }}">Books</a>
                </li>
                <li class="nav-item {{ Request::is('admin/authors') ? 'fw-bold' : '' }}">
                    <a class="nav-link" href="{{ route('admin.authors.index') }}">Authors</a>
                </li>
                <li class="nav-item {{ Request::is('admin/categories') ? 'fw-bold' : '' }}">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

@yield('content')

</body>
</html>
