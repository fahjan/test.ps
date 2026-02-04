@extends('layouts.account')

@section('content')


<div class="col-md-12">
	<div class="card">
		<div class="card-header">
            <h4 class="card-title float-left"> {{__('public.lessons')}} {{$lessons->total()}}</h4>
            {{-- <a href="{{route($route . 'create')}}" class="btn btn-success">
                <i class="fa fa-plus"></i>
            </a> --}}
			<div class="float-right">
                
				
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive ">
				<table class="table table-striped -table-dark table-hover ">
					<thead class=" text-warning">
					<th></th>
					<th>{{__('public.name')}}</th>
					<th>{{__('public.school')}}</th>
					<th></th>
					</thead>
					<tbody>
						@foreach($lessons as $lesson)
						<tr class="{{$lesson->trashed()?  'bg-danger' :''}}">
							<td><b>{{$lesson->created_at}}</b></td>
							<td>{{$lesson->student->full_name}}</td>
							<td>{{$lesson->student->school->title}}</td>
							
							
							<td class="-text-right">
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
            </div>
            {{$lessons->links()}}
		</div>
	</div>
</div>


@endsection('content')
