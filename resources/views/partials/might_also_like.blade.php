<section class="py-5" style="background-color: #f1f1f1">
    <div class="container w-75 d-flex flex-column">
        <div class="h5 mb-4 {{ App::isLocale('fa') ? 'align-self-end' : '' }}" style="font-weight: 700;">{{__('You might also like...')}}</div>

        <div class="d-flex">
            @foreach ($mightAlsoLike as $item)
                <div class="card border-2 w-25 mx-2">
                    <div class="card-body text-center">
                        <a class="text-dark text-decoration-none" href=" {{ route('shopShow', ['product' => $item->slug, 'lang' => App::getLocale()]) }}">
                            <img class="w-75" src='{{ $item->image && file_exists('storage/' . $item->image) ? asset('storage/' . $item->image) : asset('images/not-found.jpg') }}' alt="">
                        </a>
                        
                        <a class="text-dark text-decoration-none" href="{{ route('shopShow', ['product' => $item->slug, 'lang' => App::getLocale()]) }}">
                            <p class="font-bold my-2" style="text-align: center">{{$item->name}}</p>
                        </a>

                        <span class="text-muted">{{'$'. $item->price / 100}}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>