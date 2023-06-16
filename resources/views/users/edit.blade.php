@extends('layouts.app', ['activePage' => 'user-management', 'title' => 'U-Election', 'navName' => 'Edit User', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Edit User</h4>
                        <p class="card-category"></p>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form name="create-buletin-new" id="create-buletin-new" method="post" action="{{route('user.update' , collect($user)->first())}}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4 pr-lg-4">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="Enter Your Full Name Here" value="{{$user->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="example@example.com" value="{{$user->email}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" readonly>
                                </div>

                                <!-- <div class="form-group">
                                    <label>Programme</label>
                                    <input type="text" class="form-control" name="programme" placeholder="Enter Your Programme Here" value="{{$user->programme}}">
                                </div> -->

                                <div class="form-group">
                                    <label for="programme">Programme</label>
                                    <select class="form-control" name="programme">
                                        <option value="">- Select Programme -</option>
                                        <option value="Electrical Engineering">Electrical Engineering</option>
                                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                                        <option value="Information Technology (Visual Media)">Information Technology (Visual Media)</option>
                                        <option value="Information Technology (Information Systems)">Information Technology (Information Systems)</option>
                                        <option value="Computer Science (Software Engineering)">Computer Science (Software Engineering)</option>
                                        <option value="Computer Science (Cyber Security)">Computer Science (Cyber Security)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Student Id</label>
                                    <input type="text" class="form-control" name="student_id" placeholder="Enter Your Student Id Here" value="{{$user->student_id}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Photo</label>
                                    <input type="file" value="{!! asset('archieve/user/'.$user->email.'/'.$user->photo) !!}" class="form-control-file" name="document">
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