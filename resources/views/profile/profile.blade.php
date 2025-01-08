@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h4>Profile</h4>
            </div>
            <div class="col-md-6 mt-2 d-flex justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>{{$user->role == 1 ? 'Admin' : 'Student'}} Profile</h5>
            </div>
            <div class="card-body">
               
                <x-message></x-message>
                <div>
                   <x-profile-form :user=$user ></x-profile-form>
                </div>
            </div>
        </div>

    </div>
@endsection
