
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="icon" type="image/x-icon" href="{{ asset('store_front/images/load.ico')}}">


    <link href="{{ asset('store_front/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('store_front/css/bootstrap.rtl.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('store_front/bootstrap-icons-1.9.1/bootstrap-icons.css')}}">
    <link href="{{ asset('store_front/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('store_front/css/owl.theme.default.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

    <link href="{{ asset('store_front/css/style.css')}}" rel="stylesheet">
</head>
<body dir="rtl">
    <div id="load_screen"><!--inide body dircte-->
        <div id="loading"><img src="images/load.png" class="loader" style="width:120px;height:120px;" /></div>
    </div>
    <header>
      <style>
        html {
                overflow: hidden;

            }
      </style>
        <script>
            //always in header
            window.addEventListener("load", function() {
                var load_screen = document.getElementById("load_screen");
                document.body.removeChild(load_screen);
                $("html").css({
                    'overflow': 'auto'
                });
            });
        </script>

        <div class="mobile-nav d-lg-none d-flex justify-content-between align-items-center">
            <button class="btn btn-open-menu bi bi-list"></button>
            <div>
              <a href="#" class="position-relative">
                <span class="btn bi bi-cart"></span>
                <span class="notifications-number   badge rounded-pill">2</span>
              </a>
              <a href="#" class="position-relative">
                <span class="btn bi bi-heart"></span>
                <span class="notifications-number   badge rounded-pill">2</span>
              </a>
              <a href="#">
                <span class="btn bi bi-person"></span>
              </a>
            </div>

        </div>
    <nav class="border-bottom header-first">
    <div class="container d-flex flex-wrap">
      <ul class="nav ms-auto d-flex align-items-center ms-sm-0 me-auto">


        <li class="nav-item"><a href="#" class="nav-link px-2" aria-current="page">
                <span class="bi bi-truck me-2"></span>
                تتبع الطلب
        </a></li>
        <li class="nav-item socials-icons d-flex">
                <a class="bi bi-facebook"></a>
                <a class="bi bi-instagram"></a>
                <a class="bi bi-whatsapp"></a>

        </li>
       <li class="nav-item dropdown">
                <button class="btn border-0 dropdown-toggle" type="button">
                    دينار كويتي
                </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
        </li>
       </ul>
       @guest
        <ul class="nav me-sm-0 me-auto">
            <li class="nav-item"><a href="{{route('agent.login',$data->slug)}}" class="nav-link  px-2">تسجيل دخول</a></li>
            <li class="nav-item"><a href="{{route('agent.register',$data->slug)}}" class="nav-link  px-2">الاشتراك</a></li>
        </ul>
       @endguest

    </div>
  </nav>
<div class="container header-second d-lg-flex justify-content-between align-items-center py-3">

<div class="px-4 text-center py-4 py-lg-0"><img src="images/logo.png" alt=""></div>

<div class="d-none d-lg-block flex-fill px-4 py-4 py-lg-0">
    <div class="btn-group w-100">
    <button type="button" class="btn btn-search bi bi-search border border-end-0 rounded-0 rounded-start"></button>
    <input type="search" class="form-control rounded-0 rounded-end border border-start-0" aria-label="search" aria-describedby="search">
</div>
</div>

<div class="d-none d-lg-flex justify-content-center justify-content-lg-end overflow-auto">
    <a href="{{route('agent.dashboard',$data->slug)}}" class="a-header-circles" >
    <div class="div-header-circles me-2">
    <span class="bi bi-person-fill"></span>
    </div>
    <span>حسابي</span>
    </a>
    <a href="" class="a-header-circles" >
        <div class="div-header-circles me-2 pt-1">
            <span class="notifications-number top-0 start-100 badge rounded-pill">2</span>
        <span class="bi bi-heart-fill"></span>
        </div>
        <span>المفضلة : </span>
        <span> 350,000 </span>
        <span> د.ك </span>
        </a>
        <a href="{{route('cart.index',$data->slug)}}" class="a-header-circles" >
            <div class="div-header-circles cart-header-circles me-2 pt-1">
                <span class="notifications-number top-0 start-100 badge rounded-pill">2</span>
            <span class="bi bi-cart-fill"></span>
            </div>
            <span>السلة : </span>
            <span> 350,000 </span>
            <span> د.ك </span>
            </a>
</div>

</div>
<div class="overlay-close"></div>
<div class="header-third px-0 py-3 mobile-menu-body ">
    <div  class="container">
<nav class="navbar navbar-expand-lg container p-0">
    <div class="container-fluid collapse navbar-collapse">
      <div class="mobile-menu-header">
        <img src="images/load.png" width="40px" height="40px" alt="">
        <button class="bi bi-x btn-close-menu"></button>
      </div>
        <div class="btn-group w-100 d-flex d-lg-none">
        <button type="button" class="btn btn-search bi bi-search border border-end-0 rounded-0 rounded-start"></button>
        <input type="search" class="form-control rounded-0 rounded-end border border-start-0" aria-label="search" aria-describedby="search">
        </div>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">الرئيسية</a>
          </li>

          @foreach ($data->categories()->main()->active()->get() as $category )
          @if ($category->categories()->count() == 0)
            <li class="nav-item">
                <a class="nav-link" href="#">{{$category->name}} </a>
            </li>
          @else
           <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
                {{$category->name}}            </a>
            <ul class="dropdown-menu">
                @foreach ($category->categories as $sub_categ)
                 <li><a class="dropdown-item" href="#">{{$sub_categ->name}}</a></li>
                @endforeach
            </ul>
          </li>
          @endif
          @endforeach

        </ul>

    </div>
  </nav>
</div>
</div>
</header>

    @yield('content')

<footer class="container">
    <div class="py-5">
        <div class="row">
          <div class="col-6 col-md-2 mb-3">
            <h5>الأقسام</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الألواح
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الأجهزة
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الكشافات</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الإنارات</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الحوالات</a></li>
            </ul>
          </div>

          <div class="col-6 col-md-3 mb-3">
            <h5>روابط هامة</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الأسئلة الشائعة
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الاشتراك
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الدخول
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">من نحن
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">سياسة الخصوصية
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الشحن والاستلام
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">الشروط والأحكام</a></li>

            </ul>
          </div>

          <div class="col-6 col-md-3 mb-3">
            <h5>الاتصال بنا</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">فرع القرين
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">فرع الجهراء
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">فرع المنقف
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">تليفون: 96566709946
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">أوقات العمل: 6 Am الي 10 Pm
            </a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">البريد الإلكتروني: </a></li>

            </ul>
          </div>

          <div class="col-md-4 mb-3">
            <form>
              <h5>اشتراك النشرة البريدية</h5>

              <div class="d-flex w-100">
                <label for="newsletter1" class="visually-hidden"></label>
                <input id="newsletter1" type="text" class="form-control border-0" placeholder="أدخل البريد الإلكتروني">
                <button class="btn border-0 btn-subscribe" type="button">أشترك الآن</button>
              </div>
              <hr class="hr-blue">
            </form>
        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4">
          <p>جميع الحقوق المحفوظة</p>
          <div class="socials-icons d-flex">
            <a class="bi bi-facebook"></a>
            <a class="bi bi-instagram"></a>
            <a class="bi bi-whatsapp"></a>
        </div>
        </div>
          </div>
        </div>


      </div>
</footer>


<script src="{{ asset('store_front/js/jquery-3.6.1.min.js')}}"></script>
<script src="{{ asset('store_front/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('store_front/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('store_front/js/popper.min.js')}}"></script>
<script src="{{ asset('store_front/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('store_front/js/script.js')}}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/js/modules-toastr.js') }}"></script>
@stack('js')

<script>
    @if (Session::has('messege'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('messege') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('messege') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('messege') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('messege') }}");
                break;
        }
    @endif
</script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif
</body>
</html>
