@extends('layouts.account')

@section('content')


<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<div>
				<label for="">التقدم الاجمالي {{round($student->percent)}}%</label>
                
                
				<div class="progress">
					<div class="progress-bar" role="progressbar" style="width: {{$student->percent}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{round($student->percent)}}%</div>
				  </div>
			</div>
			<h4 class="card-title float-left"> {{__('public.exams')}}
			
			
				
			</h4>
			<div class="float-right">

				<div class="btn-group -dropleft" role="group" aria-label="Button group with nested dropdown">
				  
					<div class="btn-group" role="group">
					  <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						
					  </button>
					  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
						@foreach($types as $type)
						<a class="dropdown-item" href="{{route('student.exams.create')}}?type_id={{$type->id}}">{{$type->title}}</a>
						@endforeach
						
					  </div>
					</div>
					<a href="{{route('student.exams.create')}}" class="btn btn-secondary">اختبار جديد</a>

				  </div>

				
                
			</div>
			

		</div>
		<div class="card-body">
			
			
			<div class="table-responsive">
				اهلا وسهلا بك
            </div>
            
		</div>
	</div>
</div>


@endsection('content')
