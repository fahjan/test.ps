@extends('layouts.account')

@section('css')
    <style>
        audio {
            width: 100%;
        }
    </style>
@endsection
@section('content')



<div class="row">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="title">
                    <h4>{{__('public.signs')}}</h4>
                    
                </h6>
            </div>
            <div class="card-body">

                <div class="row">
                    @foreach ($signs as $sign)
                              
                    <div class="col-md-3">
                        <div class="card" style="">
                            <img src="{{$sign->image}}" class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">({{$sign->number}}) - {{$sign->title}}</h5>
                              <p class="card-text">{{$sign->description}}</p>
                              {{-- <button type="button" class="btn btn-primary"> <i class="fa fa-play"></i> </button> --}}
                              <audio controls>

                                <source src="{{$sign->sound}}ogg" type="audio/ogg">

                                <source src="{{$sign->sound}}aac" type="audio/aac">

                              Your browser does not support the audio element.

                                </audio>
                            </div>
                          </div>
                        <img src="" alt="">
                    </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
    
</div>

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