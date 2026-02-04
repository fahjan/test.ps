<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>test.ps - تست</title>
    <meta name="description"
        content="موقع الكتروني مساند يختص بمساعدة طلاب مدارس قيادة السيارات، حيث يقدم الشروحات، الاسئلة والاختبارات النظرية لسلطة الترخيص بعدد لا نهائي من نماذج الاختبارات والتي تساعد المتدرب على اجتياز الامتحان النظري. كما يحتوي الموقع على نظام تفاعلي متخصص في التدريب بحيث تبقى المتابعة مستمرة، من قبل مدرب النظري يحتوي أيضا على مجموعة مميزة من الالعاب التفاعلية التعليمية المختصة بتعليم الاشارات. يقدم موقع تيست أربع أنواع للمستخدمين هم الزوار، المشتركين، المدربين والمدارس">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" crossorigin="anonymous">
    <meta property="og:image" content="{{asset('assets/img/logo.png')}}">
    <link rel="icon" href="{{asset('assets/img/logo.png')}}">
</head>

<body>



    <div class="sidenav bg-golden">

        <div class="login-main-text">
            <a href="{{ route('login') }}">
                <img src="{{asset('assets/img/logo.png')}}" style="width: 20%;">
            </a>
            <br><br>
            <h1> تسجيل الدخول</h1>
            <h5>سجل دخولك الآن، وانطلق ...</h5>
            <div style="position: absolute; bottom: 50px" class="d-none d-lg-block">
                <h5>قيادة السيارة تبدأ من هنا ... </h5>
                <img src="{{asset('assets/img/street.logo.png')}}" style="width: 40%; ">
                <div>

                    <a href="{{ route('about') }}" class="white">{{__('About')}}</a> |
                    <a href="{{ route('privacy') }}" class="white">{{ __('Privacy') }}</a> |
                    <a href="{{ route('user-policy') }}" class="white">{{__('User policy')}}</a> |
                    {{-- <a href="//schools" class="white">المدارس</a> | --}}
                    {{-- <a href="" class="white">الطلاب</a> | --}}
                    <a href="{{ route('home') }}" class="white">{{ __('test.ps')  }}</a>
                </div>
            </div>

        </div>
    </div>
    <div class="main">
        <div class="col">

            @yield('content')
        </div>

    </div>


</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>

</html>