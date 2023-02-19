<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Variables */
        form {
        width: 30vw;
        min-width: 500px;
        align-self: center;
        box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
            0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
        border-radius: 7px;
        padding: 40px;
        }

        .hidden {
        display: none;
        }

        #payment-message {
        color: rgb(105, 115, 134);
        font-size: 16px;
        line-height: 20px;
        padding-top: 12px;
        text-align: center;
        }

        #payment-element {
        margin-bottom: 24px;
        }

        /* Buttons and links */
        button {
        background: #5469d4;
        font-family: Arial, sans-serif;
        color: #ffffff;
        border-radius: 4px;
        border: 0;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
        }
        button:hover {
        filter: contrast(115%);
        }
        button:disabled {
        opacity: 0.5;
        cursor: default;
        }

        /* spinner/processing state, errors */
        .spinner,
        .spinner:before,
        .spinner:after {
        border-radius: 50%;
        }
        .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        }
        .spinner:before,
        .spinner:after {
        position: absolute;
        content: "";
        }
        .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #5469d4;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
        }
        .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #5469d4;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
        }
        @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
        }

        @media only screen and (max-width: 600px) {
        form {
            width: 80vw;
            min-width: initial;
        }
        }
    </style>
    <script>
        (function() {
                // This is a public sample test API key.
            // Don’t submit any personally identifiable information in requests made with this key.
            // Sign in to see your own test API key embedded in code samples.
            const stripe = Stripe("sk_test_4eC39HqLyjWDarjtT1zdp7dc");

            // The items the customer wants to buy
            const items = [{ id: "xl-tshirt" }];

            let elements;

            initialize();
            checkStatus();

            document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

            let emailAddress = '';
            // Fetches a payment intent and captures the client secret
            async function initialize() {
            const { clientSecret } = await fetch("/create.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ items }),
            }).then((r) => r.json());

            elements = stripe.elements({ clientSecret });

            const linkAuthenticationElement = elements.create("linkAuthentication");
            linkAuthenticationElement.mount("#link-authentication-element");

            const paymentElementOptions = {
                layout: "tabs",
            };

            const paymentElement = elements.create("payment", paymentElementOptions);
            paymentElement.mount("#payment-element");
            }

            async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                // Make sure to change this to your payment completion page
                return_url: "http://localhost:4242/checkout.html",
                receipt_email: emailAddress,
                },
            });

            // This point will only be reached if there is an immediate error when
            // confirming the payment. Otherwise, your customer will be redirected to
            // your `return_url`. For some payment methods like iDEAL, your customer will
            // be redirected to an intermediate site first to authorize the payment, then
            // redirected to the `return_url`.
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
            }

            // Fetches the payment intent status after payment submission
            async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
            );

            if (!clientSecret) {
                return;
            }

            const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

            switch (paymentIntent.status) {
                case "succeeded":
                showMessage("Payment succeeded!");
                break;
                case "processing":
                showMessage("Your payment is processing.");
                break;
                case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
                break;
                default:
                showMessage("Something went wrong.");
                break;
            }
            }

            // ------- UI helpers -------

            function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function () {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 4000);
            }

            // Show a spinner on payment submission
            function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
            }
        })();
    </script>
    <title>Erfan E-commerce | Checkout</title>
</head>
<body>
    <nav class="navbar py-3 navbar-dark" style="background-color: #333">
        <div class="container w-75">
            <a href="{{ route('landingPage', App::getLocale()) }}" class="navbar-brand" style="font-weight: 500">Erfan E-commerce</a>
        </div>
    </nav>

    <section>
        <div class="container my-5 w-75">
            <div class="my-1">
                @if (session()->has('success_message'))
                    <div class="p-3 mb-3 w-75" style="background-color: #dbedd2; color: #52634e">
                        {{session()->get('success_message')}}
                    </div>
                @endif
    
                @if (count($errors) > 0)
                <div class="p-3 mb-3"> 
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li class="p-3 mb-3 w-75" style="background-color: #f0d9d8; color: #af8b88">{{$error}}</li>                      
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <h2 style="font-weight: 700">Checkout</h2>

            <div class="d-flex justify-content-between align-items-start">
                <div class="w-50">
                    <div class="my-5">
                        <h4 style="font-size: 1.2rem">Billing Details</h4>

                        <form action="" method="POST">
                            @csrf

                            <div class="form-group my-3">
                                <label for="email">Email</label><br>
                                
                                @if (auth()->user())
                                    <input class="form-control w-100" type="email" name="email" value="{{ auth()->user()->email }}">
                                @else
                                    <input class="form-control w-100" type="email" name="email" value="{{ old('email') }}">
                                @endif
                            </div>

                            <div class="form-group my-3">
                                <label for="name">Name</label><br>

                                @if (auth()->user())
                                    <input class="form-control w-100" type="text" name="name" value="{{ auth()->user()->name }}">
                                @else
                                    <input class="form-control w-100" type="text" name="name" value="{{ old('name') }}">
                                @endif
                            </div>

                            <div class="form-group my-3">
                                <label for="address_billing">Address</label><br>
                                <input class="form-control w-100" type="text" name="address_billing">
                            </div>

                            <div class="form-group d-flex w-100 justify-content-between">
                                <div class="w-100">
                                    <label for="city">City</label><br>
                                    <input class="form-control" style="width: 95%" type="text" name="city">
                                </div>

                                <div class="w-100">
                                    <label for="province">Province</label><br>
                                    <input class="form-control" style="width: 100%" type="text" name="province">
                                </div>
                            </div>

                            <div class="form-group d-flex w-100 justify-content-between">
                                <div class="w-100">
                                    <label for="postal_code">Postal Code</label><br>
                                    <input class="form-control" style="width: 95%" type="text" name="postal_code">
                                </div>

                                <div class="w-100">
                                    <label for="phone">Phone</label><br>
                                    <input class="form-control" style="width: 100%" type="text" name="phone">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="my-5">
                        <h4 style="font-size: 1.2rem">Payment Details</h4>

                        <form id="payment-form" action="" method="post">
                            @csrf

                            <div class="form-group my-3">
                                <label for="name_on_card">Name on Card</label><br>
                                <input class="form-control w-100" type="text" name="name_on_card">
                            </div>

                            <div id="link-authentication-element">
                                <!--Stripe.js injects the Link Authentication Element-->
                              </div>

                              <div id="payment-element">
                                <!--Stripe.js injects the Payment Element-->
                              </div>

                              <button id="submit">
                                <div class="spinner hidden" id="spinner"></div>
                                <span id="button-text">Pay now</span>
                              </button>

                              <div id="payment-message" class="hidden"></div>

                            <div class="form-group my-3">
                                <label for="address_payment">Address</label><br>
                                <input class="form-control w-100" type="text" name="address_payment">
                            </div>

                            <div class="form-group my-3">
                                <label for="credit_card_number">Credit Card Number</label><br>
                                <input class="form-control w-100" type="text" name="credit_card_number">
                            </div>

                            <div class="form-group d-flex w-100 justify-content-between">
                                <div class="w-100">
                                    <label for="expiry">Expiry</label><br>
                                    <input class="form-control" style="width: 95%" type="date" name="expiry">
                                </div>

                                <div class="w-100">
                                    <label for="cvc_code">CVC Code</label><br>
                                    <input class="form-control" style="width: 100%" type="text" name="cvc_code">
                                </div>


                            </div>

                            <div class="form-group my-3">
                                <button class="btn btn-primary w-100 py-2" type="submit">Complete Order</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="" style="width: 45%;">
                    <div class="my-5 mb-3">
                        <h4 style="font-size: 1.2rem">Your Order</h4>

                        <div>
                            @if (Cart::count() > 0)
                                @foreach (Cart::content() as $item)
                                <div class="d-flex w-100 align-items-center justify-content-between border-top border-bottom border-1 p-3">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="w-25">
                                            <a href="{{ route('shopShow', ['lang' => App::getLocale(), $item->model->slug]) }}">
                                                <img class="w-100" src="{{ $item->model->image && file_exists('storage/' . $item->model->image) ? asset('storage/' . $item->model->image) : asset('images/not-found.jpg') }}" alt="">
                                            </a>
                                        </div>
            
                                        <div class="mx-3">
                                            <a class="text-decoration-none text-dark" href="{{ route('shopShow', ['lang' => App::getLocale(), $item->model->slug]) }}" style="font-weight: 700">{{$item->model->name}}
                                            </a>

                                            <p class="text-muted">{{$item->model->details}}</p>

                                            <span style="font-weight: 600">
                                                ${{$item->subtotal/100}}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="border border-2 border-muted" style="padding: .1rem .5rem;">
                                        {{$item->qty}}
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="py-4 pb-4">
                            <div class="d-flex justify-content-between align-items-center py-2 px-3">
                                <div>Subtotal:</div>

                                <div>${{Cart::subtotal() / 100}}</div>
                            </div>

                            @if (session()->has('coupon'))
                                <div class="d-flex justify-content-between align-items-center px-3">
                                    <div class="d-flex align-items-center justify-content-start w-25">
                                        <span class="">Discount: ({{ session()->get('coupon')['code'] }})</span>

                                        <form class="" action="{{ route('couponDestroy', App::getLocale()) }}" method="post" style="display: inline; box-shadow: none">
                                            @csrf
                                            @method('delete')
                                            <input class="btn" type="submit" value="Remove" name="submit" style="font-size: .8rem; font-weight: 500">
                                        </form>
                                    </div>

                                    <div>
                                        - ${{ session()->get('coupon')['discount'] / 100 }}
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center py-2 pb-4 px-3 border-bottom border-2">
                                <div style="font-weight: 700; font-size: 1.3rem">Total:</div>

                                <div style="font-weight: 700; font-size: 1.3rem">
                                    ${{ (Cart::total() / 100) - $discount / 100 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @unless (session()->has('coupon'))
                        <div>
                            <div class="my-3" style="font-weight: 500">Have a Code?</div>
                            <div class="w-100">
                                <form class="d-flex" action="{{ route('couponStore', App::getLocale()) }}" method="post">
                                    @csrf
                                    <input class="w-75 mx-1 py-2" type="text" name="coupon_code">
                                    <input class="w-25 py-2 btn border border-2 border-secondary" type="submit" value="Apply" name="submit">
                                </form>
                            </div>
                        </div>
                    @endunless
                </div>
            </div>
        </div>
    </section>
</body>
</html>