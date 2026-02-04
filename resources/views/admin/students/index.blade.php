@extends('layouts.account')

@section('content')


	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					حالة الدفعة
					<a href="{{url('admin/students?paid_status=new')}}">@if($paid_status == '&paid_status=new') <i
					class="fa fa-check"></i> @endif جديد</a> |
					<a href="{{url('admin/students?paid_status=gift')}}">@if($paid_status == '&paid_status=gift') <i
					class="fa fa-check"></i> @endif هدية</a> |
					<a href="{{url('admin/students?paid_status=paid')}}">@if($paid_status == '&paid_status=paid') <i
					class="fa fa-check"></i> @endif مدفوع</a> |
					<a href="{{url('admin/students?paid_status=free')}}">@if($paid_status == '&paid_status=free') <i
					class="fa fa-check"></i> @endif مجاني</a> |
					<a href="{{url('admin/students?paid_status=test')}}">@if($paid_status == '&paid_status=test') <i
					class="fa fa-check"></i> @endif تجريبي</a> |
					<a href="{{url('admin/students?paid_status=alternative')}}">@if($paid_status == '&paid_status=alternative')
					<i class="fa fa-check"></i> @endif بديل</a> |
					<a href="{{url('admin/students?paid_status=no_app')}}">@if($paid_status == '&paid_status=no_app') <i
					class="fa fa-check"></i> @endif بدون تطبيق</a>
				</div>

				<div class="card-title">
					حساب التطبيق
					<a href="{{url('admin/students?use_app=yes' . $paid_status)}}">@if($use_app == '&use_app=yes') <i
					class="fa fa-check"></i> @endif نعم</a> |
					<a href="{{url('admin/students?use_app=no' . $paid_status)}}">@if($use_app == '&use_app=no') <i
					class="fa fa-check"></i> @endif لا</a>
				</div>


				<div class="card-title">
					المدرسة
					@foreach($schools as $school)
						<a href="{{url('admin/students?school_id=' . $school->id . $use_app . $paid_status)}}">@if($school_id == '&school_id=' . $school->id)
						<i class="fa fa-check"></i> @endif {{ $school->title }}</a> |


					@endforeach
				</div>


			</div>

		</div>

		<div class="card">
			<div class="card-header">
				<h4 class="card-title float-left"> {{__('public.students')}}: {{$objects->total()}}</h4>
				<a href="{{route($route . 'create')}}" class="btn btn-success d-none">
					<i class="fa fa-plus"></i>
				</a>
				{{-- <div class="float-right">
					<form action="{{ route($route . 'index') }}" method="get">

						<div class="input-group no-border">
							<input type="text" name="s" value="{{ old('s', request('s')) }}" placeholder=""
								class="form-control">
							<div class="input-group-append">
								<button type="submit" class="input-group-text">
									<i class="now-ui-icons ui-1_zoom-bold"></i>
								</button>
							</div>


					</form>
				</div> --}}
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive ">
				<form action="{{ route($route . 'update', '1') }}" method="post">
					@method('put')
					@csrf

					<table class="table table-striped -table-dark table-hover ">
						<thead class=" text-warning">
							<th></th>
							<th>{{-- @sortablelink('title', __('public.title')) --}}</th>
							<th></th>
						</thead>
						<tbody>
							@foreach($objects as $object)
								<tr>
									<td>
										<label for="ids_{{$object->id}}">
											{{-- <img src="{{$object->photo_url}}" class="-avatar"> --}}
										</label>
									</td>
									<td>


										<label for="ids_{{$object->id}}">
											<input type="checkbox" name="ids[]" value="{{ $object->id }}"
												id="ids_{{$object->id}}">
											{{$object->number}}</b>&nbsp;-&nbsp;
											<b>{{$object->first_name}} {{$object->father_name}} {{$object->gfather_name}}
												{{$object->family_name}}</b>
										</label>

										<div class="badge badge-warning"><i class="fa fa-clock"> </i> {{$object->created}}</div>
										<label>{{__('public.' . $object->paid_status)}}</label>
										<small>

											<div class="progress">
												@php
													$percent = $object->percent;
												@endphp
												<div class="progress-bar" role="progressbar" style="width: {{$percent}}%;"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
													{{round($percent)}}%
												</div>
											</div>
										</small>
										<br>
										<small>
											<p class="badge badge-warning">{{$object->school->title ?? ''}}</p>
											<p class="badge badge-default"><i class="fa fa-user"></i>
												{{$object->creator->name ?? ''}}</p> - {{$object->school->address}}
										</small>

										<br>
										<a href="tel: {{$object->user->mobile}}">{{$object->user->mobile}}</a>

									</td>


									<td class="text-right">

										<a href="{{route('login-as', ['id' => $object->user->id])}}">تسجيل
											دخول</a>
										<a href="{{route($route . 'edit', $object->id)}}" class="btn btn-info d-none"><i
												class="fa fa-edit">
												{{__('public.edit')}}</i></a>

									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="card-header">

						<div class="card-title">
							<label> <input type="radio" name="new_paid_status" value="new"> جديد </label>
							<label> <input type="radio" name="new_paid_status" value="gift"> هدية </label>
							<label> <input type="radio" name="new_paid_status" value="paid" checked="true"> مدفوع </label>
							<label> <input type="radio" name="new_paid_status" value="free"> مجاني </label>
							<label> <input type="radio" name="new_paid_status" value="test"> تجريبي </label>
							<label> <input type="radio" name="new_paid_status" value="alternative"> بديل </label>
							<label> <input type="radio" name="new_paid_status" value="no_app"> بدون تطبيق </label>


							<div class="input-group-append">
								<button type="submit" class="input-group-text">
									Search
								</button>
							</div>
						</div>
					</div>

				</form>

				{{$objects->withQueryString()->links()}}

			</div>
		</div>
	</div>
	</div>


@endsection('content')