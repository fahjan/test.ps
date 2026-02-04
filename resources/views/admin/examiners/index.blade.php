@extends('layouts.account')

@section('content')


	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title float-left"> {{__('public.examiners')}}</h4>
				<a href="{{route($route . 'create')}}" class="btn btn-success">
					<i class="fa fa-plus"></i>
				</a>
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
							<th> {{__('validation.attributes.name')}}</th>
							<th>{{__('validation.attributes.city')}}</th>
							<th></th>
						</thead>
						<tbody>
							@foreach($examiners as $examiner)
								<tr>
									<td>
										<b>{{$examiner->name}}</b>
									</td>
									<td>
										{{$examiner->city->title}}
									</td>

									<td class="text-right">
										<a href="{{route($route . 'edit', $examiner->id)}}" class="btn btn-warning"><i
												class="fa fa-edit"></i> </a>
									</td>

								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{$examiners->links()}}
			</div>
		</div>
	</div>


@endsection('content')