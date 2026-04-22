@extends('layouts.account')

@section('content')


	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title float-right"> {{__('public.schools')}}</h4>
				<div class="float-left">
					<a href="{{route($route . 'create')}}" class="btn btn-success">
						<i class="fa fa-plus"></i>
					</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive ">
					<table class="table table-striped -table-dark table-hover ">
						<thead class=" text-warning">
							<th>@sortablelink('title', __('public.title'))</th>
							<th></th>
							<th></th>
						</thead>
						<tbody>
							@foreach($objects as $object)
								<tr>
									<td>
										<b>{{$object->title}}</b>
										<br>
										<small>{{$object->city->title ?? ''}} - {{$object->address}}</small>
										<br>
										{{$object->mobile}}
									</td>

									<td>{{$object->admin->name ?? ''}}<br>{{ltrim($object->admin->phone_number ?? '', '+97')}}</td>

									<td class="text-left">

										<a target="_blank"
											href="{{Illuminate\Support\Facades\URL::signedRoute('autologin', ['user' => $object->admin->id ?? ''])}}">تسجيل
											دخول</a>
										<a href="{{route($route . 'edit', $object->id)}}" class="btn btn-info"><i
												class="fa fa-edit">
												{{__('public.edit')}}</i></a>

									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection('content')