@extends('layouts.account')

@section('content')



  <form action="{{ route($route . 'index') }}" method="post">
    @csrf

    <input type="hidden" name="created_at" value="{{ \Carbon\Carbon::now() }}">

    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h6 class="title">
              <h4>اختبار جديد</h4>

              <div class="text-center">
                @if($questions->count() == 0)
                  <h3>تهانينا، لقد أنهيت كل الاختبارات</h3>
                  <h4>إذا أردت الاستمرار بالتدريب اضغط الزر التالي</h4>
                  <a href="{{route($route . 'create')}}?ignore_old=yes" class="btn btn-warning"> اختبار جديد مع تجاهل تكرار
                    الأسئلة</a>

                @endif
              </div>


            </h6>

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table -table-hover -table-striped">
                <thead class="text-primary">
                  <th class="-text-left"></th>

                </thead>
                <tbody>
                  @foreach ($questions as $question)


                    <tr>
                      <td class="-text-left">
                        @if($student->exam_type == 'oral')

                          <audio controls style="width: 100px">

                            <source src="{{url('uploads/questions/' . $question->oral_sound)}}.mp3" type="audio/mp3">


                            Your browser does not support the audio element.

                          </audio>

                        @endif
                        <strong>{{$loop->iteration}} - {{$question->question}}</strong>
                        @foreach($question->images as $image)


                          <figure class="figure border border-dark">
                            <img src="{{asset('uploads/signs/' . $image)}}.png" alt="{{$image}}" class="figure-img -img-fluid"
                              width="50">
                            <figcaption class="figure-caption text-center text-dark">{{$image}}</figcaption>
                          </figure>

                        @endforeach

                        <br>
                        <br>

                        {{-- <span class="@if($question->true_answer==1) text-success @endif">{{$question->answer1}}</span>
                        <br>
                        <span class="@if($question->true_answer==2) text-success @endif">{{$question->answer2}}</span>
                        <br>
                        <span class="@if($question->true_answer==3) text-success @endif">{{$question->answer3}}</span>
                        <br>
                        <span class="@if($question->true_answer==4) text-success @endif">{{$question->answer4}}</span>
                        --}}


                        <div class="radiobtn">

                          <input type="radio" class="custom-control-input" id="radio-{{$question->id}}-1"
                            name="answer[{{$question->id}}]" value="1">
                          <label for="radio-{{$question->id}}-1">{{$question->answer1}}

                            @if($student->exam_type == 'oral')
                              <audio controls style="width: 100px; display: inline">
                                <source src="{{url('uploads/answers/' . $question->oral_sound . '-1')}}.mp3" type="audio/mp3">
                                Your browser does not support the audio element.
                              </audio>
                            @endif
                          </label>
                        </div>

                        <div class="radiobtn">

                          <input type="radio" class="custom-control-input" id="radio-{{$question->id}}-2"
                            name="answer[{{$question->id}}]" value="2">

                          <label for="radio-{{$question->id}}-2">{{$question->answer2}}
                            @if($student->exam_type == 'oral')
                              <audio controls style="width: 100px; display: inline">
                                <source src="{{url('uploads/answers/' . $question->oral_sound . '-2')}}.mp3" type="audio/mp3">
                                Your browser does not support the audio element.
                              </audio>

                            @endif
                          </label>

                        </div>


                        @if($student->exam_type == 'written')
                          <div class="radiobtn">
                            <input type="radio" class="custom-control-input" id="radio-{{$question->id}}-3"
                              name="answer[{{$question->id}}]" value="3">
                            <label for="radio-{{$question->id}}-3">{{$question->answer3}}</label>
                          </div>

                          <div class="radiobtn">
                            <input type="radio" class="custom-control-input" id="radio-{{$question->id}}-4"
                              name="answer[{{$question->id}}]" value="4">
                            <label for="radio-{{$question->id}}-4">{{$question->answer4}}</label>
                          </div>
                        @endif


                        {{-- <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary active">
                            <input type="radio" name="options" id="option1" autocomplete="off" checked> Radio 1
                            (preselected)
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="options" id="option2" autocomplete="off"> Radio 2
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="options" id="option3" autocomplete="off"> Radio 3
                          </label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="radio-{{$question->id}}-1"
                            name="answer[{{$question->id}}]" value="1">
                          <label class="custom-control-label text-dark" for="radio-{{$question->id}}-1">
                            {{$question->answer1}}
                          </label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="radio-{{$question->id}}-2"
                            name="answer[{{$question->id}}]" value="2">
                          <label class="custom-control-label text-dark" for="radio-{{$question->id}}-2">
                            {{$question->answer2}}
                          </label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="radio-{{$question->id}}-3"
                            name="answer[{{$question->id}}]" value="3">
                          <label class="custom-control-label text-dark" for="radio-{{$question->id}}-3">
                            {{$question->answer3}}
                          </label>
                        </div>

                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="radio-{{$question->id}}-4"
                            name="answer[{{$question->id}}]" value="4">
                          <label class="custom-control-label text-dark" for="radio-{{$question->id}}-4">
                            {{$question->answer4}}
                          </label>
                        </div> --}}











                        {{-- <span class=""></span>
                        <br>
                        <span class="">{{$question->answer2}}</span>
                        <br>
                        <span class="">{{$question->answer3}}</span>
                        <br>
                        <span class="">{{$question->answer4}}</span> --}}
                      </td>


                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-warning">اظهار النتيجة</button>

            </div>
            {{-- {{$questions->links()}} --}}
          </div>
        </div>
      </div>

    </div>

  </form>
@endsection


@section('css')
  <style>
    .radiobtn {
      position: relative;
      display: block;
    }

    .radiobtn label {
      display: block;
      background: #d5edf8;
      color: #444;
      border-radius: 5px;
      padding: 10px 40px;
      border: 2px solid #b7dffa;
      margin-bottom: 5px;
      cursor: pointer;
    }

    .radiobtn label:after,
    .radiobtn label:before {
      content: "";
      position: absolute;
      right: 11px;
      top: 11px;
      width: 20px;
      height: 20px;
      border-radius: 3px;
      background: #d5edf8;
    }

    .radiobtn label:before {
      background: transparent;
      -webkit-transition: 0.1s width cubic-bezier(0.075, 0.82, 0.165, 1) 0s, 0.3s height cubic-bezier(0.075, 0.82, 0.165, 2) 0.1s;
      transition: 0.1s width cubic-bezier(0.075, 0.82, 0.165, 1) 0s, 0.3s height cubic-bezier(0.075, 0.82, 0.165, 2) 0.1s;
      z-index: 2;
      overflow: hidden;
      background-repeat: no-repeat;
      background-size: 13px;
      background-position: center;
      width: 0;
      height: 0;
      background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNS4zIDEzLjIiPiAgPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE0LjcuOGwtLjQtLjRhMS43IDEuNyAwIDAgMC0yLjMuMUw1LjIgOC4yIDMgNi40YTEuNyAxLjcgMCAwIDAtMi4zLjFMLjQgN2ExLjcgMS43IDAgMCAwIC4xIDIuM2wzLjggMy41YTEuNyAxLjcgMCAwIDAgMi40LS4xTDE1IDMuMWExLjcgMS43IDAgMCAwLS4yLTIuM3oiIGRhdGEtbmFtZT0iUGZhZCA0Ii8+PC9zdmc+);
    }

    .radiobtn input[type="radio"] {
      display: none;
      position: absolute;
      width: 100%;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }

    .radiobtn input[type="radio"]:checked+label {
      background: #d5edf8;
      -webkit-animation-name: blink;
      animation-name: blink;
      -webkit-animation-duration: 1s;
      animation-duration: 1s;
      border-color: #55b7f8;
    }

    .radiobtn input[type="radio"]:checked+label:after {
      background: #55b7f8;
    }

    .radiobtn input[type="radio"]:checked+label:before {
      width: 20px;
      height: 20px;
    }


    @keyframes blink {
      0% {
        background-color: #d5edf8;
      }

      10% {
        background-color: #d5edf8;
      }

      11% {
        background-color: #6d98f3;
      }

      29% {
        background-color: #6d98f3;
      }

      30% {
        background-color: #d5edf8;
      }

      50% {
        background-color: #6d98f3;
      }

      45% {
        background-color: #d5edf8;
      }

      50% {
        background-color: #6d98f3;
      }

      100% {
        background-color: #d5edf8;
      }
    }
  </style>
@endsection
@section('js')
  <script>
    $(document).ready(function () {
      // Initialise Sweet Alert library


    });
    function showSwal(type) {
      if (type == 'basic') {
        Swal.fire({
          title: "Here's a message!",
          buttonsStyling: false,
          confirmButtonClass: "btn btn-success"
        });

      } else if (type == 'title-and-text') {
        Swal.fire({
          title: "Here's a message!",
          text: "It's pretty, isn't it?",
          buttonsStyling: false,
          confirmButtonClass: "btn btn-info"
        });

      } else if (type == 'success-message') {
        Swal.fire({
          title: "Good job!",
          text: "You clicked the button!",
          buttonsStyling: false,
          confirmButtonClass: "btn btn-success",
          type: "success"
        });

      } else if (type == 'warning-message-and-confirmation') {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          confirmButtonText: 'Yes, delete it!',
          buttonsStyling: false
        }).then((result) => {
          if (result.value) {
            Swal.fire({
              title: 'Deleted!',
              text: 'Your file has been deleted.',
              type: 'success',
              confirmButtonClass: 'btn btn-success',
              buttonsStyling: false
            });
          }
        })
      } else if (type == 'warning-message-and-cancel') {
        const swalWithBootstrapButtons = Swal.mixin({
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false,
        })

        swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
          } else if (
            // Read more about handling dismissals
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
          }
        })

      } else if (type == 'custom-html') {
        Swal.fire({
          title: 'HTML example',
          buttonsStyling: false,
          confirmButtonClass: "btn btn-success",
          html: 'You can use <b>bold text</b>, ' +
            '<a href="http://github.com">links</a> ' +
            'and other HTML tags'
        });

      } else if (type == 'auto-close') {
        Swal.fire({
          title: "Auto close alert!",
          text: "I will close in 2 seconds.",
          timer: 2000,
          showConfirmButton: false
        });
      } else if (type == 'input-field') {
        Swal.fire({
          title: 'اكتب سبب الاعتراض',
          html: '<div class="form-group">' +
            '<input id="input-field" type="text" class="form-control" />' +
            '</div>',
          showCancelButton: true,
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false
        }).then(function (result) {
          // Swal.fire({
          //   type: 'success',
          //   html: 'You entered: <strong>' +
          //     $('#input-field').val() +
          //     '</strong>',
          //   confirmButtonClass: 'btn btn-success',
          //   buttonsStyling: false

          // });
        });
      }
    }
  </script>
@endsection