@extends('layouts.account')

@section('content')


<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<div>
				<label for="">{{__('public.progress')}} {{round($student->percent)}}%</label>
				
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: {{$student->percent}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{round($student->percent)}}%</div>
				  </div>
			</div>
			<h4 class="card-title float-left"> 
				{{__('public.exams')}}: {{$student->full_name}}
			
			
				
			</h4>
			
			

		</div>
		<div class="card-body">
			
			
			<div class="table-responsive">
				<table class="table -table-striped -table-condensed -table-dark table-hover ">
					<thead class=" text-warning">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</thead>
					<tbody>
						@foreach($exams as $exam)
						
						<tr>
							<td>{{$exam->finished}}</td>
							<td>{{$exam->result}}</td>
							<td colspan="5">

								<div class="progress">
									<div class="progress-bar @if($exam->percent>83.3) bg-success @else bg-danger @endif" role="progressbar" style="width: {{$exam->percent}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</td>
							
							
							<td class="text-right">
								
								<a href="{{url('manager/students/exams/'. $exam->id.'/show')}}" target="_blank" class="btn btn-info -d-none"><i class="fa fa-search">
										{{__('public.show')}}</i></a>

							</td>
						</tr>
						{{-- <tr>
							<td colspan="4">
								<div class="progress">
									<div class="progress-bar @if($exam->percent>95) bg-success @else bg-danger @endif" role="progressbar" style="width: {{$exam->percent}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</td>
						</tr> --}}
						@endforeach
					</tbody>
				</table>
            </div>
            {{$exams->links()}}
		</div>
	</div>
</div>


@endsection('content')
