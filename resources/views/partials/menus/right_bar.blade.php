<ul class="navbar-nav ms-auto">
    @guest
        <li class="nav-item mx-1">
            <a href='{{ route('login') }}' class="nav-link">Login</a>
        </li>
        <li class="nav-item mx-1">
            <a href="{{ route('register') }}" class="nav-link">Sign up</a>
        </li>
    @else
        <li>
            <a class="dropdown-item nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    @endguest

    <li class="nav-item mx-1">
        <a href="{{ route('cartIndex') }}" class="nav-link">
            Cart
        </a>
    </li>

    <li class="nav-item mx-1">
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