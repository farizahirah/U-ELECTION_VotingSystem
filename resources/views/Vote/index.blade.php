@extends('layouts.app', ['activePage' => 'vote', 'title' => 'U-Election', 'navName' => 'Vote List', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Vote List</h4>
                        <p class="card-category"></p>
                        @if (Auth::user()->role_id == 1)
                        <a class="btn btn-sm btn-default btn-fill float-right" href="{{route('vote.create')}}">
                            Add <i class="nc-icon nc-simple-add"></i>
                        </a>
                        @endif
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>No</th>
                                <th>Title</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($votes as $vote)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$vote->title}}</td>
                                        <td>{{date('d-m-Y h:i:s A', strtotime($vote->start))}}</td>
                                        <td>{{date('d-m-Y h:i:s A', strtotime($vote->end))}}</td>
                                        <td>
                                            <div class="row text-center">
                                                @php
                                                    date_default_timezone_set("Asia/Kuala_Lumpur");
                                                @endphp
                                                @if (Auth::user()->role_id == 2)
                                                @if (date('Y-m-d H:i:s', strtotime(now())) >= date('Y-m-d H:i:s', strtotime($vote->end)))
                                                
                                                    Vote Close 
                                                    <!-- {{date('m-d-Y H:i:s', strtotime(now()))}} {{date('m-d-Y H:i:s', strtotime($vote->end))}} -->
                                                @else
                                                    <div class="col-md-4">
                                                        <a class="btn btn-info btn-fill" href="{{ route('vote.votes', ['id'=> $vote->id] ) }}">
                                                            <i class="nc-icon nc-tap-01" title="Vote Here!"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                                @endif
                                                
                                                @if (Auth::user()->role_id == 1)
                                                <div class="col-md-4">
                                                    <a class="btn btn-warning btn-fill" href="{{ route('vote.edit', collect($vote)->first() ) }}">
                                                        <i class="nc-icon nc-ruler-pencil" title="edit vote"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a class="btn btn-danger btn-fill" href="#" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('vote.delete', collect($vote)->first() ) }}">
                                                        <i class="nc-icon nc-simple-remove" title="delete vote"></i>
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