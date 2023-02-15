<div class="container w-75 d-flex justify-content-between align-items-center">
    <div>
        <p class="lead m-0">{{__('Made with')}} <i style="color: pink" class="bi bi-heart color-warning"></i> {{__('by Erfan')}}</p>
    </div>

    <ul class="navbar-nav ms-auto my-1 d-flex justify-content-between flex-row align-items-center">
        @foreach ($items as $menu_item)
            <li class="nav-item mx-1">
                <a href="{{ $menu_item->link() }}" class="postion-absolute bottom-0 end-0">
                    @if (Str::startsWith($menu_item->title, 'bi bi-'))
                        <i class="{{$menu_item->title}}"></i>
                    @else
                        {{$menu_item->title}}
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</div>

{{-- <div class="container w-75 d-flex justify-content-between align-items-center">
        <p class="lead m-0">Made with <i style="color: pink" class="bi bi-heart color-warning"></i> by Erfan</p>

        <a href="#" class="postion-absolute bottom-0 end-0">
            <i class="bi bi-arrow-up-circle h1"></i>
        </a>
</div> --}}
