@extends('layouts.dash_master')
@section('title')
    <title>{{ __('dash.User') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dash.User') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('dash.Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $user->name}}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="met-profile">
                                    <div class="row">

                                        <div class="col-lg-6 ms-auto align-self-center">
                                            <ul class="list-unstyled personal-detail mb-0">

                                                <li class="mt-2">
                                                    <b> {{ __('dash.name') }}</b> : {{ $user->name }}
                                                </li>
                                                <li class="mt-2">
                                                    <b>{{ __('dash.phone') }}</b> : {{ $user->phone }}
                                                </li>
                                                <li class="mt-2">
                                                    <b>{{ __('dash.email') }}</b> : {{ $user->email }}
                                                </li>

                                            </ul>

                                        </div><!--end col-->

                                        <div class="col-lg-6 ms-auto align-self-center">
                                            <ul class="list-unstyled personal-detail mb-0">

                                                <li class="mt-2">
                                                    <b> عدد المنتجات </b> : {{ $user->products()->count() }}
                                                </li>


                                            </ul>

                                        </div><!--end col-->

                                    </div><!--end row-->
                                </div><!--end f_profile-->
                            </div><!--end card-body-->


                            <div class="card-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link " data-bs-toggle="tab" href="#products" role="tab"
                                            aria-selected="true">المنتجات</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#agents" role="tab">العملاء</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane p-3 " id="products" role="tabpanel">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered" style="width:90%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم المنتج</th>
                                                        <th>رمز المنتج</th>
                                                        <th>صورة المنتج</th>
                                                        <th>السعر</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($user->products as $product)
                                                        <tr>
                                                            <td>{{ $loop->iteration }} </td>
                                                            <td>{{ $product->name }} </td>
                                                            <td>{{ $product->code }} </td>

                                                            <td>
                                                                @if ($product->image)
                                                                    <img src="{{ asset('/storage/files/' . $product->image) }}"
                                                                        alt="{{ $product->image }}" width="100">
                                                                @endif
                                                            </td>
                                                            <td>{{ $product->price }}</td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="tab-pane p-3 active" id="agents" role="tabpanel">
                                        <div class="table-responsive">
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
                                                    @foreach ($user->users as $index => $agent)
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
                                        </div><!--end row-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

        </section>
    </div>

@endsection


