@extends('layouts.account')

@section('content')


	<div class="col-md-12">
		<div class="card">
			<div class="card-header">

				<div class="card-title">
					<a href="{{url('manager/students?only_me=true')}}">@if($only_me != '') <i class="fa fa-check"></i>
					@endif
						طلابي فقط</a>

				</div>
				<div class="card-title">
					حالة الدفعة
					<a href="{{url('manager/students?paid_status=new' . $only_me)}}">@if($paid_status == '&paid_status=new')
					<i class="fa fa-check"></i> @endif جديد</a> |
					<a href="{{url('manager/students?paid_status=gift' . $only_me)}}">@if($paid_status == '&paid_status=gift')
					<i class="fa fa-check"></i> @endif هدية</a> |
					<a href="{{url('manager/students?paid_status=paid' . $only_me)}}">@if($paid_status == '&paid_status=paid')
					<i class="fa fa-check"></i> @endif مدفوع</a> |
					<!--<a href="{{url('manager/students?paid_status=free'.$only_me)}}">مجاني</a> |-->
					<!--<a href="{{url('manager/students?paid_status=test'.$only_me)}}">تجريبي</a> |-->
					<!--<a href="{{url('manager/students?paid_status=alternative'.$only_me)}}">بديل</a> |-->
					<a href="{{url('manager/students?paid_status=no_app' . $only_me)}}">@if($paid_status == '&paid_status=no_app')
					<i class="fa fa-check"></i> @endif بدون تطبيق</a>

				</div>

				<div class="card-title">
					حساب التطبيق
					<a href="{{url('manager/students?use_app=yes' . $only_me . $paid_status)}}">@if($use_app == '&use_app=yes')
					<i class="fa fa-check"></i> @endif نعم</a> |
					<a href="{{url('manager/students?use_app=no' . $only_me . $paid_status)}}">@if($use_app == '&use_app=no')
					<i class="fa fa-check"></i> @endif لا</a>
				</div>


				<!--<div class="float-right">-->
				<!--	<a href="{{route('manager.students.create')}}" class="btn btn-success">-->
				<!--		<i class="fa fa-plus"></i> {{__('public.new_student')}}-->
				<!--	</a>-->
				<!--</div>-->
			</div>

		</div>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title float-left"> {{__('public.students')}} ({{$objects->total()}})</h4>
				<div class="float-right">
					<a href="{{route('manager.students.create')}}" class="btn btn-success">
						<i class="fa fa-plus"></i> {{__('public.new_student')}}
					</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive ">
					<table class="table -table-striped -table-dark table-hover ">
						<?php /* * ?>
						<thead class=" text-warning">
							<th>#</th>
							{{-- <th>@sortablelink('archive_number', __('public.archive_number'))</th> --}}

							<th>

								{{__('public.name') }} |
								@sortablelink('affiliated_at', __('public.affiliated_at')) |
								{{-- @sortablelink('user.name', __('public.name')) | --}}
							</th>
							{{-- <th>{{__('public.name')}}</th> --}}
							{{-- <th>{{__('validation.attributes.agreed_amount')}}</th> --}}
							<th class="text-right"></th>
						</thead>
						<?php /* */ ?>

						<tbody>
							@foreach($objects as $object)
								<tr>

									{{-- <td>{{$object->number}}</td> --}}
									<td>
										<b>{{$object->number}}</b>&nbsp;-&nbsp;
										{{$object->full_name}} - <p class="badge badge-default"><i class="fa fa-user"></i>
											{{$object->creator->name ?? ''}}</p>
										<br>
										<div class="badge badge-warning" title="{{$object->created_at}}"><i class="fa fa-clock">
											</i> {{$object->created}}</div>
										<span class="-badge -badge-primary"><i class="fa fa-mobile-alt fa-lg	"></i>
											<a href="tel:{{$object->user->mobile}}">{{$object->user->mobile}}</a></span>
										<span class="badge badge-danger"><i class="fa fa-id-card fa-lg	"></i>
											{{$object->id_number}}</span>
										<span class="badge badge-warning"><i class="fa fa-car fa-lg	"></i>
											{{$object->license->title}}</span>

										<span class="badge badge-info">{{__('public.' . $object->exam_type)}}</span>
										<span class="badge badge-info">{{ $object->email }}</span>
										<div class="badge badge-info"> <b>{{__('code')}}: {{ $object->user->code }}</b></div>

										@if($object->theoretical_at == null)
											<div>
												<span for="">{{__('public.progress')}} <a
														href="{{url('manager/students/' . $object->id . '/exams')}}"
														target="_blank">{{__('public.view')}}</a>{{-- {{round($object->percent)}}%
													--}}</span>
												{{-- <span for="">{{__('public.progress')}} <a
														href="{{url('manager/students/'.$object->id.'/exams')}}"
														target="_blank">{{__('public.view')}}</a> ( {{ $object->examsCount
													}})</span> --}}

												<div class="progress">
													@php
														$percent = $object->percent;
													@endphp
													<div class="progress-bar" role="progressbar" style="width: {{$percent}}%;"
														aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
														{{round($percent)}}%
													</div>
												</div>
											</div>
										@endif
										<label>{{__('public.' . $object->paid_status)}}</label>
										<div>
											@if($object->theoretical_at != null)
												<span class="badge badge-success">{{__('public.progress')}} <i
														class="fa fa-check"></i></span>
											@endif
											@if($object->tested_at != null)
													<span class="badge badge-success">{{__('public.tested_at')}} <i
															class="fa fa-check"></i></span>
												</div>
											@endif
										<div>
											@if($object->status == 'finished')
												<span class="badge badge-success">{{__('public.finished')}} <i
														class="fa fa-check"></i></span>
											@endif
										</div>



									</td>

									<td class="text-right">
										<div class="btn-group" role="group" aria-label="Button group with nested dropdown">


											<div class="btn-group" role="group">
												<button id="btnGroupDrop-{{$object->id}}" type="button"
													class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
													aria-haspopup="true" aria-expanded="false">

												</button>
												<div class="dropdown-menu dropdown-menu-right dropright"
													aria-labelledby="btnGroupDrop-{{$object->id}}">
													<a class="dropdown-item"
														href="{{route('manager.students.edit', $object->id)}}">
														<i class="fa fa-edit"></i> {{__('public.edit')}}
													</a>
													<a class="dropdown-item"
														href="{{route('manager.students.show', $object->id)}}">
														<i class="fa fa-print"></i> {{__('public.print')}}
													</a>
													<a class="dropdown-item"
														href="{{route('manager.students.reset_password', $object->id)}}">
														<i class="fa fa-key"></i> {{__('public.send_password')}}
													</a>
													<a class="dropdown-item"
														href="{{route('manager.students.unfreez', $object->id)}}">
														<i class="fa fa-check-circle-o"></i> {{__('Unfreeze')}}
													</a>


													@if($object->lessons_count == 0 && $object->payments_count == 0)

														<div class="dropdown-item">
															<form action="{{route('manager.students.destroy', $object->id)}}"
																method="post"
																onsubmit="if(!confirm('هل انت متأكد؟')) return false; ">
																@csrf
																@method('delete')
																<button type="submit" class="btn btn-danger">
																	<i class="fa fa-trash"></i> {{__('public.delete')}}
																</button>
															</form>

														</div>
													@endif

												</div>
											</div>
											<a href="{{route('manager.students.show', $object->id)}}" class="btn btn-warning">
												<i class="fa fa-search"></i> {{__('public.show')}}
											</a>
										</div>
										{{-- <a href="{{route('manager.students.show', $object->id)}}"
											class="btn btn-default"><i class="fa fa-print">
												{{__('public.print')}}</i></a>
										<a href="{{route('manager.students.show', $object->id)}}" class="btn btn-success"><i
												class="fa fa-search">
												{{__('public.show')}}</i></a>


										<a href="{{route('manager.students.edit', $object->id)}}" class="btn btn-info"><i
												class="fa fa-edit">
												{{__('public.edit')}}</i></a> --}}

									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{$objects->appends(Request::except('page'))->links()}}
			</div>
		</div>
	</div>


@endsection('content')