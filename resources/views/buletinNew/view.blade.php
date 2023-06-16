@extends('layouts.app', ['activePage' => 'buletin-new-index', 'title' => 'U-Election', 'navName' => 'View Buletin New', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">View Buletin News</h4>
                        <p class="card-category"></p>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <div class="pl-lg-4 pr-lg-4">
                            <div class="form-group">
                                <label>Title</label>
                                <p>{{$buletinNew->title}}</p>
                                <hr>
                            </div>
                            <!-- <div class="form-group">
                                <label>Sub Title</label>
                                <p>{{$buletinNew->sub_title}}</p>
                                <hr>
                            </div> -->
                            <div class="form-group">
                                <label>Description</label>
                                <p>{{$buletinNew->description}}</p>
                                <hr>
                            </div>
                            <!-- <div class="form-group">
                                <label>Status</label>
                                <p>{{$buletinNew->status}}</p>
                                <hr>
                            </div> -->
                            <!-- <div class="form-group">
                                <label>Created At</label>
                                <p>{{$buletinNew->created_at}}</p>
                                <hr>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection