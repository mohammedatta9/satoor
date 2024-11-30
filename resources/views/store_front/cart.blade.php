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
                            <li class="breadcrumb-item"><a href="">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Shopping cart') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- end breadcrumb -->

        <section class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if ($cart->get($data->id)->count() == 0)
                        <h1>{{ __('The cart is empty') }}</h1><br><a href="">{{ __('Home') }}</a>
                    @else
                        @foreach ($cart->get($data->id) as $item)
                            <div class="d-sm-flex  product-in-cart align-items-center" id="{{ $item->id }}">

                                <div class="item product-in-cart-image">
                                    <a href=" ">
                                        <img src="{{ asset('storage/files/' . ($item->product->image ?? 'default.png')) }}"
                                            alt="image for product"></a>

                                </div>
                                <div class="item product-in-cart-title flex-fill text-start">
                                    <p> {{ $item->product->name }}</p>
                                </div>
                                <div class="item product-in-cart-quantity">
                                    <div class="d-flex quantity-of-product" role="group" aria-label="Basic example">
                                        <button type="button" class="btn bi bi-dash"></button>

                                        <input type="text" class="btn btn-quantity-product item-quantity" readonly
                                            product_id="{{ $item->product->id }}" dataa_id="{{ $item->id }}"
                                            dataa_total="{{ $item->quantity * $item->product->price }}"
                                            dataa_price="{{ $item->product->price }}" value="{{ $item->quantity }}">

                                        <button type="button" class="btn bi bi-plus"></button>
                                    </div>
                                </div>x
                                <div class="item product-in-cart-sum">
                                    <sapn  >
                                        @if ($item->product->price)
                                            {{ $item->product->price }}
                                        @else
                                            {{ $item->product->price_sale }}
                                        @endif
                                    </sapn>
                                    {{ __('AED') }}
                                </div>
                                <div class="item product-in-delete">
                                    <button class="btn bi bi-trash border-0 remove-item" data_id="{{ $item->id }}"
                                        href="javascript:void(0)"></button>
                                </div>
                            </div>
                        @endforeach


                        <div class="d-md-flex discount-code justify-content-between">

                            <a href="/{{ $data->slug }}/cartempty">
                                <button class="btn btn-outline-dark btn-refresh-cart"> {{ __('Empty the cart') }}
                                </button></a>
                        </div>
                </div>

                <div class="col-lg-4">

                    <div class="cart-sum my-5 my-md-2">
                        <p class="my-3 text-center"> {{ __('Total cart') }}</p>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span> {{ __('Partial total') }}</span>
                            <div id="totalq1">
                                <span id="totals1">{{ $cart->total($data->id) }}</span>
                                {{$data->setting->currency->symbol}}
                            </div>
                        </div>
                        <hr>
                        <form id="contact-form" action="{{route('index_order',$data->slug)}}" method="get">
                            @csrf

                            <div class="d-flex justify-content-between">
                                <span> {{ __('Total summation') }}</span>
                                <div id="totalq">
                                    <span id="totals">{{ $cart->total($data->id) }}</span>
                                    {{ __('AED') }}
                                </div>
                            </div>



                            <button class="btn btn-warning w-100 my-3 mt-4 continue-buying"
                                type="submit">{{ __('Continue to complete the purchase') }} </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('js')
    <script>
        $('.remove-item').on("click", function(e) {
            //  e.preventDefault();

            var id = $(this).attr('data_id');


            $.ajax({
                type: "post",
                url: '/{{ $data->slug }}' + "/cart/" + id,
                method: "delete",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // let's set the expected response format
                success: function(data) {
                    $("#" + data.id).remove();
                    $("#totals").remove();
                    $("#totalq").fadeIn().html('<span id="totals">' + data.totala +
                        '</span> {{ __('AED') }}');
                    $("#totals1").remove();
                    $("#totalq1").fadeIn().html('<span id="totals1">' + data.totala +
                        '</span> {{ __('AED') }}');
                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        $('#axaa').fadeIn().html(
                            '<div class="alert alert-danger border-0 alert-dismissible">' + err
                            .responseJSON.message + '</div>');


                    }
                }
            });

        });


        $('.item-quantity').on("change", function(e) {
            //  e.preventDefault();

            var id = $(this).attr('dataa_id');
            var product_id = $(this).attr('product_id');
            var total = $(this).attr('dataa_total') + $(this).attr('dataa_price');



            $.ajax({
                type: "post",
                url: '/{{ $data->slug }}' + "/cart/" + id,
                method: "put",
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: $(this).val(),
                    product_id: product_id,
                    xx: 'x',
                },
                // let's set the expected response format
                success: function(data) {

                    $("#totals").remove();
                    $("#totalq").fadeIn().html('<span id="totals">' + data.totalx +
                        ' </span> {{ __('AED') }}');
                    $("#totals1").remove();
                    $("#totalq1").fadeIn().html('<span id="totals1">' + data.totalx +
                        ' </span> {{ __('AED') }}');
                    toastr.success('done');



                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        $('#axaa').fadeIn().html(
                            '<div class="alert alert-danger border-0 alert-dismissible">' + err
                            .responseJSON.message + '</div>');


                    }
                }
            });

        });
    </script>
@endpush
