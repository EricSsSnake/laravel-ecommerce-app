<x-layout :title="'Shop'">
    <style>
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }

        .pagination>li {
            display: inline;
        }

        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
            background-color: #f4f4f4;
            border-color: #DDDDDD;
            color: inherit;
            cursor: default;
            z-index: 2;
        }

        .pagination>li:first-child>a, .pagination>li:first-child>span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .pagination > li > a, .pagination > li > span {
            background-color: #FFFFFF;
            border: 1px solid #DDDDDD;
            color: inherit;
            float: left;
            line-height: 1.42857;
            margin-left: -1px;
            padding: 16px 22px;
            position: relative;
            text-decoration: none;
        }

        .pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
            z-index: 2;
            color: #23527c;
            background-color: #eee;
            border-color: #ddd;
        }

    </style>
    <section class="navbar py-2 border-bottom border-2" style="background-color: #eee; font-weight: 500">
        <div class="container w-75">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('landingPage', App::getLocale()) }}">{{__('Home')}}</a>
                </li>

                <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('shopIndex', App::getLocale()) }}">{{__('Shop')}}</a>
                </li>
            </ul>
        </div>
    </section>
    

    <section class="my-5">
        <div class="container w-75 d-flex justify-content-between">
            <div class="w-25">
                <div class="mb-4">
                    <div class="h6" style="font-weight: 700">{{__('By Category')}}</div>
                    <ul class="list-unstyled">
                        <li style="font-weight: {{request()->category == '' ? '500' : '400'}}">
                            <a class="text-dark text-decoration-none" href="{{ route('shopIndex', App::getLocale()) }}">{{__('All')}}</a>
                        </li>

                        @foreach ($categories as $category)
                            <li style="font-weight: {{request()->category == $category->slug ? '500' : '400'}}">
                                <a class="text-dark text-decoration-none" href="{{ route('shopIndex', ['category' => $category->slug, 'lang' => App::getLocale()]) }}">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="w-75">
                <div class="container">
                    <div class="d-flex justify justify-content-between">
                        <h3>{{$categoryName}}</h3>

                        <div>
                            <strong style="font-size: 1.2rem">{{__('Price')}}:</strong>
                            <a style="font-size: 1.2rem" href="{{ route('shopIndex', ['category' => request()->category, 'sort' => 'high_low', 'lang' => App::getLocale()]) }}"><i class="bi bi-sort-down"></i></a>

                            <a style="font-size: 1.2rem" href="{{ route('shopIndex', ['category' => request()->category, 'sort' => 'low_high', 'lang' => App::getLocale()]) }}"><i class="bi bi-sort-up"></i></a>
                        </div>
                    </div>

                    <div class="mt-5 my-3 d-flex flex-wrap">
                        @forelse ($products as $product)
                            <div class="card border-0" style="width: 33%">
                                <div class="card-body text-center">
                                    <a class="text-dark text-decoration-none" href="{{ route('shopShow', ["product" => $product->slug, 'lang' => App::getLocale()]) }}">
                                        <img class="w-75" src='{{ $product->image && file_exists('storage/' . $product->image) ? asset('storage/' . $product->image) : asset('images/not-found.jpg') }}' alt="">
                                    </a>

                                    <a class="text-dark text-decoration-none" href="{{ route('shopShow', ["product" => $product->slug, 'lang' => App::getLocale()]) }}">
                                        <p class="font-bold my-2">{{$product->name}}</p>
                                    </a>

                                    <span class="text-muted">{{'$'. $product->price / 100}}</span>
                                </div>
                            </div>

                        @empty
                            <div>{{__('No products were found.')}}</div>
                        @endforelse
                    </div>
                </div>
                <div>
                    {{$products -> appends(request()->input())->links("pagination::bootstrap-5")}}
                </div>
            </div>           
        </div>
    </section>

</x-layout>