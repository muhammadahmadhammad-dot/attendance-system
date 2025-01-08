@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h4>Send Leave</h4>
            </div>
            <div class="col-md-6 mt-2 d-flex justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('std.leave.index') }}">Leave</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Send Leave</li>
                    </ol>
                </nav>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Fill Form</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('std.leave.index') }}" class="btn btn-danger">Back to List</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <x-message ></x-message>
                <form action="{{ route('std.leave.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Leave Type</label>
                        <select name="type" class="form-select">
                            <option value="">Select </option>
                            <option value="Sick">Sick Leave</option>
                            <option value="Medical">Medical Leave</option>
                            <option value="Emergency">Emergency Leave</option>
                            <option value="Study">Study Leave</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('type')
                            <p class="fs-6 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Reason</label>
                        <textarea name="reason" rows="3" class="form-control">{{ old('reason') }}</textarea>
                        @error('reason')
                            <p class="fs-6 text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Send" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
