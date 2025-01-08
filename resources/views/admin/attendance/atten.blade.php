@extends('layouts.layout')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mt-2">
            <h4>Attendances</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Attendances</li>
                </ol>
            </nav>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0">All Attendances </h5>
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
                                    <form action="{{route('attendance.update',$record)}}" method="POST">
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
            <div class="my-2">
                {{$attendances->links()}}
            </div>
        </div>
    </div>
</div>
@endsection