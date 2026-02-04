@extends('layouts.app')

@section('content')
    <div class="container-fluid p-0">
        <!-- Hero Section -->
        <section class="hero -bg-golden -text-white text-center py-5">
            <div class="container">
                <h1 class="display-4 fw-bold">مرحباً بك في test.ps</h1>
                <h2 class="h4 mb-3">قيادة السيارة تبدأ من هنا</h2>
                <p class="lead">موقعك المساند لتعلم الجانب النظري لقيادة السيارات. احصل على شروحات شاملة، اختبارات لا
                    نهائية، وألعاب تفاعلية للإشارات المرورية.</p>
                <a href="{{ route('login') }}" class="btn btn-black btn-lg">ابدأ الآن</a>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-5 bg-white">
            <div class="container">
                <h2 class="text-center mb-5">ميزات الموقع</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-book fs-1 mb-3" style="color: goldenrod;"></i>
                                <h5 class="card-title">شروحات شاملة</h5>
                                <p class="card-text">تعلم الجانب النظري لقيادة السيارات من خلال شروحات مفصلة وسهلة الفهم.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-check-circle fs-1 mb-3" style="color: green;"></i>
                                <h5 class="card-title">اختبارات لا نهائية</h5>
                                <p class="card-text">جرب نفسك بآلاف الأسئلة والاختبارات النظرية لسلطة الترخيص.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-controller fs-1 mb-3" style="color: orange;"></i>
                                <h5 class="card-title">ألعاب تفاعلية</h5>
                                <p class="card-text">استمتع بألعاب تعليمية مخصصة لتعلم الإشارات المرورية بطريقة ممتعة.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>لماذا test.ps؟</h2>
                        <p>نحن نقدم نظاماً تفاعلياً متخصصاً في التدريب النظري، مع متابعة مستمرة من قبل مدربين محترفين. سواء
                            كنت زائراً، مشتركاً، مدرباً، أو مدرسة، لدينا ما يناسبك.</p>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check text-success me-2"></i>شروحات مبسطة ومفصلة</li>
                            <li><i class="bi bi-check text-success me-2"></i>اختبارات متنوعة ولا نهائية</li>
                            <li><i class="bi bi-check text-success me-2"></i>ألعاب تعليمية تفاعلية</li>
                            <li><i class="bi bi-check text-success me-2"></i>متابعة من مدربين متخصصين</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-golden text-white text-center py-5">
            <div class="container">
                <h2>انطلق في رحلتك التعليمية الآن!</h2>
                <p class="lead">سجل الآن وابدأ في تعلم قيادة السيارات بطريقة احترافية.</p>
                <a href="{{ route('login') }}" class="btn btn-black btn-lg">سجل الدخول</a>
            </div>
        </section>
    </div>
@endsection