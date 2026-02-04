@extends('layouts.account')
@section('js')
  <script src="{{asset('assets/account/mask/jquery.mask.min.js')}}"></script>
  <script>
    $('.time-mask').mask('00/00/0000 00:00', { placeholder: "__/__/____ __:__" })
    $('.date-mask').mask('00/00/0000', { placeholder: "__/__/____" });
  </script>
@endsection

@section('content')

  <div class="row">
    <div class="col-md-4">
      <div class="card ">
        <div class="card-header ">
          <h4 class="card-title">البيانات الشخصية
            <div class="fileinput fileinput-new text-center float-right" data-provides="fileinput">
              <div class="fileinput-new thumbnail img-circle">
                <img src="{{$student->photo_url}}" alt="" class="img-responsive">
              </div>
            </div>
            {{-- <small class="description">الاسم، الموبايل، رقم هوية</small> --}}
          </h4>

        </div>
        <div class="card-body ">

          <div class="row">
            <div class="col">
              {{-- <p><strong>{{$student->number}}</strong></p> --}}
              <label for="">{{__('public.name')}}</label>
              <p>{{$student->full_name}}</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="">{{__('public.id_number')}}</label>
              <p>{{$student->id_number}}</p>
            </div>
            <div class="col">
              <label for="">{{__('public.mobile')}}</label>
              <p><a href="tel:{{$student->user->mobile}}">{{$student->user->mobile}}</a></p>

            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="">{{__('validation.attributes.sex')}}</label>
              <p>{{__('public.' . $student->gender)}}</p>

            </div>
            <div class="col">
              <label for="">{{__('validation.attributes.city')}}</label>
              <p>{{$student->city->title ?? ''}}</p>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="">{{__('public.dateofbirth')}}</label>
              <p>{{$student->dateofbirth}}</p>
            </div>
            <div class="col">
              <label for="">{{__('public.medical_checked_at')}}</label>
              <p> <span
                  class="badge badge-{{$student->need_medical == true ? 'danger' : 'success'}}">{{$student->medical_checked_at}}</span>
              </p>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="">{{__('validation.attributes.exam_type')}}</label>
              <p>{{__('public.' . $student->exam_type)}}</p>
            </div>
            <div class="col">
              <label for="">{{__('validation.attributes.license')}}</label>
              <p>{{$student->license->title}}</p>
            </div>
          </div>


          <div class="row">
            <div class="col">
              <label>{{ __('public.agreed_lessons') }}</label>
              <p>{{$student->agreed_lessons}}</p>
            </div>
            <div class="col">
              <label>{{ __('validation.attributes.agreed_amount') }}</label>
              <p>{{$student->agreed_amount}}</p>
            </div>
          </div>


          <div class="row">
            <div class="col">
              <label for="">{{__('validation.attributes.prev_license')}}</label>

            </div>
            <div class="col">

            </div>
          </div>





          <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            {{-- <div class="fileinput-new thumbnail img-circle">
              <img src="{{url('img/'. $student->photo)}}" alt="الصورة الشخصية">
            </div> --}}
            {{-- <div class="fileinput-preview fileinput-exists thumbnail img-circle" style=""></div> --}}
            {{-- <div>
              <span class="btn btn-round btn-rose btn-file">
                <span class="fileinput-new">اضافة صورة</span>
                <span class="fileinput-exists"></span>
                <input type="hidden"><input type="file" name="..."></span>
              <br>
              <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i
                  class="fa fa-times"></i> Remove</a>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="row card ">
        <div class="card-body ">
          <div class="row">
            <div class="col">
              {{-- @livewire('manager.status', ['student' => $student]) --}}
            </div>
          </div>
        </div>
      </div>





      <div class="row card ">
        <div class="card-header ">
          {{-- <h4 class="card-title">{{__('public.payments')}} - <small class="description">{{$payments->sum('amount')}}
              {{__('public.currency')}}</small></h4> --}}
        </div>
        <div class="card-body ">
          <div class="row">
            <div class="col">
              {{-- @livewire('manager.payments', ['student' => $student]) --}}
            </div>
          </div>
        </div>
      </div>



      <div class="row card ">
        <div class="card-header ">
          <h5 class="card-title">

            {{__('public.lessons')}} : {{$student->lessons->count()}}

            <div class="pull-left">
              <button data-target="#add-lesson" data-toggle="modal" class="btn btn-warning btn-sm"> <i
                  class="fa fa-plus"></i> اضافة درس</button>

              <div class="modal fade" id="add-lesson" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form action="{{route('manager.lessons.store')}}" method="POST">
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    @csrf
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافة درس</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button> --}}
                      </div>
                      <div class="modal-body">

                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">التاريخ:</label>
                          <input required name="lesson_at"
                            value="{{old('lesson_at', $object->lesson_at ?? Carbon\Carbon::now()->format('d/m/Y H:i'))}}"
                            -readonly placeholder="{{__('public.lesson_at')}}" type="text"
                            class="form-control time-mask -datepicker {{ $errors->has('lesson_at') ? ' is-invalid' : '' }}">


                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">السيارة:</label>
                          <select name="car_id" id="car_id" class="form-control">
                            @foreach ($cars as $car)
                              <option value="{{$car->id}}" {{@$car->id == @$student->lessons->last()->car_id ? 'selected' : ''}}>{{$car->title}}</option>



                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">المدرب:</label>
                          <select name="trainer_id" id="trainer_id" class="form-control">
                            @foreach ($trainers as $trainer)
                              <option value="{{$trainer->id}}" {{$student->drivingtrainer_id == $trainer->id ? 'selected' : ''}}>{{$trainer->user->name}}</option>



                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">ملاحظات:</label>
                          <input name="notes" value="{{old('notes', $object->notes ?? '')}}"
                            placeholder="{{__('public.notes')}}" type="text"
                            class="form-control {{ $errors->has('notes') ? ' is-invalid' : '' }}">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ الدرس</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

            </div>

          </h5>

        </div>
        <div class="card-body ">
          <div class="row">
            <div class="col">

              <table class="table">
                <tr>
                  <td></td>
                  <td>تاريخ الدرس</td>
                  <td>السيارة</td>
                  <td>المدرب</td>
                  <td>ملاحظات</td>
                </tr>

                @foreach($student->lessons as $lesson)
                  <tr class="{{$lesson->rowClass($loop->iteration) }}">

                    <td>
                      <form action="{{ route('manager.lessons.' . 'destroy', $lesson->id) }}" method="post">
                        @method('delete')
                        @csrf

                        <button type="submit" onclick="return confirm('هل تريد الحذف بالتأكيد؟')"
                          class="btn btn-warning btn-sm"><i class="fa fa-times"></i></button>

                      </form>
                    </td>
                    <td>{{$loop->iteration}} - {{$lesson->lesson_at}}</td>
                    <td>{{$lesson->car->title}}</td>
                    <td>{{$lesson->trainer->user->name}}</td>
                    <td data-id="{{$lesson->id}}">{{$lesson->notes}}</td>
                  </tr>


                @endforeach
              </table>
            </div>
          </div>
        </div>
      </div>

      {{-- <div class="col-md-3">
        <ul class="nav nav-pills nav-pills-primary flex-column" role="tablist">
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#payments" role="tablist">
              {{__('public.lessons')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#link5" role="tablist">
              {{__('public.payments')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#link6" role="tablist">
              النظري
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#link7" role="tablist">
              الامتحانات
            </a>
          </li>
        </ul>
      </div> --}}
      {{-- <div class="col-md-9">
        <div class="tab-content">
          <div class="tab-pane" id="payments">

          </div>
          <div class="tab-pane active" id="link5">

          </div>
          <div class="tab-pane" id="link6">

          </div>
          <div class="tab-pane" id="link7">

          </div>

        </div>
      </div> --}}
      {{--
    </div> --}}
    {{--
  </div>
  </div> --}}
  </div>
  </div>


@endsection