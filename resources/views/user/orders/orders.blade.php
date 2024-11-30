@extends('layouts.dash_master')
@section('title')
    <title>{{ __('dash.orders') }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dash.orders') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{ __('dash.Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('dash.orders') }}</div>
                </div>
            </div>

            <div class="section-body">
                {{-- <a href="{{ route('user.category.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('dash.Add New')}}</a> --}}
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped" id="dataTable">
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
                                            @foreach ($orders as $index => $order)
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="header_shortcut_dropdown" type="button"
                                                                class="btn btn-info dropdown-toggle btn-flat pull-left m-8 btn-sm mt-10"
                                                                data-toggle="dropdown"> {{ __('dash.Actions') }}
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                                                <li><a href="##" class="btn-modal edit-order"
                                                                        data-id="{{ $order->id }}"><i
                                                                            class="fas fa-eye"></i>
                                                                        {{ __('dash.view') }}</a></li>
                                                                <li><a href="##" class="btn-modal edit-shipping"
                                                                        data-id="{{ $order->id }}"><i
                                                                            class="fas fa-truck"></i>
                                                                        {{ __('dash.shipping') }}</a></li>
                                                                <li><a href=" " data-id="{{ $order->id }}"
                                                                        class="delete-sale"><i class="fas fa-trash"></i>
                                                                        {{ __('dash.delete') }}</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>{{ $order->number }}</td>
                                                    <td>{{ $order->total }}</td>
                                                    <td>{{ $order->name }}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ $order->items->count() }}</td>
                                                    <td>{{ $order->payment_status }}</td>
                                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>


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
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- سيتم تحميل المحتوى هنا -->
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="canNotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{ __('dash.You can not delete this order. Because there are one or more products has been created in this category.') }}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('dash.Close') }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')

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
