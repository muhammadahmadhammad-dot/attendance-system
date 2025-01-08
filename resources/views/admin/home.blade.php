@extends('layouts.layout')
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h4>Admin Dashboard</h4>
            </div>
            <div class="col-md-6"></div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="container rounded text-light py-2 bg-primary shadow-sm">
                    <p class="mb-0 fs-4">Total Students</p>
                    <p class=" mb-0 fs-4">{{$totalStd}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container rounded text-light py-2 bg-secondary shadow-sm">
                    <p class="mb-0 fs-4">Today Present</p>
                    <p class=" mb-0 fs-4">{{$presentStd}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container rounded text-light py-2 bg-danger shadow-sm">
                    <p class="mb-0 fs-4">Today Absent</p>
                    <p class=" mb-0 fs-4">{{$apsentStd}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container rounded text-light py-2 bg-success shadow-sm">
                    <p class="mb-0 fs-4">Today Leaved</p>
                    <p class=" mb-0 fs-4">{{$leavedStd}}</p>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="m-0">Today Attendances </h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <a class="btn btn-primary" href="{{route('attendance.create')}}">Add</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <x-message ></x-message>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="80px">#</th>
                                <th >Student </th>
                                <th width="100px">Attendances</th>
                                <th width="120px">Date</th>
                                <th width="150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$record->user->name}}</td>
                                    <td>
                                        @if ( $record->attendance == 1)
                                        Present
                                        @elseif ( $record->attendance == 2)
                                        Leave
                                        @else
                                        Absant
                                    @endif
                                    </td>
                                    <td>{{ $record->created_at->format('M d, Y') }}</td>
                                    <td>
                                       <div class="d-flex">
                                        <a href="{{route('attendance.edit',$record)}}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{route('attendance.destroy',$record)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger ms-2">Delete</button>
                                        </form>
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
@endsection