@extends('layouts.app', ['activePage' => 'feedback-index', 'title' => 'U-Election', 'navName' => 'View Feedback', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">View Feedback</h4>
                        <p class="card-category"></p>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <div class="pl-lg-4 pr-lg-4">
                            <div class="form-group">
                                <label>Title</label>
                                <p>{{$feedback->feedback_header}}</p>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label>Feedback Description</label>
                                <p>{{$feedback->feedback_body}}</p>
                                <hr>
                            </div>
                            <div class="form-group">
                                <label>Written By</label>
                                @if ($feedback->user_id == 0)
                                    <p>Anonymous</p>
                                @else
                                    <p>{{$feedback->user->name}}</p>
                                @endif
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection