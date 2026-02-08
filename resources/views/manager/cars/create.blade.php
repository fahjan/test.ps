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

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="title">{{__('public.cars')}}
                                <span class="float-left d-none">

                                </span>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{__('public.title')}}</label>
                                        <input required name="title" value="{{old('title', $object->title ?? '')}}"
                                            placeholder="{{__('public.title')}}" type="text"
                                            class="form-control  {{ $errors->has('title') ? ' is-invalid' : ' ' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('public.car_number')}}</label>
                                        <input required name="car_number"
                                            value="{{old('car_number', $object->car_number ?? '') }}" type="text"
                                            {{isset($object) ? 'disabled' : ''}} placeholder="{{__('public.car_number')}}"
                                            class="form-control {{ $errors->has('car_number') ? ' is-invalid' : ' ' }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('public.notes') }}</label>
                                        <input name="notes" value="{{old('notes', $object->notes ?? '')}}"
                                            placeholder="{{__('public.notes')}}" type="text"
                                            class="form-control {{ $errors->has('notes') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('public.model_year')}}</label>
                                        <input required name="model_year"
                                            value="{{old('model_year', $object->model_year ?? '')}}"
                                            placeholder="{{__('public.model_year')}}" type="number"
                                            class="form-control {{ $errors->has('model_year') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('public.renewal_at')}}</label>
                                        <input required name="renewal_at"
                                            value="{{old('renewal_at', $object->renewal_at ?? '')}}" type="text"
                                            placeholder="YYYY-MM-DD" {{--
                                            pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])/(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])/(?:30))|(?:(?:0\[13578\]|1\[02\])-31))"
                                            --}} {{--
                                            pattern="(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)"
                                            --}} {{--
                                            pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                                            --}}
                                            class="form-control datepicker {{ $errors->has('renewal_at') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>{{__('public.insurance_at')}}</label>
                                        <input required name="insurance_at"
                                            value="{{old('insurance_at', $object->insurance_at ?? '')}}"
                                            placeholder="{{__('public.insurance_at')}}" type="text" placeholder="YYYY-MM-DD"
                                            {{--
                                            pattern="(?:19|20)\[0-9\]{2}-(?:(?:0\[1-9\]|1\[0-2\])/(?:0\[1-9\]|1\[0-9\]|2\[0-9\])|(?:(?!02)(?:0\[1-9\]|1\[0-2\])/(?:30))|(?:(?:0\[13578\]|1\[02\])-31))"
                                            --}} {{--
                                            pattern="(^(((0[1-9]|1[0-9]|2[0-8])[\/](0[1-9]|1[012]))|((29|30|31)[\/](0[13578]|1[02]))|((29|30)[\/](0[4,6,9]|11)))[\/](19|[2-9][0-9])\d\d$)|(^29[\/]02[\/](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)"
                                            --}} {{--
                                            pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                                            --}}
                                            class="form-control datepicker {{ $errors->has('insurance_at') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('public.trainer')}}</label>
                                        <select name="trainer_id" required class="form-control">
                                            @foreach($trainers as $trainer)
                                                <option value="{{$trainer->id}}" {{$trainer->id == old('trainer_id', $object->trainer_id ?? '') ? 'selected' : ''}}>{{$trainer->user->name}}:
                                                    @foreach($trainer->jobs as $job)
                                                        {{$job->title}},
                                                    @endforeach
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicletype_id">{{__('public.vehicletype')}}</label>


                                        <select name="vehicletype_id" id="vehicletype_id" required class="form-control">
                                            @foreach($vehicletypes as $vehicletype)
                                                <option value="{{$vehicletype->id}}" {{$vehicletype->id == old('vehicletype_id', $object->vehicletype_id ?? 0) ? 'selected' : ''}}>
                                                    {{$vehicletype->title}}
                                                </option>
                                            @endforeach
                                        </select>

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
@endsection