@extends('layouts.app', ['activePage' => 'user-management', 'title' => 'U-Election', 'navName' => 'Create New User', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Create User</h4>
                        <p class="card-category"></p>
                        
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <form name="create-buletin-new" id="create-buletin-new" method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="pl-lg-4 pr-lg-4">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name="full_name" placeholder="Enter Your Full Name Here" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="example@example.com" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>

                                <!-- <div class="form-group">
                                    <label>Programme</label>
                                    <input type="text" class="form-control" name="programme" placeholder="Enter Your Programme Here">
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
                                    <input type="text" class="form-control" name="student_id" placeholder="Enter Your Student Id Here" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Photo</label>
                                    <input type="file" class="form-control-file" name="document">
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