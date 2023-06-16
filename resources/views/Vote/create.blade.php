@extends('layouts.app', ['activePage' => 'vote', 'title' => 'U-Election', 'navName' => 'Create New Voting', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Create Voting</h4>
                        <p class="card-category"></p>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form name="create-buletin-new" id="create-buletin-new" method="post" action="{{route('vote.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4 pr-lg-4">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Your Title Here" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="datetime-local" class="form-control" name="start" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="datetime-local" class="form-control" name="end" required>
                                        </div>
                                    </div>
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