@extends('layouts.app', ['activePage' => 'candidate', 'title' => 'U-Election', 'navName' => 'Candidate List', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Candidate</h4>
                        <p class="card-category">Selected Candidate</p>
                    </div>
                    <div class="card-body">
                        <div class="container p-4">
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
                                            <p class="description text-left">
                                                <b>Programme:</b> {{ $candidate->user->programme }}
                                            </p>
                                            @endif
                                            <p class="description text-left">
                                                <b>Motto:</b> {{ $candidate->motto }}
                                                <br> 
                                                <br>
                                                <b>Achievement:</b> {{ $candidate->achievement }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
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