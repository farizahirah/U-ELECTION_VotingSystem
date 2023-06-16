@extends('layouts.app', ['activePage' => 'feedback-index', 'title' => 'U-Election', 'navName' => 'Edit Feedback', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Edit Feedback</h4>
                        <p class="card-category"></p>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form name="create-feedback" id="create-feedback" method="post" action="{{route('feedback.update' , collect($feedback)->first())}}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4 pr-lg-4">
                                <div class="form-group">
                                    <label>Feedback Header</label>
                                    <input type="text" class="form-control" name="feedback_header" placeholder="Enter Your Title Here" value="{{$feedback->feedback_header}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Feedback Body</label>
                                    <textarea class="form-control" name="feedback_body" placeholder="Enter Your Description Here" value="{{$feedback->feedback_body}}" required style="height: 237px;">
                                    {{$feedback->feedback_body}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-fill">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection