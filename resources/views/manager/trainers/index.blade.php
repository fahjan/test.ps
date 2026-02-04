@extends('layouts.account')

@section('content')


	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title float-left"> {{__('public.trainers')}}</h4>

				<div class="float-right">
					<a href="{{route($route . 'create')}}" class="btn btn-success">
						<i class="fa fa-plus"></i>
					</a>
					{{-- <form action="{{ route($route . 'index') }}" method="get">

						<div class="input-group no-border">
							<input type="text" name="s" value="{{ old('s', request('s')) }}" class="form-control">
							<div class="input-group-append">
								<button type="submit" class="input-group-text">
									<i class="now-ui-icons ui-1_zoom-bold"></i>
								</button>
							</div>
						</div>
					</form> --}}

				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive ">
					<table class="table table-striped -table-dark table-hover ">
						<thead class=" text-warning">
							<th>{{-- @sortablelink('title', __('public.title')) --}} {{__('public.trainer')}}</th>
							<th>{{__('validation.attributes.job')}}</th>
							<th></th>
						</thead>
						<tbody>
							@foreach($objects as $object)
								<tr>
									<td>
										<b>{{$object->user->name}}</b>
										-
										<small><a href="tel: {{$object->user->mobile}}">{{$object->user->mobile}}</a></small>

									</td>

									<td>
										@foreach($object->jobs as $job)
											<span class="badge badge-success">{{$job->title}}</span>
										@endforeach

									</td>
									<td class="text-right">

										<a href="{{route($route . 'edit', $object->id)}}" class="btn btn-info -d-none"><i
												class="fa fa-edit">
												{{__('public.edit')}}</i></a>

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