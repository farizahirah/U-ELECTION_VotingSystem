@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'U-Election', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            @foreach ($vote_details as $vd)
            <div class="col-md-6">
                <a class="btn btn-primary btn-block" href="{{route('db.detail' , ['id' => $vd->id])}}">
                    {{$vd->title}}
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
