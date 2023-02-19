<x-layout>
    <div class="container w-75">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-md-7" style="padding-right: 5rem">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body p-5 py-3">
                        <form class="d-flex flex-column" method="POST" action="{{ route('login', App::getLocale()) }}">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md">
                                    <div class="d-flex">
                                        <i class="bi bi-envelope-fill py-1 px-2 border" style="background-color: #eee; border-radius: 6px; border-top-right-radius: 0; border-bottom-right-radius: 0"></i>

                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email Address') }}" style="border-top-left-radius: 0; border-bottom-left-radius: 0">
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md">
                                    <div class="d-flex">
                                        <i class="bi bi-lock-fill py-1 px-2 border" style="background-color: #eee; border-radius: 6px;border-top-right-radius: 0; border-bottom-right-radius: 0"></i>

                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}" style="border-top-left-radius: 0; border-bottom-left-radius: 0">
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mt-3 mb-3">
                                <div class="col-md offset-md d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-primary py-2 px-5">
                                        {{ __('Login') }}
                                    </button>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember" style="font-size: .9rem; font-weight: 500">
                                            {{ __('Remember me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md offset-md">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-dark p-0" href="{{ route('password.request', App::getLocale()) }}" style="font-size: .9rem; font-weight: 500; text-decoration: none">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5" style="padding-left: 5rem; border-left: 2px solid #eee;">
                <h2 class="mb-5" style="font-size: 1.7rem; font-weight: 700">{{__(('New Customer'))}}</h2>

                <div class="mb-5">
                    <p class="h3 mb-3" style="font-size: 1rem; font-weight: 700">{{__('Save time now')}}</p>

                    <div class="d-flex flex-column">
                        <p class="mb-3">{{__("You don't need an account to checkout.")}}</p>

                        <a href="{{ route('guestCheckoutIndex', App::getLocale()) }}" class="btn btn-link text-dark text-decoration-none border-secondary border-2 p-2 px-3" style="font-weight: 500; font-size: .9rem; width: {{ App::isLocale('fa') ? '50%' : '65%' }}; align-self: {{ App::isLocale('fa') ? 'end' : '' }}">
                            {{__('Checkout as a Guest')}}    
                        </a>
                    </div>
                </div>

                <div>
                    <p class="h3 mb-3" style="font-size: 1rem; font-weight: 700">{{__('Save time later')}}</p>

                    <div class="d-flex flex-column">
                        <p class="mb-3">{{__('Create an account for fast checkout and easy access to order history.')}}</p>

                        <a href="{{ route('register', App::getLocale()) }}" class="btn btn-link text-dark text-decoration-none border-secondary border-2 p-2 px-3" style="font-weight: 500; font-size: .9rem; width: 50%; align-self: {{ App::isLocale('fa') ? 'end' : '' }}">
                            {{__('Create Account')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>