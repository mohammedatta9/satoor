@extends('store_front.master', ['data' => $data])
@section('title')
    <title>{{ $data->setting->store_name }}</title>
@endsection

@section('content')
    <!-- start breadcrumb -->
    <main>
        <section class="section-breadcrumb p-2">
            <div class="container">
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/{{$data->slug}}">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Checkout') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- end breadcrumb -->
        <section class="container py-3 section-continue">
            <div class="row">
                <div class="col-md-6 payment-details">
                    <p class="h4">
                        {{ __('Payment details') }}
                    </p>
                    <br>
                    <form id="contact-form" action="{{ route('store_order',$data->slug) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="full-name" class="form-label"> {{ __('Full Name') }}</label>
                            @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="name" class="form-control" id="full-name"
                                value=""
                                maxlength="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="email-address" class="form-label"> {{ __('Email') }}</label>
                            @error('email')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <input type="email" name="email" class="form-control" id="email-address"
                                value=" "
                                maxlength="100" required>
                        </div>

                        <div class="mb-3">
                            <label for="flat" class="form-label"> {{ __('Address') }}</label>
                            <input type="text" name="address" class="form-control"
                                placeholder="المدينة - الحي - الشارع -أدخل رقم/اسم الشقة/المنزل"
                                value="{{ old('address') }}"
                                maxlength="1000">
                        </div>
                        <div class="mb-3">
                            <label for="mobile-number" class="form-label"> {{ __('Mobile number') }}</label>
                            @error('phone')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <input type="text" name="phone" class="form-control" id="mobile-number"
                                value=" {{ old('phone') }}  "
                                maxlength="100" required>
                        </div>
                        @guest
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="make_user"
                                id="accept">
                            <label class="form-check-label" for="accept">
                                إنشاء حساب
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="user-password" class="form-label"> {{ __('Password') }}</label>
                            @error('password')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <button type="button" class="btn btn-eye bi bi-eye"></button>
                                <input type="password" class="form-control" name="password"
                                    aria-label="user-password" aria-describedby="user-password">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="user-password" class="form-label"> {{ __('Confirm password') }}</label>
                            @error('password_confirmation')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group">
                                <button type="button" class="btn btn-eye bi bi-eye"></button>
                                <input type="password" class="form-control" name="password_confirmation"
                                    aria-label="user-password" aria-describedby="user-password">
                            </div>
                        </div>
                        @endguest

                        <div class="mb-3">
                            <label for="add-nots" class="form-label"> {{ __('Notes with the order') }}</label>
                            <textarea class="form-control" name="nots" id="add-nots" cols="10" maxlength="300" rows="5"></textarea>
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" value="" id="accept-terms" required>
                            <label class="form-check-label" for="accept-terms">
                                {{ __('I agree to the terms and conditions') }}
                            </label>
                        </div>

                </div>
                <div class="col-md-6 do-you-have-discount-code mt-5 mt-md-0">


                    <div class="cart-sum my-5">
                        <p class="h5 my-3 text-center">{{ __('Shopping cart') }}</p>
                        @foreach ($cart->get($data->id) as $item)
                            <div class="d-flex product-in-cart align-items-center">
                                <div class="item product-in-cart-image">
                                    <a href=" ">
                                        <img src="{{ asset('/storage/files/' . $item->product->image) }}"
                                            alt="image for product"></a>
                                </div>
                                <div class="item product-in-cart-title flex-fill text-start">
                                    <p> {{ $item->product->name }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-between mt-5">
                            <span> {{ __('Partial total') }}</span>
                            <div>
                                <span> {{ $cart->total($data->id) }} </span>
                                {{$data->setting->currency->symbol}}
                            </div>
                        </div>
                        <hr>


                        <div class="d-flex justify-content-between">
                            <span>{{ __('Shipping') }}</span>
                            <div>
                                <span>8</span>
                                {{$data->setting->currency->symbol}}
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between">
                            <span> {{ __('Total summation') }}</span>
                            <bold>
                                <span>

                                        {{ $cart->total($data->id) + 8 }}

                                </span>

                                {{$data->setting->currency->symbol}}
                            </bold>
                        </div>




                    </div>

                    <div class="mb-3 form-check">
                        @error('payment_method')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <input name="payment_method" class="form-check-input" type="radio" checked value="cash"
                            id="buy-cash">
                        <label class="form-check-label" for="buy-cash">
                            <img src="{{ asset('images/cach.png') }}" width="auto" height="20px" alt="buy cash">
                            {{ __('Cash on delivery') }}
                        </label>
                    </div>
                    <div class="mb-3 form-check">
                        <input name="payment_method" class="form-check-input" type="radio" value="check"
                            id="buy-check">
                        <label class="form-check-label" for="buy-check">
                            <img src="{{ asset('images/chech.png') }}" width="auto" height="20px" alt="buy cash">
                            {{ __('Credit card') }}
                        </label>
                    </div>
                    <input type="text"
                        value="   {{ $cart->total($data->id) + 8 }}"
                        name="total" style="display:none">


                    <hr class="my-4 hr-blue">

                    <input type="submit" class="btn btn-warning float-end submit-buying"
                        value=" {{ __('Confirmation') }} ">

                </div>
                </form>
            </div>
        </section>
    </main>
@endsection
