@extends('store_front.master', ['data' => $data])
@section('title')
    <title>{{ $data->setting->store_name }}</title>
@endsection
@section('content')
    <main>
        <!-- start shop by category -->
        <section class="shop-by-category py-4">
            <div class="container">
                <div class="row d-flex align-items-stretch">
                    <p class="h2 mb-3">تسوق حسب الفئة</p>
                    @foreach ($data->categories()->main()->active()->get() as $category)
                        <div class="col-x col-6 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                            <a href="" class="card">
                                <p>{{ $category->name }}</p>
                                <img src="{{ asset('storage/files/' . ($category->icon ?? 'default.png')) }}" alt="solar panel">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end shop by category -->

        <!-- start products -->
        <section class="section-boards py-3">
            <div class="container">
                <div class="row">
                    <div class="clearfix">
                        <p class="h2 mb-3 float-start">قسم سيستم الطاقة الشمسية</p>
                    </div>

                        @foreach ( $data->products()->active()->get() as $product )
                        <div class="col-x col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                            <div class="card-product p-3">
                                <h6 class="card-title">{{$product->name}}</h6>
                                <div class="product-contain">
                                    <img src="{{ asset('storage/files/' . ($product->image ?? 'default.png')) }}" alt="image for product">
                                </div>
                                <div class="card-body d-flex justify-content-between align-items-end">
                                    <div>
                                        <button id="cart{{$product->id}}" class="btn bi btn-cart add_cart bi-cart-fill" product_id="{{$product->id}}"></button>
                                        <button class="btn bi bi-heart btn-heart"></button>
                                    </div>
                                    <div>
                                        <del class="d-block">
                                            @if ($product->price_sale)
                                            <sapn>{{$product->price_sale}}</span>{{$data->setting->currency->symbol}}
                                            @endif
                                        </del>
                                        <span class="d-block">
                                            <sapn>{{$product->price}} {{$data->setting->currency->symbol}}</span>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                </div>
            </div>
        </section>
        <!-- end products -->
    </main>
@endsection

@push('js')

  <script>

$('.add_cart').on("click", function (e) {
            e.preventDefault();

         var id = $(this).attr('product_id');


         $.ajax({
                type: "post",
                url: "{{ route('cart.store', $data->slug) }}",
                data: { _token: '{{ csrf_token() }}',
                     "product_id" : id,
                     "quantity" : 1},
                    dataType: 'json',              // let's set the expected response format
                    success: function (data) {
                        toastr.success('تمت الاضافة الى السلة');

                    },
                    error: function (err) {
                        if (err.status == 422) { // when status code is 422, it's a validation issue
                            console.log(err.responseJSON);
                            $('#success_message_notifications').fadeIn().html('<div class="alert alert-danger border-0 alert-dismissible">' + err.responseJSON.message +'</div>');


                        }
                    }
                });

    });
</script>
@endpush
