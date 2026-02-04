@extends('layouts.account')

@section('content')


<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title float-left"> <i class="fa fa-car"></i> {{__('public.cars')}}</h4>
            <div class="float-right">
                <a href="{{route($route . 'create')}}" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive ">
                <table class="table table-striped -table-dark table-hover ">
                    <thead class=" text-warning">
                        <th>@sortablelink('title', __('public.title'))</th>
                        <th>@sortablelink('car_number', __('public.car_number'))</th>
                        <th>@sortablelink('model_year', __('public.model_year'))</th>
                        <th>@sortablelink('renewal_at', __('public.renewal_at'))</th>
                        <th>@sortablelink('insurance_at', __('public.insurance_at'))</th>
                        <th>@sortablelink('lessons_count', __('public.lessons_count'))</th>
                        <th>@sortablelink('lessons_duration', __('public.duration'))</th>
                        <th>{{__('public.notes')}}</th>
                        <th></th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection('content')
