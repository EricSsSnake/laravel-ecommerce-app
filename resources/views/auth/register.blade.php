<x-layout>
    <div class="container w-75">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-md-7" style="padding-right: 5rem">
                <div class="card">
                    <div class="card-header">{{ __('Create Account') }}</div>

                    <div class="card-body p-5 py-3">
                        <form class="d-flex flex-column" method="POST" action="{{ route('register', App::getLocale()) }}">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md">
                                    <div class="d-flex">
                                        <i class="bi bi-person-fill py-1 px-2 border" style="background-color: #eee; border-radius: 6px; border-top-right-radius: 0; border-bottom-right-radius: 0"></i>

                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}" style="border-top-left-radius: 0; border-bottom-left-radius: 0">
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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

                            <div class="row mb-4">
                                <div class="col-md">
                                    <div class="d-flex">
                                        <i class="bi bi-lock-fill py-1 px-2 border" style="background-color: #eee; border-radius: 6px;border-top-right-radius: 0; border-bottom-right-radius: 0"></i>

                                        <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" style="border-top-left-radius: 0; border-bottom-left-radius: 0">
                                    </div>

                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="row mt-3 mb-3">
                                    <div class="col-md offset-md d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-primary py-2 px-3">
                                            {{ __('Create Account') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md offset-md">
                                        <p class="mb-1" style="font-weight: 500; font-size: .9rem">{{__('Already have an account?')}}</p>

                                        <a class="text-dark" href="{{ route('login', App::getLocale()) }}" style="font-size: .9rem">
                                            {{__('Login')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5" style="padding-left: 5rem; border-left: 2px solid #eee;">
                <h2 class="mb-5" style="font-size: 1.7rem; font-weight: 700">{{__('Benefits')}}</h2>

                <div class="mb-5">
                    <p class="h3 mb-3" style="font-size: 1rem; font-weight: 700">{{__('Save time now')}}</p>

                    <div>
                        <p class="mb-2">{{__('Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem consectetur facere veritatis, illo, pariatur perferendis quam explicabo animi itaque odit, porro amet eveniet cupiditate atque perspiciatis inventore omnis deleniti accusantium.')}}</p>
                    </div>
                </div>

                <div>
                    <p class="h3 mb-3" style="font-size: 1rem; font-weight: 700">{{__('Loyalty Program')}}</p>

                    <div>
                        <p class="mb-2">{{__('Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eligendi quia expedita perferendis iste harum aut. Deleniti optio quis maxime voluptatum cum odit vitae, neque voluptatem eius labore accusamus eveniet doloribus, saepe earum beatae ullam delectus!')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>