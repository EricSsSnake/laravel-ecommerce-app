@props(['title', 'bg'])

<!DOCTYPE html>
<html lang="{{ App::isLocale('en') ? 'en' : 'fa' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    @if (App::isLocale('fa'))
        <style>
            body {
                font-family: 'nazanin';
                font-style: normal;
                font-weight: normal;
                font-display: swap;
            }

            p, h1, h2, h3, h4, h5, h6 {
                text-align: end;
            }

            input::placeholder {
                text-align: end;
            }
        </style>
    @endif

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{__('Erfan e-commerce ')}}| {{ $title ?? "Welcome" }}</title>
</head>
<body>
    <nav class="navbar py-3 {{ Route::currentRouteName() == 'landingPage' ? 'px-5' : '' }} navbar-expand-lg navbar-dark" style="background-color: {{$bg ?? "#212529"}}">
        <div class="container w-75">
            <a href="{{ route('landingPage', App::getLocale()) }}" class="navbar-brand {{ Route::currentRouteName() == 'landingPage' ? 'px-4' : '' }}">{{__('Erfan E-commerce')}}</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                {{ menu('navbar', 'partials.menus.main')}}
                @include('partials/menus/right_bar')
            </div>
        </div>
    </nav>

    <main>
        {{$slot}}
    </main>

    <footer class="text-light position-relative p-4 text-center" style="background-color: #333">
        {{menu('footer', 'partials.menus.footer')}}
    </footer>
</body>
</html>