@extends('layouts.app', ['activePage' => 'buletin-new-index', 'title' => 'U-Election', 'navName' => 'Buletin News', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">News List</h4>
                        <p class="card-category"></p>
                        @if (Auth::user()->role_id == 1)
                        <a class="btn btn-sm btn-default btn-fill float-right" href="{{route('buletin_new.create')}}">
                            Add <i class="nc-icon nc-simple-add"></i>
                        </a>
                        @endif
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>No</th>
                                <!-- <th>Time and Date</th> -->
                                <th>Title</th>
                                <!-- <th>Sub Title</th> -->
                                <th>Description</th>
                                <!-- <th>Document</th>
                                <th>Status</th> -->
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($buletin_news as $bn)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <!-- <td>{{$bn->created_at}}</td> -->
                                    <td>{{$bn->title}}</td>
                                    <!-- <td>{{$bn->sub_title}}</td> -->
                                    <td>{{$bn->description}}</td>
                                    <!-- <td>
                                        @if($bn->document != null)
                                            <a href="{!! asset('archieve/buletin_new/'.$bn->title.'/'.$bn->document) !!}" target="_blank">Download</a>
                                        @endif
                                    </td>
                                    <td>{{$bn->status}}</td> -->
                                    <td>
                                        <div class="row text-center">
                                            @if (Auth::user()->role_id == 2)
                                            <div class="col-md-4">
                                                <a class="btn btn-info btn-fill" href="{{ route('buletin_new.view', collect($bn)->first() ) }}">
                                                    <i class="nc-icon nc-tap-01" title="view Buletin"></i>
                                                </a>
                                            </div>
                                            @endif
                                            
                                            @if (Auth::user()->role_id == 1)
                                            <div class="col-md-4">
                                                <a class="btn btn-warning btn-fill" href="{{ route('buletin_new.edit', collect($bn)->first() ) }}">
                                                    <i class="nc-icon nc-ruler-pencil" title="edit Buletin"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <a class="btn btn-danger btn-fill" href="#" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('buletin_new.delete', collect($bn)->first() ) }}">
                                                    <i class="nc-icon nc-simple-remove" title="delete Buletin"></i>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="deleteLabel">Delete Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this Item? This operation is irreversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a  type="button" class="btn btn-danger Remove_square">Delete</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#delete_confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var $recipient = button.data('id');
            var modal = $(this);
            modal.find('.modal-footer a').prop("href",$recipient);
        })
    });
</script>
@endsection