<x-layout :title="$product->name">
    <section class="navbar py-2 border-bottom border-2" style="background-color: #eee; font-weight: 500">
        <div class="container w-75">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('landingPage') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('shopIndex') }}">Shop</a>
                </li>

                <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('shopShow', ['product' => $product->slug]) }}">{{$product->name}}</a>
                </li>
            </ul>
        </div>
    </section>

    <section class="my-5">
        <div class="container w-75 d-flex justify-content-between align-items-center">
            <div class="w-50">
                <img class="border border-2 rounded-0 p-5 w-75" src='{{ asset('images/products/' . $product->slug . '.jpg') }}' alt="">
            </div>

            <div class="card border-0 w-50">
                <div class="">
                    <h3 class="mb-5">
                        {{$product->name}}
                    </h3>

                    <span class="text-muted" style="font-weight: 500">
                        {{$product->details}}
                    </span>

                    <div class="h3" style="font-weight: 700">
                        ${{$product->price / 100}}
                    </div>

                    <p class="my-3">
                        {{$product->description}}
                    </p>

                    <form action="{{ route('cartStore') }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{$product->name}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <button class="btn py-2 px-3 border border-2 rounded-0 border-secondary" type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('partials/might_also_like')
</x-layout>