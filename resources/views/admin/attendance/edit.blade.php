@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h4>Attendance</h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('attendance.index') }}">Attendance</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="m-0">Edit Attendance</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('attendance.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <x-message ></x-message>
                <div class="container">
                    <form action="{{ route('attendance.update', $attendance) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Student </label>
                            <select name="studentname" required class="form-select">
                                <option value="{{ $attendance->user->id }}" selected>{{ $attendance->user->name }}</option>

                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('studentname')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Attendance </label>
                            <select name="attendance" required class="form-select">
                                <option value="0" {{ $attendance->attendance == 0 ? 'selected' : '' }}>Apsent</option>
                                <option value="1" {{ $attendance->attendance == 1 ? 'selected' : '' }}>Present</option>
                                <option value="2" {{ $attendance->attendance == 2 ? 'selected' : '' }}>Approved Leave</option>
                            </select>
                            @error('attendance')
                                <p class="fs-6 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
