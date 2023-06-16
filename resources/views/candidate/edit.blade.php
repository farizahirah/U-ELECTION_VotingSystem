@extends('layouts.app', ['activePage' => 'user-management', 'title' => 'U-Election', 'navName' => 'Create Candidate', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">{{$user->name}}</h4>
                        <p class="card-category">Appointed Candidate</p>
                        
                    </div>
                    @if (isset($candidate))
                    <div class="card-body table-full-width table-responsive">
                        <form name="create-buletin-new" id="create-buletin-new" method="post" action="{{route('candidate.update' , collect($candidate)->first())}}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4 pr-lg-4">
                                <div class="form-group">
                                    <label>Motto</label>
                                    <input type="text" class="form-control" name="motto" placeholder="Enter Candidate Motto Here" value="{{$candidate->motto}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Achievement</label>
                                    <textarea class="form-control" name="achievement" placeholder="Enter Candidate Achievement Here" rows="3" style="height: 237px;">{{$candidate->achievement}}</textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-primary btn-fill">Save</button>
                                <a class="btn btn-danger btn-fill" href="#" data-toggle="modal" data-target="#delete_confirm" data-id="{{ route('candidate.delete', collect($candidate)->first() ) }}">Remove Candidate</a>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="card-body table-full-width table-responsive">
                        <form name="create-buletin-new" id="create-buletin-new" method="post" action="{{route('candidate.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4 pr-lg-4">
                                <div class="form-group">
                                    <label>Motto</label>
                                    <input type="text" class="form-control" name="motto" placeholder="Enter Candidate Motto Here" required>
                                </div>
                                <div class="form-group">
                                    <label>Achievement</label>
                                    <textarea class="form-control" name="achievement" placeholder="Enter Candidate Award Here" rows="3" style="height: 237px;"></textarea>
                                </div>
                            </div>
                            <div class="text-center">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-primary btn-fill">Save</button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>    

<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="deleteLabel">Remove Candidate</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Are you sure to Remove this Candidate?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a  type="button" class="btn btn-danger Remove_square">Remove</a>
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