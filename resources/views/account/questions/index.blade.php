@extends('layouts.account')

@section('content')



  <form action="{{ route($route . 'index') }}" method="get">


    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h6 class="title">
              <h4>بنك الأسئلة</h4>
              {{-- <button class="btn btn-info float-right" aria-expanded="false" aria-controls="collapseExample"
                data-toggle="collapse" data-target="#collapseExample" type="button">بحث</button> --}}
              <div class="-collapse" id="collapseExample">
                <div class="card card-body">
                  {{-- <input type="text" name="title" value="request('title')" placeholder=""> --}}
                  <input type="text" name="title" value="{{ old('title', request('title')) }}"
                    placeholder="نص السؤال أو جزء منه" class="form-control">

                  <label for="written">
                    <input type="radio" name="category" id="writing" value="writing" {{request('category') == 'written' ? 'checked' : ''}}>
                    {{__('public.written')}}
                  </label>
                  <label for="oral">
                    <input type="radio" name="category" id="oral" value="oral" {{request('category') == 'oral' ? 'checked' : ''}}>

                    {{__('public.oral')}}
                  </label>
                  <label for="minioral">
                    <input type="radio" name="category" id="minioral" value="minioral" {{request('category') == 'minioral' ? 'checked' : ''}}>{{__('public.minioral')}}
                  </label>
                  <br>

                  @foreach($licenses as $license)
                    <label for="license_id">
                      <input type="radio" name="license_id" id="license_id" value="{{ $license->id }}"
                        {{request('license_id') == $license->id ? 'checked' : ''}}>


                      {{$license->title}}
                    </label>
                  @endforeach
                  <br>
                  @foreach($types as $type)
                    <label>
                      <input type="radio" name="type_id" id="type_id" value="{{ $type->id }}" {{request('typeid') == $type->id ? 'checked' : ''}}>

                      {{$type->title}}
                    </label>
                  @endforeach

                  <div class="card-footer">
                    <button type="submit" class="btn btn-info pull-left"> <i class="fa fa-search"></i> </button>
                  </div>
                </div>

              </div>
            </h6>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="text-primary">
                  <th class="-text-left"></th>
                  <th></th>
                  <th></th>

                </thead>
                <tbody>
                  @foreach ($questions as $question)


                    <tr>
                      <td class="-text-left">
                        @if($question->category == 'oral')
                          <audio controls style="width: 100px; display: inline">
                            <source src="{{url('uploads/questions/' . $question->oral_sound . '')}}.mp3" type="audio/mp3">
                            Your browser does not support the audio element.
                          </audio>
                        @endif
                        <span onclick="copyTextToClipboard('{{$question->question}}')">
                          <strong>{{ (15 * request('page') ?? 0) + $loop->iteration - 15}} -
                            {{$question->question}}</strong>
                        </span>





                        @foreach($question->images as $image)

                          {{-- <div class="card">
                            <img src="{{asset('uploads/signs/'. $image)}}.png" alt="{{$image}}" class="figure-img -img-fluid"
                              width="50">
                            <div class="card-body">
                              <h5 class="card-title">{{$image}}</h5>

                            </div>
                          </div> --}}
                          <figure class="figure border border-dark">
                            <img src="{{asset('uploads/signs/' . $image)}}.png" alt="{{$image}}" class="figure-img -img-fluid"
                              width="50">
                            <figcaption class="figure-caption text-center text-dark">{{$image}}</figcaption>
                          </figure>




                        @endforeach

                        <br>

                        @if($question->category == 'oral')
                          <audio controls style="width: 100px; display: inline">
                            <source src="{{url('uploads/answers/' . $question->oral_sound . '-1')}}.mp3" type="audio/mp3">
                            Your browser does not support the audio element.
                          </audio>
                        @endif
                        <span onclick="copyTextToClipboard('{{$question->answer1}}')"
                          class="@if($question->true_answer == 1) text-success @endif">{{$question->answer1}}</span>
                        <br>
                        @if($question->category == 'oral')
                          <audio controls style="width: 100px; display: inline">
                            <source src="{{url('uploads/answers/' . $question->oral_sound . '-2')}}.mp3" type="audio/mp3">
                            Your browser does not support the audio element.
                          </audio>
                        @endif
                        <span onclick="copyTextToClipboard('{{$question->answer2}}')"
                          class="@if($question->true_answer == 2) text-success @endif">{{$question->answer2}}</span>
                        <br>
                        <span class="@if($question->true_answer == 3) text-success @endif">{{$question->answer3}}</span>
                        <br>
                        <span class="@if($question->true_answer == 4) text-success @endif">{{$question->answer4}}</span>



                      </td>
                      <td>
                        <label class="text-danger"> {{__('public.' . $question->category)}} </label>
                        <label class="text-info">{{$question->type->title}}</label>
                        <label class="text-secondary">{{$question->license->title}}</label>

                      </td>
                      <td class="text-right">
                        <button type="button" onclick="showSwal('input-field')" rel="tooltip" title="تقديم اعتراض"
                          class="btn btn-warning btn-sm ">
                          <i class="fa fa-bug"></i>
                        </button>
                        {{-- <button type="button" rel="tooltip" class="btn btn-success btn-icon btn-sm ">
                          <i class="now-ui-icons ui-2_settings-90"></i>
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm ">
                          <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button> --}}
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-center">
              {{$questions->links()}}
            </div>

          </div>
        </div>
      </div>

    </div>

  </form>
@endsection


@section('js')
  <script>
    function copyTextToClipboard(text) {
      var textArea = document.createElement("textarea");

      //
      // *** This styling is an extra step which is likely not required. ***
      //
      // Why is it here? To ensure:
      // 1. the element is able to have focus and selection.
      // 2. if the element was to flash render it has minimal visual impact.
      // 3. less flakyness with selection and copying which **might** occur if
      //    the textarea element is not visible.
      //
      // The likelihood is the element won't even render, not even a
      // flash, so some of these are just precautions. However in
      // Internet Explorer the element is visible whilst the popup
      // box asking the user for permission for the web page to
      // copy to the clipboard.
      //

      // Place in the top-left corner of screen regardless of scroll position.
      textArea.style.position = 'fixed';
      textArea.style.top = 0;
      textArea.style.left = 0;

      // Ensure it has a small width and height. Setting to 1px / 1em
      // doesn't work as this gives a negative w/h on some browsers.
      textArea.style.width = '2em';
      textArea.style.height = '2em';

      // We don't need padding, reducing the size if it does flash render.
      textArea.style.padding = 0;

      // Clean up any borders.
      textArea.style.border = 'none';
      textArea.style.outline = 'none';
      textArea.style.boxShadow = 'none';

      // Avoid flash of the white box if rendered for any reason.
      textArea.style.background = 'transparent';


      textArea.value = text;

      document.body.appendChild(textArea);
      textArea.focus();
      textArea.select();

      try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
      } catch (err) {
        console.log('Oops, unable to copy');
      }

      document.body.removeChild(textArea);
    }

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