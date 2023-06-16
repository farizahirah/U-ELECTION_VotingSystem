@extends('layouts.app', ['activePage' => 'user-management', 'title' => 'U-Election', 'navName' => 'User Management', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">User List</h4>
                        <p class="card-category"></p>
                        <a class="btn btn-sm btn-default btn-fill float-right" href="{{route('user.create')}}">
                            Add <i class="nc-icon nc-simple-add"></i>
                        </a>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Programme</th>
                                <th>Student Id</th>
                                <th>Security Number</th>
                                <th>Candidate</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if($user->photo != null)
                                            <img class="avatar border-gray" src="{!! asset('archieve/user/'.$user->email.'/'.$user->photo) !!}" alt="...">                                            </a>
                                        @else
                                            <img class="avatar border-gray" src="{!! asset('archieve/noimage.jpg') !!}" alt="...">
                                        @endif
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->programme}}</td>
                                    <td>{{$user->student_id}}</td>
                                    <td>****</td>
                                    <td>
                                        <div class="row text-center">
                                        @if (isset($user->candidate))
                                        <div class="col-md-12">
                                            <a class="btn btn-info btn-fill" href="{{ route('candidate.edit', $user->id ) }}">
                                                Edit Candidate
                                            </a>
                                        </div>
                                        @else
                                        <div class="col-md-12">
                                            <a class="btn btn-success btn-fill" href="{{ route('candidate.create', $user->id ) }}">
                                                Appoint As Candidate
                                            </a>
                                        </div>
                                        @endif
                                        </div>
                                    </td>
                                    <td>
                                        <!-- <div class="row text-center"> -->
                                            <!-- <div class="col-md-4">
                                                <a class="btn btn-info btn-fill" href="{{ route('user.view', collect($user)->first() ) }}">
                                                    <i class="nc-icon nc-tap-01" title="view User"></i>
                                                </a>
                                            </div> -->
                                            <div class="col-md-4">
                                                <a class="btn btn-warning btn-fill" href="{{ route('user.edit', collect($user)->first() ) }}">
                                                    <i class="nc-icon nc-ruler-pencil" title="edit User"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <a class="btn btn-danger btn-fill" href="#" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('user.delete', collect($user)->first() ) }}">
                                                    <i class="nc-icon nc-simple-remove" title="delete User"></i>
                                                </a>
                                            </div>
                                        <!-- </div> -->
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