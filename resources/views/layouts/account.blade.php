<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() == 'en' ? 'ltr' : 'rtl'}}">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Test.ps - تست لتعليم قيادة السيارات </title>
	<meta name="description"
		content="موقع الكتروني مساند يختص بمساعدة طلاب مدارس قيادة السيارات، حيث يقدم الشروحات، الاسئلة والاختبارات النظرية لسلطة الترخيص بعدد لا نهائي من نماذج الاختبارات والتي تساعد المتدرب على اجتياز الامتحان النظري. كما يحتوي الموقع على نظام تفاعلي متخصص في التدريب بحيث تبقى المتابعة مستمرة، من قبل مدرب النظري يحتوي أيضا على مجموعة مميزة من الالعاب التفاعلية التعليمية المختصة بتعليم الاشارات. يقدم موقع تيست أربع أنواع للمستخدمين هم الزوار، المشتركين، المدربين والمدارس">
	<meta name="author" content="space.ps Team">
	<meta name="keywords" content="">
	<meta name="author" content="space.ps Team">
	<meta name="googlebot" content="index,follow">
	<meta property="og:image" content="{{asset('assets/img/logo.png')}}">
	<link rel="icon" href="{{asset('assets/img/logo.png')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
		name='viewport' />

	<!--     Fonts and icons     -->
	{{--
	<link href="//fonts.googleapis.com/earlyaccess/droidarabicnaskh.css" rel="stylesheet" type="text/css"> --}}
	<link href="//fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet" type="text/css">


	<!-- CSS Files -->
	{{--
	<link href="{{asset('assets/account/css/bootstrap-rtl.css')}}" rel="stylesheet" /> --}}
	{{--
	<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
		integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
	--}}
	<link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
		integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">
	{{--
	<link rel="stylesheet" href="https://unpkg.com/@laylazi/bootstrap-rtl@4.5.3-1/dist/css/bootstrap-rtl.min.css"> --}}
	{{--
	<link rel="stylesheet" href="https://unpkg.com/@laylazi/bootstrap-rtl@4.5.3-1/dist/css/bootstrap-grid-rtl.min.css">
	--}}

	<link href="{{asset('assets/account/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	{{--
	<link href="{{asset('assets/account/demo/demo.css')}}" rel="stylesheet" /> --}}
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
		integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	{{--
	<link href="{{asset('css/style.css')}}" rel="stylesheet" /> --}}
	<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
		rel="stylesheet" type="text/css" />

	<style>
		html,
		body,
		*,
		button,
		input,
		optgroup,
		select,
		textarea {
			font-family: "Droid Arabic Kufi";
		}

		.sidebar .nav li>a,
		.off-canvas-sidebar .nav li>a {
			font-size: 1.4em !important;
		}

		button,
		input,
		optgroup,
		select,
		textarea {
			font-family: "Droid Arabic Kufi" !important;
		}

		.table>thead>tr>th {
			font-size: 12px !important;
		}
	</style>
	@yield('css')
	<script src="{{asset('assets/account/js/core/jquery.min.js')}}"></script>
	<script src="{{asset('assets/account/js/core/popper.min.js')}}"></script>
	{{--
	<script src="{{asset('assets/account/js/core/bootstrap-rtl.js')}}"></script> --}}
	<script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>


</head>

<body class="user-profile rtl -sidebar-mini rtl-active">
	<div class="wrapper ">
		<div class="sidebar" data-color="yellow">
			<!--
		Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
	-->
			<div class="logo">
				<a href="{{url('account')}}" class="simple-text logo-mini">
					<img src="{{asset('assets/img/logo.png')}}" class="img-thumbnail" width="50">
				</a>
				<a href="{{url('account')}}" class="simple-text logo-normal">
					{{auth()->user()->name}}
				</a>
			</div>
			<div class="sidebar-wrapper">
				<ul class="nav">
					<li class="d-none">
						<a href="./dashboard.html">
							<i class="now-ui-icons design_app"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="d-none">
						<a href="./icons.html">
							<i class="now-ui-icons education_atom"></i>
							<p>Icons</p>
						</a>
					</li>
					<li class="d-none">
						<a href="./map.html">
							<i class="now-ui-icons location_map-big"></i>
							<p>Maps</p>
						</a>
					</li>
					<li class="d-none">
						<a href="./notifications.html">
							<i class="now-ui-icons ui-1_bell-53"></i>
							<p>Notifications</p>
						</a>
					</li>

					@if(Session::has('original_user_id'))
						<li>
							<i class="fa fa-back"></i>
							<a href="{{ route('login-back') }}" class="btn btn-danger">Back to Admin</a>
						</li>
					@endif

					@hasrole('manager')
					<li class="{{Request::is('*/manager/school*') ? 'active' : ''}}">
						<a href="{{route('manager.school.index')}}">
							<i class="fa fa-school"></i>
							<p>{{(__('public.school'))}} </p>
						</a>
					</li>
					<li class="{{Request::is('*/manager/students*') ? 'active' : ''}}">
						<a href="{{route('manager.students.index')}}">
							<i class="now-ui-icons users_single-02"></i>
							<p>{{(__('public.students'))}}</p>
						</a>
					</li>
					<li class="{{Request::is('*/manager/cars*') ? 'active' : ''}}">
						<a href="{{route('manager.cars.index')}}">
							<i class="fa fa-car"></i>
							<p>{{(__('public.cars'))}} </p>
						</a>
					</li>

					<li class="{{Request::is('*/manager/trainers*') ? 'active' : ''}}">
						<a href="{{route('manager.trainers.index')}}">
							<i class="fa fa-chalkboard-teacher"></i>
							<p>{{(__('public.trainers'))}} </p>
						</a>
					</li>

					<li class="{{Request::is('*/manager/messages*') ? 'active' : ''}}">
						<a href="{{route('manager.messages.index')}}">
							<i class="fa fa-envelope-open"></i>
							<p>{{(__('public.sms'))}} </p>
						</a>
					</li>

					{{-- <li class="{{Request::is('*/manager/students*') ? 'active' : ''}}">
						<a href="{{route('manager.students.index')}}?active">
							<i class="fa fa-chalkboard-teacher"></i>
							<p>{{(__('public.active_students'))}}</p>
						</a>
					</li> --}}
					@endhasrole


					@hasrole('admin')


					<li class="{{Request::is('*/admin/students*') ? 'active' : ''}}">
						<a href="{{route('admin.students.index')}}">
							<i class="fa fa-users"></i>
							<p>{{(__('public.students'))}} </p>
						</a>
					</li>

					<li class="{{Request::is('*/admin/trainers*') ? 'active' : ''}}">
						<a href="{{route('admin.trainers.index')}}">
							<i class="fa fa-chalkboard-teacher"></i>
							<p>{{(__('public.trainers'))}} </p>
						</a>
					</li>
					<li class="{{Request::is('*/admin/cars*') ? 'active' : ''}}">
						<a href="{{route('admin.cars.index')}}">
							<i class="fa fa-car"></i>
							<p>{{(__('public.cars'))}} </p>
						</a>
					</li>

					<li class="{{Request::is('*/admin/schools*') ? 'active' : ''}}">
						<a href="{{route('admin.schools.index')}}">
							<i class="fa fa-school"></i>
							<p>{{(__('public.schools'))}} </p>
						</a>
					</li>


					<li class="{{Request::is('*/admin/managers*') ? 'active' : ''}}">
						<a href="{{route('admin.managers.index')}}">
							<i class="fa fa-user-shield"></i>
							<p>{{(__('public.managers'))}} </p>
						</a>
					</li>

					<li class="{{Request::is('*/admin/lessons*') ? 'active' : ''}}">
						<a href="{{route('admin.lessons.index')}}">
							<i class="fa fa-user-shield"></i>
							<p>{{(__('public.lessons'))}} </p>
						</a>
					</li>

					<li class="{{Request::is('*/admin/payments*') ? 'active' : ''}}">
						<a href="{{route('admin.payments.index')}}">
							<i class="fa fa-user-shield"></i>
							<p>{{(__('public.payments'))}} </p>
						</a>
					</li>

					@endhasrole
					@hasrole('student')
					<li class="{{Request::is('*/student/exams*') ? 'active' : ''}}">
						<a href="{{route('student.exams.index')}}">
							<i class="fa fa-question-circle"></i>
							<p>{{(__('public.exams'))}}</p>
						</a>
					</li>
					@endhasrole

					<li class="{{Request::is('*/account/questions*') ? 'active' : ''}}">
						<a href="{{route('account.questions.index')}}">
							<i class="fa fa-box"></i>
							<p>{{(__('بنك الأسئلة'))}} </p>
						</a>
					</li>

					<li class="{{Request::is('*/account/signs*') ? 'active' : ''}}">
						<a href="{{route('account.signs.index')}}">
							<i class="fa fa-traffic-light"></i>
							<p>{{(__('public.signs'))}} </p>
						</a>
					</li>

					<li class="d-none">
						<a href="./typography.html">
							<i class="now-ui-icons text_caps-small"></i>
							<p>fffff</p>
						</a>
					</li>

				</ul>
			</div>
		</div>
		<div class="main-panel">
			<!-- Navbar -->
			<nav class="navbar navbar-expand-lg -fixed-top navbar-transparent  bg-primary  navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-wrapper">
						<div class="navbar-toggle">
							<button type="button" class="navbar-toggler">
								<span class="navbar-toggler-bar bar1"></span>
								<span class="navbar-toggler-bar bar2"></span>
								<span class="navbar-toggler-bar bar3"></span>
							</button>
						</div>
						<a class="navbar-brand" href="#pablo"></a>
					</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
						aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-bar navbar-kebab"></span>
						<span class="navbar-toggler-bar navbar-kebab"></span>
						<span class="navbar-toggler-bar navbar-kebab"></span>
					</button>

					<div class="collapse navbar-collapse -justify-content-end" id="navigation">
						<ul class="navbar-nav">
							@hasrole('admin')
							<li class="nav-item -d-none">
								<div class="dropdown">
									<a href="#" class="nav-link dropdown-toggle" type="button" id="dropdownMenu3"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-cog"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right -dropright"
										aria-labelledby="dropdownMenu3">
										<a class="dropdown-item" href="{{route('admin.licenses.index')}}"><i
												class="fa fa-id-badge"></i> {{(__('public.licenses'))}}</a>
										<a class="dropdown-item" href="{{route('admin.jobs.index')}}"><i
												class="fa fa-briefcase"></i> {{(__('public.jobs'))}} </a>
										<a class="dropdown-item" href="{{route('admin.cities.index')}}"><i
												class="fa fa-city"></i> {{(__('public.cities'))}} </a>
										<a class="dropdown-item" href="{{route('admin.examiners.index')}}"><i
												class="fa fa-diagnoses"></i> {{(__('public.examiners'))}} </a>
										<a class="dropdown-item" href="{{route('admin.kinds.index')}}"><i
												class="fa fa-dollar-sign"></i> {{(__('public.payments_kinds'))}} </a>
									</div>
								</div>
							</li>
							@endhasrole
							<li>

								<div class="dropdown">
									<a href="#" class="nav-link dropdown-toggle" type="button" id="dropdownMenu2"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-user"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right -dropright"
										aria-labelledby="dropdownMenu2">
										<a class="dropdown-item"
											href="{{route('account.profile.index')}}">{{__('public.account')}}</a>
										<a class="dropdown-item"
											href="{{ route('logout') }}">{{__('public.logout')}}</a>
									</div>
								</div>
							</li>


						</ul>

						<form action="{{ route('manager.students.index') }}" method="get">

							<div class="input-group no-border">
								{{-- <div class="input-group-append">
									<div class="input-group-text">
										<i class="now-ui-icons ui-1_zoom-bold"></i>
									</div>
								</div> --}}
								@hasrole('manager')
								<input type="text" name="family_name" value="{{request('family_name')}}"
									class="form-control" placeholder="{{__('public.family_name')}}...">
								@endhasrole
							</div>
						</form>

					</div>
				</div>
			</nav>
			<!-- End Navbar -->
			<div class="panel-header panel-header-sm">
			</div>
			<div class="content">
				@yield('content')
			</div>
			<footer class="footer -d-none">
				<div class="container">
					{{-- <nav>
						<ul>
							<li>
								<a href="https://www.space.ps">
									Creative Tim
								</a>
							</li>
							<li>
								<a href="http://space.ps">
									About Us
								</a>
							</li>
							<li>
								<a href="http://space.ps">
									Blog
								</a>
							</li>
						</ul>
					</nav> --}}
					<div class="copyright" id="copyright">
						&copy; 2015 - {{date('Y')}}
						<script>
							// document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
						</script>, برمجة وتطوير
						<a href="https://www.space.ps" target="_blank">www.space.ps</a>
						-
						<div>{{ (microtime(true) - LARAVEL_START) }}</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<!--   Core JS Files   -->
	<script src="{{asset('assets/account/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
	<!-- Chart JS -->
	{{--
	<script src="{{asset('assets/account/js/plugins/chartjs.min.js')}}"></script> --}}
	<!--  Notifications Plugin    -->
	<script src="{{asset('assets/account/js/plugins/bootstrap-notify.js')}}"></script>
	<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
	<script src="{{asset('assets/account/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script>
	<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
	{{--
	<script src="{{asset('assets/account/demo/demo.js')}}"></script> --}}
	<script src="{{asset('assets/account/js/plugins/sweetalert2.min.js')}}"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
		type="text/javascript"></script>

	<script>
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			// startDate: '-3d'
		});
		$(document).ready(function () {
			$("input:text").focus(function () { $(this).select(); });
		});
	</script>


	@yield('js')

</body>

</html>