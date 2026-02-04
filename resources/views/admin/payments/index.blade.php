@extends('layouts.account')

@section('content')


<div class="col-md-12">
	<div class="card">
		<div class="card-header">
            <h4 class="card-title float-left"> {{__('public.payments')}} {{$payments->total()}}</h4>
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
						<th>{{__('public.amount')}}</th>
						<th>{{__('public.name')}}</th>
						<th>{{__('public.school')}}</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($payments as $payment)
						<tr class="{{$payment->trashed()?  'bg-danger' :''}}">
							<td>{{$payment->amount}}</td>
							<td>{{$payment->student->full_name ?? '' }}</td>
							<td>{{$payment->student->school->title ?? '' }}</td>
							<td class="-text-right"></td>
						</tr>
						@endforeach
					</tbody>
				</table>
            </div>
            {{$payments->links()}}
		</div>
	</div>
</div>


@endsection('content')
