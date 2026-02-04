@extends('layouts.account')

@section('content')


<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title float-left"> <i class="fa fa-user"></i> {{__('public.active_students')}}</h4>
            <div class="float-right">
                {{-- <a href="{{route($route . 'create')}}" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                </a> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-striped -table-dark table-hover ">
                    <thead class=" text-warning">
                        
                    </thead>
                    <tbody>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{__('public.lessons')}}</th>
                                    <th>{{__('public.payments')}}</th>
                                </tr>
                            </thead>
                            @foreach($active_students as $student)
                            <tr>
                                <td>
                                    <a href="{{route('manager.students.show', $student->id)}}">{{$student->full_name}} </a>
                                </td>

                                <td>
                                    {{$student->lessons_count}}
                                    <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                                </td>
                                <td>{{$student->payments_sum}} / {{$student->agreed_amount}}</td>

                            </tr>
                            @endforeach
                        </table>
                        



                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection('content')
