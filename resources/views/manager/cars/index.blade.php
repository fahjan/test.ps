@extends('layouts.account')

@section('content')


    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-left"> <i class="fa fa-car"></i> {{__('public.cars')}}</h4>
                <div class="float-right">
                    <a href="{{route($route . 'create')}}" class="btn btn-success">
                        <i class="fa fa-plus"></i> {{__('public.new_car')}}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-striped -table-dark table-hover ">
                        <thead class=" text-warning">
                            <th> {{__('public.title')}}</th>
                            <th>{{__('public.car_number')}}</th>
                            <th> {{__('public.model_year')}}</th>
                            <th> {{__('public.renewal_at')}}</th>
                            <th> {{__('public.insurance_at')}}</th>
                            <th>{{__('public.lessons_count')}}</th>
                            <th> {{__('public.duration')}}</th>
                            <th>{{__('public.notes')}}</th>
                            <th class="text-right"></th>
                        </thead>
                        <tbody>
                            @foreach($objects as $object)
                                <tr>
                                    <td>{{$object->title}}</td>
                                    <td>{{$object->car_number}}</td>
                                    <td>{{$object->model_year}}</td>
                                    <td>{{$object->renewal_at}}</td>
                                    <td>{{$object->insurance_at}}</td>
                                    <td>{{$object->lessons_count}}</td>
                                    <td>{{$object->lessons_duration}}</td>
                                    <td>{{$object->notes}}</td>

                                    <td class="text-right">
                                        <a href="{{route($route . 'edit', $object->id)}}" class="btn btn-info"><i
                                                class="fa fa-edit">
                                                {{__('public.edit')}}</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection('content')