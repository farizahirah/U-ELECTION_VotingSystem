@extends('layouts.app', ['activePage' => 'vote', 'title' => 'U-Election', 'navName' => 'Voting Page', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Select Candidate:</h4>
                        <p class="card-category">1 Vote for 1 Candidate</p>
                        @if(session('success'))
                            <div class="alert alert-info alert-with-icon float-right" data-notify="container">
                                <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                    <i class="nc-icon nc-simple-remove"></i>
                                </button>
                                <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                                <span data-notify="message">{{ session('success') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="container p-4">
                            <form name="add-voting" id="add-voting" method="post" action="{{route('vote.storeVoting')}}" enctype="multipart/form-data">
                                @csrf
                                
                            <div class="row">
                                @foreach ($candidates as $candidate)
                                <div class="col-md-4">
                                    <div class="card card-user">
                                        <div class="card-image">
                                        </div>
                                        <div class="card-body">
                                            <div class="author">
                                                <a href="#">
                                                    @if($candidate->user->photo != null)
                                                        <img class="avatar border-gray" src="{!! asset('archieve/user/'.$candidate->user->email.'/'.$candidate->user->photo) !!}" alt="...">                                            </a>
                                                    @else
                                                        <img class="avatar border-gray" src="{!! asset('archieve/noimage.jpg') !!}" alt="...">
                                                    @endif
                                                    <h5 class="title">{{ $candidate->user->name }}</h5>
                                                </a>
                                            </div>
                                            @if (isset($candidate->user->programme))
                                            <p class="description text-center">
                                                {{ $candidate->user->programme }}
                                            </p>
                                            @endif
                                            <p class="description text-center">
                                                <b>{{ $candidate->motto }}</b>
                                                <br> 
                                                {{ $candidate->achievement }}
                                            </p>
                                                <div class="form-check text-center">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="vote[]" value="{{ $candidate->id }}">
                                                            <span class="form-check-sign"></span> 
                                                            Check To Vote This Candidate!
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                        
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="vote_detail" value="{{ $id }}">
                                <button type="submit" class="btn btn-primary btn-fill">Vote!</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection