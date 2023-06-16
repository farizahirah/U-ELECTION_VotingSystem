@extends('layouts.app', ['activePage' => 'buletin-new-index', 'title' => 'U-Election', 'navName' => 'Edit Buletin New', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Edit Buletin News</h4>
                        <p class="card-category"></p>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form name="create-buletin-new" id="create-buletin-new" method="post" action="{{route('buletin_new.update' , collect($buletinNew)->first())}}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4 pr-lg-4">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Your Title Here" value="{{$buletinNew->title}}" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Sub Title</label>
                                    <input type="text" class="form-control" name="sub_title" placeholder="Enter Your Sub Title Here" value="{{$buletinNew->sub_title}}">
                                </div> -->
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter Your Description Here" rows="3" style="height: 237px;">
                                    {{$buletinNew->description}}
                                    </textarea>
                                </div>
                                <!-- <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Document</label>
                                        <input type="file" class="form-control-file" name="document">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <br>
                                        <div class="pl-lg-4 row mt-2">
                                            <div class="form-check form-check-radio col-md-6">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="show" checked>
                                                    <span class="form-check-sign"></span>
                                                    Show
                                                </label>
                                            </div>
                                            
                                            <div class="form-check form-check-radio col-md-6">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="hide">
                                                    <span class="form-check-sign"></span>
                                                    Hide
                                                </label>
                                            </div>
                                        </div>
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