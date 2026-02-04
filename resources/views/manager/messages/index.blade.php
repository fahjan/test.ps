@extends('layouts.account')

@section('content')

	<form action="{{ route($route . 'store') }}" method="post">
		@csrf

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">

					<h4 class="card-title -float-left">
						<input type="text" name="message" value="" placeholder="نص الرسالة هنا" required
							class="form-control">
					</h4>

					<div class="float-right">
						<button class="btn btn-success" type="submit"> ارسال</button>


					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive ">

						{{-- @livewire('manager.messages') --}}


						{{-- <table class="table -table-striped -table-dark table-hover ">
							<thead class=" text-warning">
								<th>#</th>

								<th>

								</th>

								<th class="text-right"></th>
							</thead>
							<tbody>
								@foreach($objects as $object)
								<tr>
									<td>
										<input type="checkbox" name="ids[]" id="id-{{$object->user->id}}"
											value="{{$object->user->id}}">
									</td>
									<td><label class="label" for="id-{{$object->user->id}}">{{$object->full_name}}</label>
									</td>

									<td>



										<a href="tel:{{$object->user->mobile}}">{{$object->user->mobile}}</a>

									</td>



								</tr>
								@endforeach
							</tbody>
						</table> --}}
					</div>
					{{$objects->links()}}
				</div>
			</div>
		</div>
	</form>

@endsection('content')