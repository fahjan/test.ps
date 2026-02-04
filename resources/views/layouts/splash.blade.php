<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>test.ps - تست</title>
        <meta name="description" content="موقع الكتروني مساند يختص بمساعدة طلاب مدارس قيادة السيارات، حيث يقدم الشروحات، الاسئلة والاختبارات النظرية لسلطة الترخيص بعدد لا نهائي من نماذج الاختبارات والتي تساعد المتدرب على اجتياز الامتحان النظري. كما يحتوي الموقع على نظام تفاعلي متخصص في التدريب بحيث تبقى المتابعة مستمرة، من قبل مدرب النظري يحتوي أيضا على مجموعة مميزة من الالعاب التفاعلية التعليمية المختصة بتعليم الاشارات. يقدم موقع تيست أربع أنواع للمستخدمين هم الزوار، المشتركين، المدربين والمدارس">
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css" integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
        <link href="//fonts.googleapis.com/earlyaccess/droidarabicnaskh.css" rel="stylesheet" type="text/css">
        <link href="//fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}" crossorigin="anonymous">
        <meta property="og:image" content="{{asset('assets/img/logo.png')}}">
        <link rel="icon" href="{{asset('assets/img/logo.png')}}">
    </head>
    <body>

        @yield('content')
         {{-- <div class="main">
            <div class="col-md-6 col-sm-12">

            
            </div>
         </div>
         <div class="sidenav bg-golden">

            <div class="login-main-text">
                <img src="{{asset('assets/img/logo.png')}}" style="width: 10%; ">
                <br><br>
                <h1> تسجيل الدخول</h1>
                <h5>سجل دخولك الآن، وانطلق ...</h5>
                <div style="position: absolute; bottom: 50px">
                    <h5>قيادة السيارة تبدأ من هنا ... </h5>
                    <img src="{{asset('assets/img/street.logo.png')}}" style="width: 40%; ">
                    <div>
                        
                        <a href="" class="white">من نحن</a> |
                        <a href="" class="white">المدارس</a> |
                        <a href="" class="white">الطلاب</a> |
                        <a href="" class="white">تست</a>
                    </div>
                </div>
               
            </div>
         </div> --}}
        
    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> --}}
<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js" integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous"></script>

</html>
