@extends('layouts.app', ['activePage' => 'feedback-index', 'title' => 'U-Election', 'navName' => 'Feedback', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Feedback List</h4>
                        <p class="card-category"></p>
                        @if (Auth::user()->role_id == 2)
                        <a class="btn btn-sm btn-default btn-fill float-right" href="{{route('feedback.create')}}">
                            Add <i class="nc-icon nc-simple-add"></i>
                        </a>
                        @endif
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>No</th>
                                <!-- <th>Time and Date</th> -->
                                <!-- <th>Title</th> -->
                                <th>Feedback Description</th>
                                <!-- <th>Action</th> -->
                            </thead>
                            <tbody>
                                @foreach ($feedback as $fb)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <!-- <td>{{$fb->created_at}}</td> -->
                                    <!-- <td>{{$fb->feedback_header}}</td> -->
                                    <td>{{$fb->feedback_body}}</td>
                                    <td>
                                        <div class="row text-center">
                                            <!-- <div class="col-md-4">
                                                <a class="btn btn-info btn-fill" href="{{ route('feedback.view', collect($fb)->first() ) }}">
                                                    <i class="nc-icon nc-tap-01" title="view Feedback"></i>
                                                </a>
                                            </div> -->
                                            @if (Auth::user()->role_id == 1)
                                            <!-- <div class="col-md-4">
                                                <a class="btn btn-warning btn-fill" href="{{ route('feedback.edit', collect($fb)->first() ) }}">
                                                    <i class="nc-icon nc-ruler-pencil" title="edit Feedback"></i>
                                                </a>
                                            </div> -->
                                            <!-- <div class="col-md-4">
                                                <a class="btn btn-danger btn-fill" href="#" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('feedback.delete', collect($fb)->first() ) }}">
                                                    <i class="nc-icon nc-simple-remove" title="delete Feedback"></i>
                                                </a>
                                            </div> -->
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