@extends('layouts.account')

@section('content')


	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title float-left"> {{__('public.schools')}}</h4>
				<a href="{{route($route . 'create')}}" class="btn btn-success">
					<i class="fa fa-plus"></i>
				</a>
				<div class="float-right">
					<form action="{{ route($route . 'index') }}" method="get">

						<div class="input-group no-border">
							<input type="text" name="title" value="{{ old('title', request('title')) }}"
								class="form-control">
							<div class="input-group-append">
								<button type="submit" class="input-group-text">
									<i class="now-ui-icons ui-1_zoom-bold"></i>
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive ">
					<table class="table table-striped -table-dark table-hover ">
						<thead class=" text-warning">
							<th>{{-- @sortablelink('title', __('public.title')) --}}</th>
							<th></th>
							<th></th>
						</thead>
						<tbody>
							@foreach($objects as $object)
								<tr>
									<td>
										<b>{{$object->title}} ({{$object->students_count}})</b>
										@foreach($object->managers as $manager)
											<span class="badge badge-warning">{{$manager->user->name ?? ''}}</span>
										@endforeach
										<br>
										<small>{{$object->city->title ?? ''}} - {{$object->address}}</small>
										<br>
										{{$object->mobile}}, {{$object->phone}}
										<br>
										{{$object->email}}
									</td>

									<td>

									</td>

									<td class="text-right">


										{{-- <a href="{{route($route . 'edit', $object->id)}}" class="btn btn-info"><i
												class="fa fa-edit">
												{{__('public.edit')}}</i></a> --}}

									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{$objects->links()}}
			</div>
		</div>
	</div>


@endsection('content')