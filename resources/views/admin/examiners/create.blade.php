@extends('layouts.account')

@section('content')

    @isset($object)
        <form action="{{ route($route . 'update', $object->id) }}" method="post" enctype="multipart/form-data">
            @method('put')

            <input type="hidden" id="{{ $object->id }}">
    @else
            <form action="{{ route($route . 'store') }}" method="post" enctype="multipart/form-data">

        @endisset

            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="{{asset('/assets/img/car_bg.jpeg')}}" alt="...">
                        </div>
                        <div class="card-body">
                            <label for="">{{__('validation.attributes.name')}}</label>
                            <input type="text" name="name" value="{{ old('name', request('name')) }}" placeholder=""
                                class="form-control">
                            <label for="city_id">{{__('validation.attributes.city')}}</label>

                            <select name="city_id" id="city_id" required class="form-control">
                                @foreach($cities->pluck('title', 'id') as $city)
                                    <option value="{{$city->id}}" {{$city->id == old('city_id', $object->city_id ?? 0) ? 'selected' : ''}}>
                                        {{$city->title}}
                                    </option>
                                @endforeach
                            </select>


                        </div>
                        <hr>
                        <button class="btn btn-success btn-lg float-left">
                            <i class="fa fa-check"></i> {{__('public.save')}}</button>

                    </div>
                </div>




            </div>

        </form>


@endsection('content')