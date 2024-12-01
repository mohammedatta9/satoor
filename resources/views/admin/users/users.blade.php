@extends('layouts.dash_master')
@section('title')
    <title>{{ __('dash.Users') }}</title>
@endsection
@include('layouts.admin_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dash.Users') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('dash.Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('dash.Users') }}</div>
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
                                            @foreach ($users as $index => $user)
                                                <tr>
                                                    <td>{{ ++$index }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>

                                                    <td>
                                                        @if ($user->status == 1)
                                                            <a href="javascript:;"
                                                                onclick="changeUserStatus({{ $user->id }})">
                                                                <input id="status_toggle" type="checkbox" checked
                                                                    data-toggle="toggle" data-on="{{ __('dash.Active') }}"
                                                                    data-off="{{ __('dash.Inactive') }}"
                                                                    data-onstyle="success" data-offstyle="danger">
                                                            </a>
                                                        @else
                                                            <a href="javascript:;"
                                                                onclick="changeUserStatus({{ $user->id }})">
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
                                                                <li><a href="{{route('admin.users.show', $user->id)}}" class="btn-modal" ><i
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

@endsection

@push('js')
<script>
    function changeUserStatus(id) {
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
            url: "{{ url('admin/user-status/') }}" + "/" + id,
            success: function(response) {
                toastr.success(response)
            },
            error: function(err) {


            }
        })
    }
</script>

@endpush
