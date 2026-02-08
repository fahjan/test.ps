@extends('layouts.account')

@section('js')
    <script src="{{asset('assets/account/mask/jquery.mask.min.js')}}"></script>
    <script>

        $('.date-mask').mask('00/00/0000', { placeholder: "__/__/____" });
    </script>
@endsection
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
                        <input name="avatar" type="file">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray" src="{{$object->photo_url ?? '' }}" alt="...">

                                <h5 class="title d-none"></h5>
                            </a>
                            <br>
                            <br>

                            <p class="description -d-none">

                            </p>
                        </div>
                        <p class="description text-center d-none">
                            "Lamborghini Mercy
                            <br> Your chick she so thirsty
                            <br> I'm in that two seat Lambo"
                        </p>
                        <div class="row">
                            <div class="col-12 pl-1">
                                <input name="archive_number"
                                    value="{{old('archive_number', $object->archive_number ?? '')}}"
                                    placeholder="{{__('validation.attributes.archive_number')}}" type="text"
                                    class="form-control {{ $errors->has('archive_number') ? ' is-invalid' : '' }}">


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 pl-1">



                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="exam_type">{{ __('validation.attributes.exam_type') }}</label>

                                    <select name="exam_type" id="exam_type" required class="form-control">
                                        <option value="written" {{ old('exam_type', $object->exam_type ?? '') == 'written' ? 'selected' : '' }}>{{__("public.written")}}</option>
                                        <option value="oral">{{__("public.oral")}}</option>
                                        <option value="minioral">{{__("public.minioral")}}</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="license_id">{{ __('validation.attributes.license') }}</label>

                                    <select name="license_id" id="license_id" required class="form-control">
                                        @foreach($licenses as $license)
                                            <option value="{{$license->id}}" {{$license->id == old('license_id', $object->license_id ?? '') ? 'selected' : ''}}>
                                                {{$license->title}}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="">{{__('public.agreed_lessons')}}</label>
                                    <input required name="agreed_lessons"
                                        value="{{old('agreed_lessons', $object->agreed_lessons ?? 25)}}" -readonly
                                        placeholder="{{__('public.agreed_lessons')}}" type="text"
                                        class="form-control -date-mask -datepicker {{ $errors->has('agreed_lessons') ? ' is-invalid' : '' }}">
                                </div>

                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>{{ __('validation.attributes.agreed_amount') }}</label>
                                    <input -required name="agreed_amount"
                                        value="{{old('agreed_amount', $object->agreed_amount ?? '')}}"
                                        placeholder="{{__('validation.attributes.agreed_amount')}}" type="number"
                                        class="form-control {{ $errors->has('agreed_amount') ? ' is-invalid' : '' }}">
                                </div>
                            </div>

                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>{{ __('validation.attributes.prev_license') }}</label>
                                    <input name="prev_license"
                                        value="{{old('prev_license', $object->prev_license ?? '')}}"
                                        placeholder="{{__('validation.attributes.prev_license')}}" type="text"
                                        class="form-control {{ $errors->has('prev_license') ? ' is-invalid' : '' }}">
                                </div>
                            </div>

                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>{{ __('validation.attributes.prev_place') }}</label>
                                    <input name="prev_place" value="{{old('prev_place', $object->prev_place ?? '')}}"
                                        placeholder="{{__('validation.attributes.prev_place')}}" type="text"
                                        class="form-control {{ $errors->has('prev_place') ? ' is-invalid' : '' }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>{{ __('validation.attributes.prev_number') }}</label>
                                    <input name="prev_number" value="{{old('prev_number', $object->prev_number ?? '')}}"
                                        placeholder="{{__('validation.attributes.prev_number')}}" type="text"
                                        class="form-control {{ $errors->has('prev_number') ? ' is-invalid' : '' }}">
                                </div>
                            </div>

                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>{{ __('validation.attributes.prev_end_date') }}</label>
                                    <input name="prev_end_date"
                                        value="{{old('prev_end_date', $object->prev_end_date ?? '')}}" {{--
                                        placeholder="YYYY-MM-DD"
                                        pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                                        --}} type="text"
                                        class="form-control date-mask -datepicker {{ $errors->has('prev_end_date') ? ' is-invalid' : '' }}">
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
                        <h6 class="title">{{__('public.profile')}}
                            <span class="float-right -d-none">
                                @isset($object)
                                @else
                                <label for="send_password"> <input id="send_password" type="checkbox"
                                        name="send_password" value="yes"> انشاء حساب على الموقع </label>

                                <br>
                                <label for="use_app"> <input class="btn btn-black" id="use_app" type="checkbox" checked
                                        name="use_app" value="{{old('use_app', $object->use_app ?? 'yes')}}"> انشاء حساب
                                    التطبيق </label>
                                @endif


                            </span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 pr-1">

                                <div class="form-group">
                                    <label for="">{{__('public.affiliated_at')}}</label>
                                    <input required name="affiliated_at"
                                        value="{{old('affiliated_at', $object->affiliated_at ?? Carbon\Carbon::now()->format('d/m/Y'))}}"
                                        -readonly placeholder="{{__('public.affiliated_at')}}" type="text"
                                        class="form-control date-mask -datepicker {{ $errors->has('affiliated_at') ? ' is-invalid' : '' }}">
                                </div>
                            </div>
                            <div class="col-md-3 pr-x">
                                <label for="active">{{ __('public.active_student') }}</label>

                                <select name="active" id="active" required class="form-control">
                                    <option value="yes" {{'active' == old('active', $object->active ?? '') ? 'selected' : ''}}>
                                        {{ __('Active') }}
                                    </option>
                                    <option value="yes" {{'active' == old('active', $object->active ?? '') ? 'selected' : ''}}>
                                        {{ __('Frozen') }}
                                    </option>
                                </select>




                            </div>
                            <div class="col-md-3 pr-x"></div>
                            <div class="col-md-3 pr-l">

                                <div class="form-group">
                                    <label for="">{{__('public.medical_checked_at')}}</label>
                                    <input required name="medical_checked_at"
                                        value="{{old('medical_checked_at', $object->medical_checked_at ?? Carbon\Carbon::now()->format('d/m/Y'))}}"
                                        -readonly placeholder="{{__('public.medical_checked_at')}}" type="text"
                                        class="form-control date-mask -datepicker {{ $errors->has('medical_checked_at') ? ' is-invalid' : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 pr-1">
                                <div class="form-group">
                                    <label>{{__('public.first_name')}}</label>
                                    <input required name="first_name"
                                        value="{{old('first_name', $object->first_name ?? '')}}"
                                        placeholder="{{__('public.first_name')}}" type="text"
                                        class="form-control  {{ $errors->has('first_name') ? ' is-invalid' : ' ' }}">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>{{__('public.father_name')}}</label>
                                    <input required name="father_name"
                                        value="{{old('father_name', $object->father_name ?? '')}}"
                                        placeholder="{{__('public.father_name')}}" type="text"
                                        class="form-control  {{ $errors->has('father_name') ? ' is-invalid' : ' ' }}">
                                </div>
                            </div>
                            <div class="col-md-3 pl-1">
                                <div class="form-group">
                                    <label>{{__('public.grandfather_name')}}</label>
                                    <input required name="gfather_name"
                                        value="{{old('gfather_name', $object->gfather_name ?? '')}}"
                                        placeholder="{{__('public.grandfather_name')}}" type="text"
                                        class="form-control {{ $errors->has('gfather_name') ? ' is-invalid' : ' ' }}">
                                </div>
                            </div>
                            <div class="col-md-3 pl-1">
                                <div class="form-group">
                                    <label>{{__('public.family_name')}}</label>
                                    <input required name="family_name"
                                        value="{{old('family_name', $object->family_name ?? '')}}"
                                        placeholder="{{__('public.family_name')}}" type="text"
                                        class="form-control  {{ $errors->has('family_name') ? ' is-invalid' : ' ' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 pr-1">
                                <div class="form-group">
                                    <label>{{__('public.id_number')}}</label>
                                    <input required name="id_number" dir="ltr"
                                        value="{{old('id_number', $object->id_number ?? '') }}" type="number"
                                        pattern="\d*" {{isset($object) ? 'disabled' : ''}}
                                        placeholder="{{__('public.id_number')}}"
                                        class="form-control {{ $errors->has('id_number') ? ' is-invalid' : ' ' }}">
                                    @if ($errors->has('id_number'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('id_number') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 pl-1">
                                <div class="form-group">
                                    <label>{{__('public.dateofbirth')}}</label>
                                    <input required name="dateofbirth"
                                        value="{{old('dateofbirth', $object->dateofbirth ?? '')}}" -readonly
                                        placeholder="{{__('public.dateofbirth')}}" type="text"
                                        class="form-control date-mask -datepicker {{ $errors->has('dateofbirth') ? ' is-invalid' : '' }}">
                                </div>
                            </div>
                            <div class="col-md-3 pl-1">
                                <label>{{ __('validation.attributes.mobile') }}</label>


                                {{-- {{isset($object)? 'disabled': ''}} --}}
                                <input required id="mobile" dir="ltr" type="number" pattern="\d*"
                                    class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" name="mobile"
                                    value="{{ old('mobile', isset($object->user->mobile) ? $object->user->mobile : '') }}">
                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 pl-1">
                                <div class="form-group">
                                    <label for="gender">{{ __('validation.attributes.sex') }}</label>
                                    <select name="gender" id="gender" required class="form-control">
                                        <option value="male" {{'male' == old('gender', $object->gender ?? '') ? 'selected' : ''}}>
                                            {{ __('public.male') }}
                                        </option>
                                        <option value="female" {{'female' == old('gender', $object->gender ?? '') ? 'selected' : ''}}>
                                            {{ __('public.female') }}
                                        </option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 pr-1">
                                <div class="form-group">
                                    <label>{{__('validation.attributes.city')}}</label>

                                    <select name="city_id" id="city_id" required class="form-control">
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" {{$city->id == old('city_id', $object->city_id ?? Auth::user()->managerSchool->city_id) ? 'selected' : ''}}>
                                                {{$city->title}}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>

                            <div class="col-md-9 pl-1">
                                <div class="form-group">
                                    <label>{{ __('validation.attributes.address') }}</label>
                                    <input required name="address" value="{{old('address', $object->address ?? '')}}"
                                        placeholder="{{__('validation.attributes.address')}}" type="text"
                                        class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('public.signes_trainer')}}</label>
                                    <select name="trainer_id" required class="form-control">
                                        @foreach($trainers as $trainer)
                                            <option value="{{$trainer->id}}" {{$trainer->id == old('trainer_id', $object->trainer_id ?? '') ? 'selected' : ''}}>{{$trainer->user->name}} -
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
                                    <label>{{__('public.driving_trainer')}}</label>
                                    <select name="drivingtrainer_id" required class="form-control">
                                        @foreach($trainers as $trainer)
                                            <option value="{{$trainer->id}}" {{$trainer->id == old('drivingtrainer_id', $object->drivingtrainer_id ?? '') ? 'selected' : ''}}>
                                                {{$trainer->user->name}}:
                                                @foreach($trainer->jobs as $job)
                                                    {{$job->title}},
                                                @endforeach
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
    @endsection('content')