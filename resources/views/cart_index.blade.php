<x-layout :title="'Shopping Cart'">
    <section class="navbar py-2 border-bottom border-2" style="background-color: #eee; font-weight: 500">
        <div class="container w-75">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('landingPage', App::getLocale()) }}">{{__('Home')}}</a>
                </li>

                <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('cartIndex', App::getLocale()) }}">{{__('Shopping Cart')}}</a>
                </li>
            </ul>

            <div>
                @include('partials/search')
            </div>
        </div>
    </section>

    <section>
        <div class="container w-75 my-5">
            @if (session()->has('success_message'))
                <div class="p-3 mb-3 w-75" style="background-color: #dbedd2; color: #52634e">
                    {{session()->get('success_message')}}
                </div>
            @endif

            @if (count($errors) > 0)
            <div class="p-3 mb-3"> 
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li class="p-3 mb-3 w-75" style="background-color: #f0d9d8; color: #af8b88">>{{$error}}</li>                      
                    @endforeach
                </ul>
            </div>
            @endif

            @if (Cart::count() > 0)
                <h5 class="mb-4" style="font-weight: 700">
                    {{Cart::count()}} {{__('Item(s) in your Shopping Cart')}}
                </h5>

                @foreach (Cart::content() as $item)     
                    <div class="d-flex w-75 align-items-center justify-content-between border-top border-bottom border-1 p-3">
                        <div class="d-flex justify-content-start align-items-center">
                            <div>
                                <a href="{{ route('shopShow', ['lang' => App::getLocale() ,$item->model->slug]) }}">
                                    <img class="w-50" src="{{ $item->model->image && file_exists('storage/' . $item->model->image) ? asset('storage/' . $item->model->image) : asset('images/not-found.jpg') }}" alt="">
                                </a>
                            </div>

                            <div>
                                <a class="text-decoration-none text-dark" href="{{ route('shopShow', ['lang' => App::getLocale(), $item->model->slug]) }}" style="font-weight: 700">{{$item->model->name}}
                                </a>
                                <p class="text-muted">{{$item->model->details}}</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">

                                <form action="{{ route('cartDestroy', ['lang' => App::getLocale(), 'product' => $item->rowId]) }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-link text-decoration-none" style="color: #555; font-size: .9rem; font-weight: 500" type="submit">{{__('Remove')}}</button>
                                </form>

                                <form action="{{ route('cartSwitchToSaveForLater', ['lang' => App::getLocale(), 'product' => $item->rowId]) }}" method="POST">
                                    @csrf

                                    <button class="btn btn-link text-decoration-none" style="color: #555; font-size: .9rem; font-weight: 500" type="submit">{{__('Save for Later')}}</button>
                                </form>
                            </div>

                            <div class="mx-2">
                                <select class="form-select quantity" data-id="{{$item->rowId}}">
                                    @for ($i = 1; $i < 6; $i++)
                                        <option {{$item->qty == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <span style="font-weight: 600">
                                    ${{$item->subtotal/100}}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p style="text-align: start">{{__('Your shopping cart is empty!')}}</p>
                <a class="btn-primary btn p-3 rounded-0" href="{{ route('shopIndex', App::getLocale()) }}">
                    {{__('Continue Shopping')}}
                </a>
            @endif
        </div>
    </section>

    <section>
        <div class="container w-75">
            <div class="p-3 w-75 d-flex justify-content-between align-items-center my-5" style="background-color: #f3f3f3">
                <div>{{__('Total Amount:')}}</div>

                <div style="font-weight: 700; font-size: 1.5rem">
                    ${{Cart::total() / 100}}
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container w-75">
            <div class="d-flex w-75 justify-content-between align-items-center">
                <div>
                    <a class="btn btn-link text-decoration-none p-3 rounded-0 border border-2 border-secondary text-dark" href="{{ route('shopIndex', App::getLocale()) }}">{{__('Continue Shopping')}}</a>
                </div>

                <div>
                    <a class="btn btn-primary text-light p-3 rounded-0" href="{{ route('checkoutIndex', App::getLocale()) }}">{{__('Proceed to Checkout')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container w-75 my-5">
            @if (Cart::instance('saveForLater')->count() > 0)

            <h5 class="mb-4" style="font-weight: 700">
                {{Cart::instance('saveForLater')->count()}} {{__('Item(s) Saved for Later')}}
            </h5>

            @foreach (Cart::instance('saveForLater')->content() as $item)     
                <div class="d-flex w-75 align-items-center justify-content-between border-top border-bottom border-1 p-3">
                    <div class="d-flex justify-content-start align-items-center">
                        <div>
                            <a href="{{ route('shopShow', ['lang' => App::getLocale(), $item->model->slug]) }}">
                                <img class="w-50" src="{{ $item->model->image && file_exists('storage/' . $item->model->image) ? asset('storage/' . $item->model->image) : asset('images/not-found.jpg') }}" alt="">
                            </a>
                        </div>

                        <div>
                            <a class="text-decoration-none text-dark" href="{{ route('shopShow', ['lang' => App::getLocale(), $item->model->slug]) }}" style="font-weight: 700">{{$item->model->name}}
                            </a>
                            <p class="text-muted">{{$item->model->details}}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">

                            <form action="{{ route('saveForLaterDestroy', ['lang' => App::getLocale(), $item->rowId]) }}" method="POST">
                                @csrf
                                @method('delete')

                                <button class="btn btn-link text-decoration-none" style="color: #555; font-size: .9rem; font-weight: 500" type="submit">{{__('Remove')}}</button>
                            </form>

                            <form action="{{ route('saveForLaterSwitchToCart', ['lang' => App::getLocale(), $item->rowId]) }}" method="POST">
                                @csrf

                                <button class="btn btn-link text-decoration-none" style="color: #555; font-size: .9rem; font-weight: 500" type="submit">{{__('Add to Cart')}}</button>
                            </form>
                        </div>

                        <div>
                            <span style="font-weight: 600">
                                ${{$item->model->price/100}}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach

            @else
                <p style="text-align: start">{{__('Nothing is Saved for Later!')}}</p>
            @endif
        </div>
    </section>

    @include('partials/might_also_like')
</x-layout>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    const options = document.querySelectorAll('.quantity')

    Array.from(options).forEach(function (element) {
        element.addEventListener('change', function() {
            const id = element.getAttribute('data-id')

            const url = "{{url()->full()}}";
            
            axios.patch(url + '/' + `${id}`, {
                quantity: this.value
            })
            .then(function (response) {
                window.location.href = '{{ route('cartIndex', App::getLocale()) }}'
            })
            .catch(function (error) {
                window.location.href = '{{ route('cartIndex', App::getLocale()) }}'
            });
            })
    });
</script>