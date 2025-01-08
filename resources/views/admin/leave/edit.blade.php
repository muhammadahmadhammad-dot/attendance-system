@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h4>Leave</h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('leave.index') }}">Leave</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="m-0">Edit Leave</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('leave.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <x-message ></x-message>
                <div class="container">
                    <form action="{{ route('leave.update', $leave) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Student </label>
                            <select name="studentname" class="form-select">
                                <option value="{{ $leave->user->id }}" selected>{{ $leave->user->name }}</option>

                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('studentname')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type </label>
                            <select name="type" class="form-select">
                                <option value="Sick" {{ $leave->type == 'Sick' ? 'selected' : '' }}>Sick Leave</option>
                                <option value="Medical" {{ $leave->type == 'Medical' ? 'selected' : '' }}>Medical Leave
                                </option>
                                <option value="Emergency" {{ $leave->type == 'Emergency' ? 'selected' : '' }}>Emergency
                                    Leave</option>
                                <option value="Study" {{ $leave->type == 'Study' ? 'selected' : '' }}>Study Leave</option>
                                <option value="Other" {{ $leave->type == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('type')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reason </label>
                            <textarea name="reason" class="form-control">{{$leave->reason}}</textarea>
                            @error('reason')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status </label>
                            <select name="status" class="form-select">
                                <option value="Pending" {{ $leave->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approve" {{ $leave->status == 'Approve' ? 'selected' : '' }}>Approve</option>
                                <option value="Reject" {{ $leave->status == 'Reject' ? 'selected' : '' }}>Reject
                                </option>
                            </select>
                            @error('status')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary">Save Chnages</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
