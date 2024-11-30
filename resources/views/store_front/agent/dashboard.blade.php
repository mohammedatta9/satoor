@extends('store_front.master', ['data' => $data])
@section('title')
    <title>{{ $data->setting->store_name }}</title>
@endsection
@section('content')


        <a href="" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
        document.getElementById('admin-logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> {{__('dash.Logout')}}
        </a>
      {{-- start admin logout form --}}
      <form id="admin-logout-form" action="{{ route('agent.logout' , $user->user->slug) }}" method="POST" class="d-none">
          @csrf
      </form>
        <!-- start breadcrumb -->

        <section class="section-breadcrumb p-2">
            <div class="container">
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">إنشاء حساب</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- end breadcrumb -->

<h1>{{$user->user->slug}}</h1>


<main>
    <!-- start breadcrumb -->

    <section class="section-breadcrumb p-2">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                      <li class="breadcrumb-item"><a href="#">حسابي</a></li>
                      <li class="breadcrumb-item active" aria-current="page">التنزيلات</li>
                    </ol>
                  </nav>
            </div>
        </div>
    </section>
    <!-- end breadcrumb -->

    <!-- start tab -->
    <section class="container section-tab-downloads">
        <div class="row">
            <div class="col-md-4 ps-0 pe-lg-5">
                <div class="nav flex-md-column nav-pills me-md-3 p-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <div class="d-flex align-items-center w-100 p-1 flex-fill">
                        <span  class="bi bi-person-circle person-img"></span>
                        <span class="tab-person-name">أحمد</span>
                    </div>
                    <button class="nav-link flex-fill" id="v-pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab" aria-controls="v-pills-dashboard" aria-selected="false">لوحة التحكم</button>
                    <button class="nav-link flex-fill" id="v-pills-request-tab" data-bs-toggle="pill" data-bs-target="#v-pills-request" type="button" role="tab" aria-controls="v-pills-request" aria-selected="false">الطلبات</button>
                    <button class="nav-link flex-fill active" id="v-pills-downloads-tab" data-bs-toggle="pill" data-bs-target="#v-pills-downloads" type="button" role="tab" aria-controls="v-pills-downloads" aria-selected="true">التنزيلات</button>
                    <button class="nav-link flex-fill" id="v-pills-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-address" type="button" role="tab" aria-controls="v-pills-address" aria-selected="false">العنوان</button>
                    <button class="nav-link flex-fill" id="v-pills-details-tab" data-bs-toggle="pill" data-bs-target="#v-pills-details" type="button" role="tab" aria-controls="v-pills-details" aria-selected="false">تفاصيل الحساب</button>
                    <a class="btn btn-log-out flex-fill">تسجيل الخروج</a>
                  </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab" tabindex="0">.1..</div>
                    <div class="tab-pane fade" id="v-pills-request" role="tabpanel" aria-labelledby="v-pills-request-tab" tabindex="0">.2..</div>
                    <div class="tab-pane fade show active" id="v-pills-downloads" role="tabpanel" aria-labelledby="v-pills-downloads-tab" tabindex="0">
                        <div class="table-responsive section-table mt-md-5">
                        <table class="table border mt-md-5">
                            <thead>
                              <tr>
                                <th scope="col">  2 </th>
                                <th scope="col">  2 </th>
                                <th scope="col">2</th>
                                <th scope="col">2 </th><th scope="col">2</th>
                                <th scope="col"> 2</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->orders as $order)
                                <tr class="R_order{{$order->id}}">
                                    <th scope="row">{{$order->id}}</th>
                                    <td>  {{$order->total}}  {{__('AED')}}</td>
                                     <td>    {{$order->items->count()}} </td>

                                      <th > @if($order->status == 0) {{__('Rejected')}}@endif @if($order->status == 1) {{__('Requested')}} @endif @if($order->status == 2)  {{__('is shipped')}} @endif @if($order->status == 3) {{__('Delivered')}} @endif </th>
                                      <th> @if($order->payment_method == "cash") @if($order->status == 1)<a href="" class="deletem_order" deletem_order="{{$order->id}}" > {{__('cancel')}}</a>@endif @endif</th>
                                      <td>    @if($order->payment_method == "cash")
                                              الدفع عند الاستلام
                                              @else
                                              بطاقة ائتمان
                                              @endif </td>
                                      <th ><a href="showorder/{{$order->id}}" > {{__('show')}}</a> </th>
                                    </tr>
                                @endforeach


                            </tbody>
                          </table>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab" tabindex="0">.5..</div>
                    <div class="tab-pane fade" id="v-pills-details" role="tabpanel" aria-labelledby="v-pills-details-tab" tabindex="0">.5..</div>
                  </div>
            </div>
    </div>
    </section>
    <!-- end tab -->
        </main>
@endsection
