@extends('layouts.account')

@section('content')

    @isset($object)
        <form action="{{ route($route . 'update', $object->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            <input type="hidden" name="id" value="{{ $object->id }}">
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
                            <div class="author">
                                <a href="#">
                                    {{-- <img class="avatar border-gray"
                                        src="{{asset('images/'. (isset($object)? $object->photo : '') ) }}" alt="..."> --}}
                                    <h1><i class="fa fa-user"></i></h1>
                                    <h5 class="title">{{$object->user->name ?? __('public.name')}}</h5>
                                </a>
                                <p class="description">
                                    {{$object->user->mobile ?? __('public.mobile')}}
                                </p>
                            </div>
                            <p class="description text-center d-none">
                                "Lamborghini Mercy
                                <br> Your chick she so thirsty
                                <br> I'm in that two seat Lambo"
                            </p>
                            <div class="row">
                                <div class="col-12 pl-1">
                                    <input type="file" class="form-control" name="avatar" id="avatar">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>{{__('validation.attributes.job')}}</label>
                                        <input type="hidden" name="jobs[]" value="0">

                                        @foreach($jobs as $job)
                                            <p><label><input type="checkbox" name="jobs[]" value="{{$job->id}}" {{isset($object) ? ($object->jobs->contains($job->id) ? 'checked' : '') : ''}}>
                                                    {{$job->title}}</label></p>
                                        @endforeach

                                    </div>
                                </div>


                            </div>
                        </div>
                        <hr>
                        <div class="button-container d-none">
                            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                                <i class="fab fa-google-plus-g"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="title">{{__('public.trainers')}}
                                <span class="float-left d-none">

                                </span>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md -pr-1">
                                    <div class="form-group">
                                        <label>{{__('public.name')}}</label>
                                        <input required name="name"
                                            value="{{old('name', isset($object) ? $object->user->name : '')}}"
                                            {{isset($object) ? 'disabled' : ''}} placeholder="{{__('public.name')}}"
                                            type="text"
                                            class="form-control  {{ $errors->has('name') ? ' is-invalid' : ' ' }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 -pr-1">
                                    <div class="form-group">
                                        <label>{{__('public.id_number')}}</label>
                                        <input required name="id_number" dir="ltr"
                                            value="{{old('id_number', isset($object) ? $object->user->id_number : '') }}"
                                            {{isset($object) ? 'disabled' : ''}} placeholder="{{__('public.id_number')}}"
                                            type="number" pattern="\d*"
                                            class="form-control {{ $errors->has('id_number') ? ' is-invalid' : ' ' }}">
                                        @if ($errors->has('id_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('id_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6 -pl-1">
                                    <label>{{ __('validation.attributes.mobile') }}</label>

                                    <input required id="mobile" dir="ltr" type="tel"
                                        class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}"
                                        {{isset($object) ? 'disabled' : ''}} name="mobile"
                                        value="{{ old('mobile', isset($object) ? $object->user->mobile : '') }}" required>
                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md -pr-1">
                                    <div class="form-group">
                                        <label>{{__('public.password')}} {{__('public.trainer')}}</label>
                                        <input {{isset($object) ? '' : 'required'}} name="password"
                                            value="{{old('password', $object->password ?? '')}}"
                                            placeholder="{{__('public.password')}}" type="text"
                                            class="form-control  {{ $errors->has('password') ? ' is-invalid' : ' ' }}">
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-12 pl-1"><button class="btn btn-success btn-lg float-left">
                                        <i class="fa fa-check"></i> {{__('public.save')}}</button></div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </form>


@endsection('content')