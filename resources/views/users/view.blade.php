@extends('layouts.app', ['activePage' => 'user-management', 'title' => 'U-Election', 'navName' => 'View User Profile', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="section-image">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="row">

                    <div class="card col-md-8">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h3 class="mb-0">{{ __('View User Profile') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Full Name</label>
                                <p>{{$user->name}}</p>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <p>{{$user->email}}</p>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label>Programme</label>
                                <p>{{$user->programme}}</p>
                                <hr>                    
                            </div>        
                            <div class="form-group">
                                <label>Student Id</label>
                                <p>{{$user->student_id}}</p>
                                <hr>
                            </div>                           
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="card-image">
                            </div>
                            <div class="card-body">
                                <div class="author">
                                    <a href="#">
                                        @if(Auth::user()->photo != null)
                                            <img class="avatar border-gray" src="{!! asset('archieve/user/'.Auth::user()->email.'/'.Auth::user()->photo) !!}" alt="...">                                            
                                        @else
                                            <img class="avatar border-gray" src="{!! asset('archieve/noimage.jpg') !!}" alt="...">
                                        @endif
                                        <h5 class="title">{{ Auth::user()->name }}</h5>
                                    </a>
                                    <p class="description">
                                        {{ Auth::user()->student_id }}
                                    </p>
                                </div>
                                <p class="description text-center">
                                    {{ Auth::user()->email }}
                                    <br>
                                    {{ Auth::user()->programme }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection