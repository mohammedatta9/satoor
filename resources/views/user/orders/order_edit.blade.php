<div class="modal-header">
    <h5 class="modal-title"> الطلب رقم: {{ $order->number }}</h5>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="met-profile">
                    <div class="row">
                        {{-- <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                            <div class="met-profile-main">
                                <div class="met-profile-main-pic">

                                </div>
                                <div class="met-profile_user-detail">
                                    <h5 class="met-user-name"> رقم الطلب #{{ $order->number }} </h5>
                                    <a href=" ">
                                        @if ($order->status == 1)
                                            <button type="submit" class="btn btn-primary"> شحن</button>
                                        @endif
                                    </a>
                                    <hr>
                                    <a href=" ">
                                        @if ($order->status >= 1)
                                            <button type="submit" class="btn btn-danger"> الغاء
                                                الطلب</button>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>  --}}

                        <div class="col-lg-6 ms-auto align-self-center">
                            <ul class="list-unstyled personal-detail mb-0">

                                <li class="mt-2">
                                    <b> {{ __('dash.address') }}</b> : {{ $order->address }}
                                </li>

                                <li class="mt-2">
                                    <b> {{ __('dash.name') }}</b> : {{ $order->name }}
                                </li>
                                <li class="mt-2">
                                    <b>{{ __('dash.phone') }}</b> : {{ $order->phone }}
                                </li>
                                <li class="mt-2">
                                    <b>{{ __('dash.email') }}</b> : {{ $order->email }}
                                </li>
                                <li class="mt-2">
                                    <b>{{ __('dash.nots') }}</b> : {{ $order->nots }}
                                </li>

                            </ul>

                        </div><!--end col-->

                        <div class="col-lg-6 ms-auto align-self-center">
                            <ul class="list-unstyled personal-detail mb-0">

                                <li class="mt-2">
                                    <b> عدد المنتجات </b> : {{ $order->items->count() }}
                                </li>

                                <li class="mt-2">
                                    <b> المجموع الجزئي </b> : {{ $order->total + $order->discount - 8 }}
                                </li>
                                <li class="mt-2">
                                    <b>الشحن</b> : 8
                                </li>
                                @if ($order->discount > 0)
                                    <li class="mt-2">
                                        <b>الخصم</b> : {{ $order->discount }}
                                    </li>
                                @endif
                                <li class="mt-2">
                                    <b> المجموع الكلي </b> : {{ $order->total }}
                                </li>

                                <li class="mt-2">
                                    <b> طريقة الدفع </b> : @if ($order->payment_method == 'cash')
                                        الدفع عند الاستلام
                                    @else
                                        بطاقة ائتمان
                                        @if ($order->payment)
                                            @if ($order->payment->status == 'pending')
                                                <span class="badge bg-primary"> في انتظار الدفع</span>
                                            @elseif($order->payment->status == 'completed')
                                                <span class="badge bg-success"> تم الدفع</span>
                                            @elseif($order->payment->status == 'failed')
                                                <span class="badge bg-danger"> تم الغاء الدفع</span>
                                            @else
                                                <span class="badge bg-danger"> فشل الدفع</span>
                                            @endif
                                        @endif
                                    @endif
                                </li>
                            </ul>

                        </div><!--end col-->

                    </div><!--end row-->
                </div><!--end f_profile-->
            </div><!--end card-body-->


            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#Post" role="tab"
                            aria-selected="true">المنتجات</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane p-3 active" id="Post" role="tabpanel">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:90%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المنتج</th>
                                        <th>رمز المنتج</th>
                                        <th>صورة المنتج</th>
                                        <th>كمية المنتج</th>
                                        <th>السعر</th>
                                        <th>الاجمالي</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{ $item->product_name }} </td>
                                            <td>{{ $item->product->code }} </td>

                                            <td>
                                                @if ($item->product->image)
                                                    <img src="{{ asset('/storage/files/' . $item->product->image) }}"
                                                        alt="{{ $item->product->image }}" width="100">
                                                @endif
                                            </td>
                                            <td>{{ $item->quantity }} </td>
                                            <td>{{ $item->product->price }}</td>
                                            <td>{{ $item->product->price * $item->quantity }} </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="tab-pane p-3" id="Settings" role="tabpanel">
                        <div class="row">
                            <div class="card">


                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
