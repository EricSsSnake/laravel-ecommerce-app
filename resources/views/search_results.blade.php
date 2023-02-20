<x-layout :title="'Search results'">
    <section class="navbar py-2 border-bottom border-2" style="background-color: #eee; font-weight: 500">
        <div class="container w-75">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('landingPage', App::getLocale()) }}">{{__('Home')}}</a>
                </li>

                <li class="breadcrumb-item">
                    <a class="text-decoration-none" href="{{ route('shopIndex', App::getLocale()) }}">{{__('Search')}}</a>
                </li>
            </ul>

            <div>
                @include('partials/search')
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container w-75">
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
        </div>

        <div class="container w-75">

            <h1>{{__('Search results')}}</h1>

            <p>
                {{ $products->total() }} {{__('results for')}} {{ request()->input('query') }}
            </p>

            <table class="table table-striped">
                <thead>
                    <tr class="border-top">
                    <th scope="col"><p>{{__('Name')}}</p></th>
                    <th scope="col"><p>{{__('Details')}}</p></th>
                    <th scope="col"><p>{{__('Description')}}</p></th>
                    <th scope="col"><p>{{__('Price')}}</p></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <th scope="row">
                            <a class="text-dark text-decoration-none" style="font-weight: 400;" href="{{ route('shopShow', ['lang' => App::getLocale(), 'product' => $product->slug]) }}">{{$product->name}}</a>
                        </th>

                        <td>{{$product->details}}</td>

                        <td>{{ Str::limit($product->description, 80) }}</td>

                        <td>${{$product->price / 100}}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>

                <div>
                    {{$products -> appends(request()->input())->links("pagination::bootstrap-5")}}
                </div>
        </div>
    </section>

</x-layout>