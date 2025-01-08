@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h4>Leave</h4>
            </div>
            <div class="col-md-6 mt-2 d-flex justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Leave</li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Leave List</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('std.leave.create') }}" class="btn btn-warning">Leave Request</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <x-message></x-message>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>reason</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->type }}</td>
                                    <td>{{ $record->reason }}</td>
                                    <td>{{ $record->status }}</td>
                                    <td>{{ $record->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection
