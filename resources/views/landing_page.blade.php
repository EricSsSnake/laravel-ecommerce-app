<x-layout :bg="'#4e4e4e'">
    <section class="text-light p-5 text-center text-sm-start" style="background-color: #4e4e4e">
        <div class="container w-75 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-start flex-column">
                <h1 class="my-3 text-uppercase">{{__('Erfan E-commerce')}} <span class="text-warning"> {{__('Demo')}} </span></h1>

                <p class="lead">
                    {{__('Includes multiple products, categories, a shopping cart and a checkout system with stripe integration.')}}
                </p>

                <div class="my-5">
                    <a href="" class="btn btn-link text-light text-decoration-none border-light">{{__('Blog Post')}}</a>
                    <a href="" class="mx-2 btn btn-link text-light text-decoration-none border-light">{{__('Github')}}</a>
                </div>
            </div>

            <img class="img-fluid w-50 d-none d-sm-block" src="images/macbook-pro-laravel.png" alt="">
        </div>
    </section>

    <section>
        <div class="container my-5 text-center w-75">
            <h2>{{__('Erfan E-commerce')}}</h2>
            <p class="mt-3 text-sm-start">{{__('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit, cumque. Iusto voluptas voluptatibus sit repellendus cum! Vero est, nobis reprehenderit temporibus laboriosam error architecto quo.')}}</p>
            <div class="mt-5">
                <a href="" class="btn btn-link border-dark text-decoration-none text-dark">{{__('Featured')}}</a>
                <a href="" class="mx-2 btn btn-link border-dark text-decoration-none text-dark">{{__('On Sale')}}</a>
            </div>
        </div>

        <div class="container my-5 w-75 d-flex flex-column align-items-center">
            <div class="mt-5 my-3 d-flex flex-wrap">
                    @foreach ($products as $product)
                        <div class="col-md w-25">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <a class="text-dark text-decoration-none" href=" {{ route('shopShow', ['product' => $product->slug, 'lang' => App::getLocale()]) }}">
                                        <img src='{{ $product->image && file_exists('storage/' . $product->image) ? asset('storage/' . $product->image) : asset('images/not-found.jpg') }}' alt="">
                                    </a>
                                    
                                    <a class="text-dark text-decoration-none" href="{{ route('shopShow', ['product' => $product->slug , 'lang' => App::getLocale()]) }}">
                                        <p class="font-bold my-2">{{$product->name}}</p>
                                    </a>

                                    <span class="text-muted">{{'$'. $product->price / 100}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            
            <div class="my-3">
                <a href="{{ route('shopIndex', App::getLocale()) }}" class="btn btn-link text-decoration-none border-dark text-dark">
                    {{__('View more products')}}
                </a>
            </div>
        </div>
    </section>
</x-layout>