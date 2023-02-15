<x-layout :title="$product->name">
    <section class="navbar py-2 border-bottom border-2" style="background-color: #eee; font-weight: 500">
        <div class="container w-75">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('landingPage', App::getLocale()) }}">{{__('Home')}}</a>
                </li>

                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('shopIndex', App::getLocale()) }}">{{__('Shop')}}</a>
                </li>

                <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('shopShow', ['product' => $product->slug, 'lang' => App::getLocale()]) }}">{{$product->name}}</a>
                </li>
            </ul>
        </div>
    </section>

    <section class="my-5">
        <div class="container w-75 d-flex justify-content-between align-items-start">
            <div class="w-50">
                <div>
                    <div>
                       <img id="currentImage" class="active border border-2 rounded-0 p-5 w-75" src='{{ $product->image && file_exists('storage/' . $product->image) ? asset('storage/' . $product->image) : asset('images/not-found.jpg') }}' alt="">
                    </div>

                    <div class="product-images">
                        <div class="product-thumbnails selected">
                            <img class="w-75" src='{{ $product->image && file_exists('storage/' . $product->image) ? asset('storage/' . $product->image) : asset('images/not-found.jpg') }}' alt="">
                        </div>
                        
                        @if ($product->images)
                            @foreach (json_decode($product->images, true) as $image)
                                <div class="d-flex align-items-center product-thumbnails">
                                    <img class="w-75" src="{{ file_exists('storage/' . $image) ? asset('storage/' . $image) : asset('images/not-found.jpg') }}" alt="">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="card border-0 w-50">
                <div>
                    <h3 class="mb-5">
                        {{$product->name}}
                    </h3>

                    <span class="text-muted" style="font-weight: 500">
                        {{ $product->details }}
                    </span>

                    <div class="h3" style="font-weight: 700">
                        ${{$product->price / 100}}
                    </div>

                    <p class="my-3">
                        {!! $product->description !!}
                    </p>

                    <form action="{{ route('cartStore', App::getLocale()) }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{$product->name}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <button class="btn py-2 px-3 border border-2 rounded-0 border-secondary" type="submit">{{__('Add to Cart')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('partials/might_also_like')

    <script>
        const currentImage = document.querySelector('#currentImage');
        const images = document.querySelectorAll('.product-thumbnails');

        images.forEach((element) => element.addEventListener('click', thumbnailClick));

        function thumbnailClick(e) {
            currentImage.classList.remove('active');

            currentImage.addEventListener('transitionend', () => {
                currentImage.src = this.querySelector('img').src;
                currentImage.classList.add('active');
            })

            thumbnails.forEach((element) => element.classList.remove('selected'));
            this.classList.add('selected');
        }
    </script>
</x-layout>