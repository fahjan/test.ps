@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center login-form col-12 col-md-6 col-sm-12 col-xs-12">

            <form method="POST" action="{{ route('login')}}">
                @csrf
                <div class="mb-3">
                    <label for="mobile">رقم الموبايل</label>
                    <input type="number" id="mobile" dir="ltr" class="form-control @error('mobile') is-invalid @enderror"
                        name="mobile" value="{{old('mobile', '05')}}" placeholder="رقم الموبايل كاملا">
                    @error('mobile')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="كلمة المرور">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-black">انطلق الآن</button>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('نسيت كلمة المرور?') }}
                    </a>
                @endif

            </form>
        </div>
    </div>

@endsection