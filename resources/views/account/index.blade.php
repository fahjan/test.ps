@extends('layouts.account')

@section('content')




    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="title">{{$user->name}}</h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h6>{{__('public.id_number')}}: {{auth()->user()->id_number}}</h6>
                            <h6>{{__('public.mobile')}}: {{auth()->user()->mobile}}</h6>

                            <a class="pull-left" href="{{route('account.profile.index')}}">{{__('public.edit_profile')}}</a>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection