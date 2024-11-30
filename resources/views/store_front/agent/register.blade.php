@extends('store_front.master', ['data' => $data])
@section('title')
    <title>{{ $data->setting->store_name }}</title>
@endsection
@section('content')
    <main>


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


        <section class="container section-creat-account">
            <div class="row">
                <p class="h4">إنشاء حساب</p>
                <div class="col-md-4 m-auto my-5">
                    <form action="{{route('agent.register',$data->slug)}}" method="POST">
                        @csrf
                    <div class="mb-3">
                        <label for="user-email" class="form-label"> البريد الالكتروني</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control"
                            id="user-email">
                    </div>

                    <div class="mb-3">
                        <label for="user-name" class="form-label">الاسم</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            id="user-name">
                    </div>

                    <div class="mb-3">
                        <label for="user-mobile" class="form-label">رقم الموبايل</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                            id="user-mobile">
                    </div>
                    <div class="mb-3">
                        <label for="user-password" class="form-label">كلمة المرور</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-eye bi bi-eye"></button>
                            <input type="password" name="password" class="form-control" required aria-label="user-password"
                                aria-describedby="user-password">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="user-password" class="form-label">تأكيد كلمة المرور</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-eye bi bi-eye"></button>
                            <input type="password" name="password_confirmation" required class="form-control" aria-label="user-password"
                                aria-describedby="user-password">
                        </div>
                    </div>

                    <div class="mb-3">

                        <input type="submit" class="btn btn-warning w-100 btn-create-acount my-4 text-light"
                            value="إشاء حساب">
                        <div class="or"><span>أو</span></div>
                        <div class="text-center">
                            <a href="" class="my-4 d-block">العودة لصفحة تسجيل الدخول</a>
                            <p>من خلال التسجيل لإنشاء حساب أنا أقبل
                                الشروط والأحكام</p>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </section>


    </main>
@endsection
