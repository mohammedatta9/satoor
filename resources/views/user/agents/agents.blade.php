@extends('layouts.dash_master')
@section('title')
    <title>{{ __('dash.Agents') }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dash.Agents') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{ __('dash.Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('dash.Agents') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('dash.SN') }}</th>
                                                <th>{{ __('dash.Name') }}</th>
                                                <th>{{ __('dash.Email') }}</th>
                                                <th>{{ __('dash.Status') }}</th>
                                                <th>{{ __('dash.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($agents as $index => $agent)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $agent->name }}</td>
                                                    <td>{{ $agent->email }}</td>

                                                    <td>
                                                        @if ($agent->status == 1)
                                                            <a href="javascript:;"
                                                                onclick="changeAgentStatus({{ $agent->id }})">
                                                                <input id="status_toggle" type="checkbox" checked
                                                                    data-toggle="toggle" data-on="{{ __('dash.Active') }}"
                                                                    data-off="{{ __('dash.Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="changeAgentStatus({{ $agent->id }})">
                                                                <input id="status_toggle" type="checkbox"
                                                                    data-toggle="toggle" data-on="{{ __('dash.Active') }}"
                                                                    data-off="{{ __('dash.Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="header_shortcut_dropdown" type="button"
                                                                class="btn btn-info dropdown-toggle btn-flat pull-left m-8 btn-sm mt-10"
                                                                data-toggle="dropdown">
                                                                {{ __('dash.Actions') }}
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-left"
                                                                role="menu">
                                                                <li><a href="##" class="btn-modal" data-toggle="modal" data-target="#orderModal{{ $agent->id }}"><i
                                                                            class="fas fa-eye"></i>
                                                                        {{ __('dash.view') }}</a>
                                                                </li>
                                                                <li><a href=" " data-id=" "
                                                                    class="delete-sale"><i
                                                                        class="fas fa-trash"></i>
                                                                    {{ __('dash.delete') }}</a>
                                                                </li>
                                                                <li><a data-id=" "
                                                                    class="delete-sale"><i
                                                                        class="fas fa-messege"></i>
                                                                    {{ __('dash.messege') }}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <!-- Modal -->

    @foreach ($agents as $agent2 )
    <div class="modal fade" id="orderModal{{ $agent2->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="met-profile">
                                    <div class="row">
                                        <div class="col-lg-6 ms-auto align-self-center">
                                            <ul class="list-unstyled personal-detail mb-0">

                                                <li class="mt-2">
                                                    <b>
                                                        {{ __('dash.address') }}</b>
                                                    : {{ $agent2->address }}
                                                </li>

                                                <li class="mt-2">
                                                    <b>
                                                        {{ __('dash.name') }}</b>
                                                    : {{ $agent2->name }}
                                                </li>
                                                <li class="mt-2">
                                                    <b>{{ __('dash.phone') }}</b>
                                                    : {{ $agent2->phone }}
                                                </li>
                                                <li class="mt-2">
                                                    <b>{{ __('dash.email') }}</b>
                                                    : {{ $agent2->email }}
                                                </li>
                                            </ul>

                                        </div><!--end col-->

                                        <div class="col-lg-6 ms-auto align-self-center">
                                            <ul class="list-unstyled personal-detail mb-0">

                                                <li class="mt-2">
                                                    <b> عدد الطلبات </b> :{{ $agent2->orders()->count() }}
                                                </li>

                                                <li class="mt-2">
                                                    <b> المجموع الجزئي </b> :

                                                </li>
                                                <li class="mt-2">
                                                    <b>الشحن</b> : 8
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
                                            aria-selected="true">الطلبات</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane p-3 active" id="Post" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered"
                                                style="width:90%;">
                                                <thead>
                                                    <tr>
                                                        <th> {{ __('dash.Action') }}</th>
                                                        <th>#</th>
                                                        <th> {{ __('dash.total') }}</th>
                                                        <th> {{ __('dash.user_name') }}</th>
                                                        <th> {{ __('dash.Status') }}</th>
                                                        <th> {{ __('dash.Quantity') }}</th>
                                                        <th> {{ __('dash.Payment_status') }}</th>
                                                        <th> {{ __('dash.Date') }}</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($agent2->orders as $index => $order)
                                                        <tr>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button id="header_shortcut_dropdown" type="button"
                                                                        class="btn btn-info dropdown-toggle btn-flat pull-left m-8 btn-sm mt-10"
                                                                        data-toggle="dropdown">
                                                                        {{ __('dash.Actions') }}
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-left"
                                                                        role="menu">
                                                                        <li><a href="##" class="btn-modal edit-order"
                                                                                data-id="{{ $order->id }}"><i
                                                                                    class="fas fa-eye"></i>
                                                                                {{ __('dash.view') }}</a>
                                                                        </li>
                                                                        <li><a href="##"
                                                                                class="btn-modal edit-shipping"
                                                                                data-id="{{ $order->id }}"><i
                                                                                    class="fas fa-truck"></i>
                                                                                {{ __('dash.shipping') }}</a>
                                                                        </li>
                                                                        <li><a href=" " data-id="{{ $order->id }}"
                                                                                class="delete-sale"><i
                                                                                    class="fas fa-trash"></i>
                                                                                {{ __('dash.delete') }}</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <td>{{ $order->number }}
                                                            </td>
                                                            <td>{{ $order->total }}
                                                            </td>
                                                            <td>{{ $order->name }}
                                                            </td>
                                                            <td>{{ $order->status }}
                                                            </td>
                                                            <td>{{ $order->items->count() }}
                                                            </td>
                                                            <td>{{ $order->payment_status }}
                                                            </td>
                                                            <td>{{ $order->created_at->format('d/m/Y') }}
                                                            </td>


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

                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <!-- سيتم تحميل المحتوى هنا -->
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function changeAgentStatus(id) {
        var isDemo = "{{ env('APP_MODE') }}"
        if (isDemo == 'DEMO') {
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type: "put",
            data: {
                _token: '{{ csrf_token() }}'
            },
            url: "{{ url('/agent-status/') }}" + "/" + id,
            success: function(response) {
                toastr.success(response)
            },
            error: function(err) {


            }
        })
    }
</script>
<script>
    $(document).ready(function() {
        $('.edit-order').on('click', function() {
            const orderId = $(this).data('id');

            // جلب محتوى المودال باستخدام Ajax
            $.ajax({
                url: '/orders/' + orderId + '/modal',
                method: 'GET',
                success: function(response) {
                    // تعيين المحتوى إلى المودال
                    $('#orderModal .modal-content').html(response.modalContent);
                    $('#orderModal').modal('show');
                },
                error: function() {
                    alert('حدث خطأ أثناء جلب بيانات الطلب.');
                }
            });
        });
    });

 $(document).ready(function() {
        $('.edit-shipping').on('click', function() {
            const orderId = $(this).data('id');

            // جلب محتوى المودال باستخدام Ajax
            $.ajax({
                url: '/order-shipping/' + orderId + '/modal',
                method: 'GET',
                success: function(response) {
                    // تعيين المحتوى إلى المودال
                    $('#orderModal .modal-content').html(response.modalContent);
                    $('#orderModal').modal('show');
                },
                error: function() {
                    alert('حدث خطأ أثناء جلب بيانات الطلب.');
                }
            });
        });
    });
</script>
<script>
    $(document).on('submit', '.orderForm', function(e) {
            e.preventDefault();
            const orderId = $(this).data('id');

            // مسح الأخطاء السابقة
            $('.text-danger').text('');

            $.ajax({
                url: '/order-shipping/' + orderId,
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                $('#orderModal').modal('hide');
                toastr.success(response.message);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    if (errors) {
                        // عرض الأخطاء لكل حقل
                        if (errors.address) {
                            $('.error-address').text(errors.address[0]);
                        }
                        if (errors.status) {
                            $('.error-status').text(errors.status[0]);
                        }
                        if (errors.nots) {
                            $('.error-nots').text(errors.nots[0]);
                        }
                    }
                }
            });
        });
</script>
@endpush
