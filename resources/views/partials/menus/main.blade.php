<ul class="navbar-nav ms-auto my-1">
    @foreach ($items as $menu_item)
        <li class="nav-item mx-1">
            <a href='{{ route($menu_item->route ? $menu_item->route : 'landingPage', App::getLocale()) }}' class="nav-link">
                {{$menu_item->title}}

                @if ($menu_item->title == 'Cart')
                    @if (Cart::instance('default')->count() > 0)
                        <span class="rounded-5 text-dark" style="background-color: rgb(255, 251, 0); padding: .1rem .4rem">
                            {{Cart::instance('default')->count()}}
                        </span>
                    @endif
            @endif
            </a>
        </li>
    @endforeach
</ul>

{{-- <ul class="navbar-nav ms-auto">
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
</ul> --}}