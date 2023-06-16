@extends('layouts/app', ['activePage' => 'login', 'title' => 'U-Election'])

@section('content')
    <div class="full-page section-image" data-color="black" data-image="{{ asset('light-bootstrap/img/full-screen-image-2.jpg') }}">
        <div class="content pt-5">
            <div class="container mt-5">    
                <div class="col-md-4 col-sm-6 ml-auto mr-auto">
                    <form class="form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card card-login card-hidden">
                            <div class="card-header ">
                                <h3 class="header text-center">{{ __('Login U-Election') }}</h3>
                            </div>
                            <div class="card-body ">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="student_id" class="col-md-6 col-form-label">{{ __('Student Id') }}</label>
            
                                        <div class="col-md-14">
                                            <input id="student_id" type="student_id" class="form-control @error('student_id') is-invalid @enderror" name="student_id" value="{{ old('student_id', '1234') }}" required autocomplete="student_id" autofocus>
            
                                            @error('student_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-md-6 col-form-label">{{ __('Password') }}</label>
                
                                            <div class="col-md-14">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', 'secret') }}" required autocomplete="current-password">
                
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="security_number" class="col-md-6 col-form-label">{{ __('Security Number') }}</label>
                
                                            <div class="col-md-14">
                                                <input id="security_number" type="text" class="form-control @error('security_number') is-invalid @enderror" name="security_number" value="{{ old('security_number', '1234') }}" required autocomplete="security_number">
                
                                                @error('security_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label d-flex align-items-center">
                                                        <input class="form-check-input" type="checkbox" name="remember"  id="remember">
                                                        <span class="form-check-sign"></span>
                                                        {{ __('Remember me') }}
                                                    </label>
                                                </div>
                                            </div> 
                                            <div class="form-group ml-auto">
                                                <div class="form-check">
                                                    <a class="btn btn-link"  style="color:#23CCEF" href="{{ route('admin.login') }}">
                                                        {{ __('Admin Login') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="card-footer ml-auto mr-auto">
                                    <div class="container text-center" >
                                        <button type="submit" class="btn btn-warning btn-wd">{{ __('Login') }}</button>
                                    </div>
                                    <!-- <div class="d-flex justify-content-between">
                                        <a class="btn btn-link"  style="color:#23CCEF" href="{{ route('user.fp') }}">
                                        {{ __('Forgot Password') }}
                                        </a>
                                        <a class="btn btn-link" style="color:#23CCEF" href="{{ route('user.fsn') }}">
                                            {{ __('Security Number') }}
                                        </a>
                                    </div> -->
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            demo.checkFullPageBackgroundImage();

            setTimeout(function() {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
@endpush