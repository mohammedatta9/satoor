@extends('layouts.dash_master')
@section('title')
    <title>{{ __('dashashboard') }}</title>
@endsection
@include('layouts.user_sidebar')
@section('dash-content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dashSettings') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('user.dashboard') }}">{{ __('dashDashboard') }}</a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-3">
                                            <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">


                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link active" id="general-setting-tab" data-toggle="tab"
                                                        href="#generalSettingTab" role="tab"
                                                        aria-controls="generalSettingTab"
                                                        aria-selected="true">{{ __('dash.General Setting') }}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="logo-tab" data-toggle="tab" href="#logoTab"
                                                        role="tab" aria-controls="logoTab"
                                                        aria-selected="true">{{ __('dash.Logo and Favicon') }}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="recaptcha-tab" data-toggle="tab"
                                                        href="#recaptchaTab" role="tab" aria-controls="recaptchaTab"
                                                        aria-selected="true">{{ __('dash.Google Recaptcha') }}</a>
                                                </li>


                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="custom-pagination-tab" data-toggle="tab"
                                                        href="#customPaginationTab" role="tab"
                                                        aria-controls="customPaginationTab"
                                                        aria-selected="true">{{ __('dash.Custom Pagination') }}</a>
                                                </li>

                                                <li class="nav-item border rounded mb-1">
                                                    <a class="nav-link" id="social-login-tab" data-toggle="tab"
                                                        href="#socialLoginTab" role="tab" aria-controls="socialLoginTab"
                                                        aria-selected="true">{{ __('dash.Social Login') }}</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-9">
                                            <div class="border rounded">
                                                <div class="tab-content no-padding" id="settingsContent">

                                                    <div class="tab-pane fade show active" id="generalSettingTab"
                                                        role="tabpanel" aria-labelledby="general-setting-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form action="{{ route('user.update-general-setting') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        {{-- //logo --}}
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="username">{{ __('dash.Logo') }}</label>
                                                                                <input type='file'
                                                                                    onchange="loadFile_image(logo)"
                                                                                    name="logo" id="logo"
                                                                                    class="@error('logo') is-invalid @enderror"
                                                                                    style="display:none;" />
                                                                                <button id="output_logo" type="button"
                                                                                    onclick="document.getElementById('logo').click();"
                                                                                    value="emad"
                                                                                    style="
                                                                                width: 150px;
                                                                                height: 150px;
                                                                                border-radius: 50%;
                                                                                background-color: #cecbcb;
                                                                                background-image: url({{ asset('storage/files/' . ($setting->store_logo ?? 'default.png')) }});
                                                                                background-repeat: no-repeat;
                                                                                background-size: cover;
                                                                                background-position: center;
                                                                                " />
                                                                            </div>
                                                                        </div>
                                                                        <script>
                                                                            var loadFile_image = function(image) {
                                                                                var image = document.getElementById('output_logo');
                                                                                var src = URL.createObjectURL(event.target.files[0]);
                                                                                image.style.backgroundImage = 'url(' + src + ')';
                                                                            };
                                                                        </script>

                                                                        {{-- //footer_logo --}}
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="username">{{ __('dash.Footer Logo') }}</label>
                                                                                <input type='file'
                                                                                    onchange="loadFile_image1(footer_logo)"
                                                                                    name="footer_logo" id="footer_logo"
                                                                                    class="@error('footer_logo') is-invalid @enderror"
                                                                                    style="display:none;" />
                                                                                <button id="output_footer_logo"
                                                                                    type="button"
                                                                                    onclick="document.getElementById('footer_logo').click();"
                                                                                    value="emad"
                                                                                    style="
                                                                                width: 150px;
                                                                                height: 150px;
                                                                                border-radius: 50%;
                                                                                background-color: #cecbcb;
                                                                                background-image: url({{ asset('storage/files/' . ($setting->footer_logo ?? 'default.png')) }});
                                                                                background-repeat: no-repeat;
                                                                                background-size: cover;
                                                                                background-position: center;
                                                                                " />
                                                                            </div>
                                                                        </div>
                                                                        <script>
                                                                            var loadFile_image1 = function(image1) {
                                                                                var image1 = document.getElementById('output_footer_logo');
                                                                                var src1 = URL.createObjectURL(event.target.files[0]);
                                                                                image1.style.backgroundImage = 'url(' + src1 + ')';
                                                                            };
                                                                        </script>

                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="">{{ __('dash.store_name') }}</label>
                                                                                <input type="text" name="store_name"
                                                                                    class="form-control"
                                                                                    value="{{ old('store_name', $setting->store_name ?? '') }} ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="">{{ __('dash.store_name_en') }}</label>
                                                                                <input type="text" name="store_name_en"
                                                                                    class="form-control"
                                                                                    value="{{ old('store_name_en', $setting->store_name_en ?? '') }} ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="">{{ __('dash.Default Currency ') }}</label>
                                                                                <select name="currency_id" id=""
                                                                                    class="form-control select2">
                                                                                    <option value="">
                                                                                        {{ __('dash.Select Default Currency') }}
                                                                                    </option>
                                                                                    @foreach ($currencies as $currency)
                                                                                        <option
                                                                                            {{ isset($setting->currency_id) && $setting->currency_id == $currency->id ? 'selected' : '' }}
                                                                                            value="{{ $currency->id }}">
                                                                                            {{ $currency->symbol }} :
                                                                                            {{ $currency->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="">{{ __('dash.Timezone') }}</label>
                                                                                <select name="timezone" id=""
                                                                                    class="form-control select2">

                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="maintenance_mode"
                                                                                    class="mr-3">{{ __('dash.Maintenance Mode') }}</label>
                                                                                @if (isset($setting->currency_id) && $setting->maintenance_mode == 1)
                                                                                    <input type="checkbox" checked
                                                                                        name="maintenance_mode"
                                                                                        value="1"
                                                                                        id="maintenance_mode">
                                                                                @else
                                                                                    <input type="checkbox"
                                                                                        name="maintenance_mode"
                                                                                        value="1"
                                                                                        id="maintenance_mode">
                                                                                @endif

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">

                                                                            <button class="btn btn-primary"
                                                                                type="submit">{{ __('dash.Update') }}</button>
                                                                        </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="tab-pane fade" id="logoTab" role="tabpanel"
                                                        aria-labelledby="logo-tab">
                                                        <div class="card m-0">
                                                            <div class="card-body">
                                                                <form action=" " method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')



                                                                    <button
                                                                        class="btn btn-primary">{{ __('dash.Update') }}</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- <div class="tab-pane fade" id="recaptchaTab" role="tabpanel" aria-labelledby="recaptcha-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-google-recaptcha') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Allow Recaptcha')}}</label>
                                                                <select name="allow" id="allow" class="form-control">
                                                                    <option {{ $googleRecaptcha->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Enable')}}</option>
                                                                    <option {{ $googleRecaptcha->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Disable')}}</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Captcha Site Key')}}</label>
                                                                <input type="text" class="form-control" name="site_key" value="{{ $googleRecaptcha->site_key }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Captcha Secret Key')}}</label>
                                                                <input type="text" class="form-control" name="secret_key" value="{{ $googleRecaptcha->secret_key }}">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="tab-pane fade" id="customPaginationTab" role="tabpanel" aria-labelledby="custom-pagination-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-custom-pagination') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="50%">{{__('admin.Section Name')}}</th>
                                                                        <th width="50%">{{__('admin.Quantity')}}</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($customPaginations as $customPagination)
                                                                    <tr>
                                                                        <td>{{ $customPagination->page_name }}</td>
                                                                        <td>
                                                                            <input type="number" value="{{ $customPagination->qty }}" name="quantities[]" class="form-control">
                                                                            <input type="hidden" value="{{ $customPagination->id }}" name="ids[]">
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>


                                                            </table>
                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="socialLoginTab" role="tabpanel" aria-labelledby="social-login-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.update-social-login') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Allow Login with Gmail')}}</label>
                                                                <div>
                                                                    @if ($socialLogin->is_gmail == 1)
                                                                    <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_gmail_login">
                                                                    @else
                                                                    <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Enable')}}" data-off="{{__('admin.Disable')}}" data-onstyle="success" data-offstyle="danger" name="allow_gmail_login">
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Gmail Client Id')}}</label>
                                                                <input type="text" value="{{ $socialLogin->gmail_client_id }}" class="form-control" name="gmail_client_id">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Gmail Secret Id')}}</label>
                                                                <input type="text" value="{{ $socialLogin->gmail_secret_id }}" class="form-control" name="gmail_secret_id">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">{{__('admin.Gmail Redirect Url')}}</label>
                                                                <input type="text" value="{{ $socialLogin->gmail_redirect_url }}" class="form-control" name="gmail_redirect_url">
                                                            </div>

                                                            <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div> --}}


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </section>
    </div>
@endsection
