@extends('layouts.account')

@section('content')



<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                
                    <h4 class="card-title float-left">نتيجة الاختبار</h4>
                    <div class="float-right">

                        <div class="btn-group -dropleft" role="group" aria-label="Button group with nested dropdown">
                            <a href="{{route($route . 'create')}}" class="btn btn-secondary">اختبار جديد</a>
                          
                            <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                @foreach($types as $type)
                                <a class="dropdown-item" href="{{route($route . 'create')}}?type_id={{$type->id}}">{{$type->title}}</a>
                                @endforeach
                                
                              </div>
                            </div>
                          </div>
        
                        
                        
                    </div>
                    
                
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table -table-hover -table-striped">
                      <thead class="text-primary">
                        <th class="-text-left"></th>
                        
                      </thead>
                      <tbody>
                          @foreach ($answers as $answer)
                              
                          
                        <tr>
                          <td class="-text-left">
                            <strong>{{$loop->iteration}} ) {{$answer->question->question}}</strong> 

                            
                            @foreach($answer->question->images as $image)

                            
                            <figure class="figure border border-dark">
                                <img src="{{asset('uploads/signs/'. $image)}}.png" alt="{{$image}}" class="figure-img -img-fluid" width="50">
                                <figcaption class="figure-caption text-center text-dark">{{$image}}</figcaption>
                              </figure>                                
                    
                            @endforeach

                            <br>
                            <br>

                            @for($i=1; $i <= 4; $i++)
                            @if($i <= 2 || ($i >= 3 && $student->exam_type=='written'  && $answer->question->answer3!=''))
                            <div class="radiobtn @if($answer->question->true_answer==$i) success @endif @if(!$answer->question->answer->status && $answer->question->answer->answer == $i) danger @endif">
                                <input type="radio" class="custom-control-input" @if($answer->question->true_answer==$i) checked @endif disabled id="radio-{{$answer->question->id}}-{{$i}}" name="answer[{{$answer->question->id}}]" value="{{$i}}">
                                <label for="radio-{{$answer->question->id}}-{{$i}}">{{object_get($answer->question, 'answer'.$i) }} </label>
                            </div>
                            @endif
                            @endfor
                            {{-- <div class="radiobtn">
                                <input type="radio" class="custom-control-input" disabled id="radio-{{$answer->question->id}}-2" name="answer[{{$answer->question->id}}]" value="2">
                                <label for="radio-{{$answer->question->id}}-2">{{$answer->question->answer2}}</label>
                            </div>
                        
                            @if($student->exam_type=='written' && $answer->question->answer3!='')
                            <div class="radiobtn">
                                <input type="radio" class="custom-control-input" disabled id="radio-{{$answer->question->id}}-3" name="answer[{{$answer->question->id}}]" value="3">
                                <label for="radio-{{$answer->question->id}}-3">{{$answer->question->answer3}}</label>
                            </div>
                        
                            <div class="radiobtn">
                                <input type="radio" class="custom-control-input" disabled id="radio-{{$answer->question->id}}-4" name="answer[{{$answer->question->id}}]" value="4">
                                <label for="radio-{{$answer->question->id}}-4">{{$answer->question->answer4}}</label>
                            </div>
                            @endif --}}
                          </td>
                          
                          
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                 
            </div>
        </div>
    </div>
    
</div>

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
.radiobtn.success label {
    border: 2px solid #26ee58 !important;
  background: #d9f3ce !important;

}

.radiobtn.danger label {
    border: 2px solid #ee5526 !important;
  background: #f3d1ce !important;

}

.radiobtn label:after, .radiobtn label:before {
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
.radiobtn input[type="radio"]:checked + label {
  background: #d5edf8;
  -webkit-animation-name: blink;
          animation-name: blink;
  -webkit-animation-duration: 1s;
          animation-duration: 1s;
  border-color: #55b7f8;
}
.radiobtn input[type="radio"]:checked + label:after {
  background: #55b7f8;
}
.radiobtn input[type="radio"]:checked + label:before {
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
  $(document).ready(function() {
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
      }).then(function(result) {
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