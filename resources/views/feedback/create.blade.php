@extends('layouts.app', ['activePage' => 'feedback-index', 'title' => 'U-Election', 'navName' => 'Create New Feedback', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Create New Feedback</h4>
                        <p class="card-category"></p>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form name="create-feedback" id="create-feedback" method="post" action="{{route('feedback.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4 pr-lg-4">
                                <!-- <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="feedback_header" placeholder="Enter Your Feedback Header Here" required>
                                </div> -->
                                <div class="form-group">
                                    <label>Feedback Description</label>
                                    <textarea class="form-control" name="feedback_body" placeholder="Enter Your Feedback Description Here" rows="3" style="height: 237px;"></textarea>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Do You Want To Stay Anonymous?</label>
                                        <br>
                                        <div class="pl-lg-4 row mt-2">
                                            <div class="form-check form-check-radio col-md-3">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
                                                    <span class="form-check-sign"></span>
                                                    Yes
                                                </label>
                                            </div>
                                            
                                            <div class="form-check form-check-radio col-md-3">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0">
                                                    <span class="form-check-sign"></span>
                                                    No
                                                </label>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                </div> -->
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