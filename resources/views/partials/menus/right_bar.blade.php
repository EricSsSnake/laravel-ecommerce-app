<ul class="navbar-nav ms-auto">
    @guest
        <li class="nav-item mx-1">
            <a href='{{ route('login', App::getLocale()) }}' class="nav-link">{{__('Login')}}</a>
        </li>
        <li class="nav-item mx-1">
            <a href="{{ route('register', App::getLocale()) }}" class="nav-link">{{__('Sign Up')}}</a>
        </li>
    @else
        <li>
            <a class="dropdown-item nav-link" href="{{ route('logout', App::getLocale()) }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </li>

        <form id="logout-form" action="{{ route('logout', App::getLocale()) }}" method="POST" class="d-none">
            @csrf
        </form>
    @endguest
    
    @if (App::isLocale('fa'))
        <li class="nav-item mx-1">
            <a href="{{ route(Route::currentRouteName(), ['en', $product ? $product->slug : '']) }}" class="nav-link">
                {{__('EN')}}
            </a>
        </li>
    @else
        <li class="nav-item mx-1">
            <a href="{{ route(Route::currentRouteName(), ['fa', $product ? $product->slug : '']) }}" class="nav-link">
                {{__('FA')}}
            </a>
        </li>
    @endif

    <li class="nav-item mx-1">
        <a href="{{ route('cartIndex', App::getLocale()) }}" class="nav-link">
            {{__('Cart')}}
            @if (Cart::instance('default')->count() > 0)
            <span class="rounded-5 text-dark" style="background-color: rgb(255, 251, 0); padding: .1rem .4rem">
                {{Cart::instance('default')->count()}}
            </span>
            @endif
        </a>
    </li>
</ul>