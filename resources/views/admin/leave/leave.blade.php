@extends('layouts.layout')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mt-2">
            <h4>Leaves</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Leaves</li>
                </ol>
            </nav>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0">All leaves </h5>
                </div>
                <div class="col-md-6 "></div>
            </div>
        </div>
        <div class="card-body">
            <x-message ></x-message>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="80px">#</th>
                            <th width="80px">Student </th>
                            <th>Type</th>
                            <th>Reason</th>
                            <th width="120px">Status</th>
                            <th width="120px">Date</th>
                            <th width="150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $record)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$record->user->name}}</td>
                                <td>{{$record->type}}</td>
                                <td>{{$record->reason}}</td>
                                <td>{{$record->status}}</td>
                                <td>{{ $record->created_at->format('M d, Y') }}</td>
                                <td>
                                   <div class="d-flex">
                                    <a href="{{route('leave.edit',$record)}}" class="btn btn-sm btn-success">Edit</a>
                                    <form action="{{route('leave.destroy',$record)}}" method="POST">
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
                {{$leaves->links()}}
            </div>
        </div>
    </div>
</div>
@endsection