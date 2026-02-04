@extends('layouts.account')

@section('content')


	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title float-left"> {{__('public.cities')}}</h4>
				{{-- <a href="{{route($route . 'create')}}" class="btn btn-success">
					<i class="fa fa-plus"></i>
				</a> --}}
				<div class="float-right">
					<form action="{{ route($route . 'index') }}" method="get">
						<div class="input-group no-border">
							<input type="text" name="s" value="{{ old('s', request('s')) }}" placeholder=""
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
							<tr>
								<th>{{-- @sortablelink('title', __('public.title')) --}}
									{{__('validation.attributes.city')}}
								</th>
								<th>{{__('public.schools')}} {{$objects->sum('schools_count')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($objects as $object)
								<tr>
									<td>
										<b>{{$object->title}} </b>
										-
										<small>{{$object->country->title}} </small>

									</td>


									<td class="-text-right">
										{{$object->schools_count}}
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