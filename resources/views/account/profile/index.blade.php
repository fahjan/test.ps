@extends('layouts.account')

@section('content')



    <form action="{{route($route . 'update', 1)}}" method="post">
        @method('patch')
        @csrf
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="title">{{__('validation.attributes.password')}}
                            <span class="float-left d-none">

                            </span>
                        </h6>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('validation.attributes.current_password') }}</label>
                                    <input name="current_password" type="password"
                                        class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('validation.attributes.password')}}</label>
                                    <input required name="password" type="password"
                                        class="form-control  {{ $errors->has('password') ? ' is-invalid' : ' ' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__('validation.attributes.password_confirmation')}}</label>
                                    <input required name="password_confirmation" type="password"
                                        class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : ' ' }}">
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="title">{{__('public.user_information')}}
                            <span class="float-left d-none">

                            </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection