@props(['title', 'bg'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Erfan e-commerce | {{ $title ?? "Welcome" }}</title>
</head>
<body>
    <nav class="navbar py-3 navbar-expand-lg navbar-dark" style="background-color: {{$bg ?? "#212529"}}">
        <div class="container w-75">
            <a href="/" class="navbar-brand">Laravel E-commerce</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href='{{ route('shopIndex') }}' class="nav-link">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cartIndex') }}" class="nav-link">
                            Cart
                            @if (Cart::instance('default')->count() > 0)
                                <span class="rounded-5 text-dark" style="background-color: rgb(255, 251, 0); padding: .1rem .4rem">
                                    {{Cart::instance('default')->count()}}
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        {{$slot}}
    </main>

    <footer class="text-light position-relative p-4 text-center" style="background-color: #333">
        <div class="container w-75 d-flex justify-content-between align-items-center">
                <p class="lead m-0">Made with <i style="color: pink" class="bi bi-heart color-warning"></i> by Erfan</p>

                <a href="#" class="postion-absolute bottom-0 end-0">
                    <i class="bi bi-arrow-up-circle h1"></i>
                </a>
        </div>
    </footer>
</body>
</html>