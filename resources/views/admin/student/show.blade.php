@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h4>Student</h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student</li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-2">
                        <h5 class="m-0">Student Report</h5>
                    </div>
                    <div class="col-md-6">
                        <form action="{{route('student.search',$student->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="date" name="start" class="form-control">
                                    @error('start')
                                    <p class="fs-6 text-danger">{{$message}}</p>
                                        
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <input type="date" name="end" class="form-control">
                                    @error('end')
                                    <p class="fs-6 text-danger">{{$message}}</p>
                                        
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" value="Search" class="btn btn-danger">
                                </div>
                                    
                            </div>
                           
                           
                            
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        @if (Route::is('student.search'))
                        <a href="{{route('students.view',$student->id)}}" class="btn btn-danger">Clear</a>
                        @endif
                        <a href="{{ route('student.pdf',$student->id) }}" class="btn btn-outline-primary">Create Report</a>
                        <a href="{{ route('students.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid py-2">
                    <div class="row justify-content-center align-items-center">
                        @if ($student->image)
                            <div class="col-md-3">
                                <img src="{{ URL::asset('storage/' . $student->image) }}" class="img-fluid reunded"
                                    alt="">
                            </div>
                        @endif

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">Name</div>
                                <div class="col-md-9">: {{ $student->name }}</div>
                                <div class="col-md-3">Email</div>
                                <div class="col-md-9">: {{ $student->email }}</div>
                                <div class="col-md-3">Registration Date</div>
                                <div class="col-md-9">: {{ $student->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-9">Total Attendance</div>
                                <div class="col-md-3">{{ count($attendances) }}</div>
                                <div class="col-md-9">Present</div>
                                <div class="col-md-3"> {{ $presentStudents }}
                                    @if ($presentStudents == 26)
                                        A
                                    @elseif ($presentStudents >= 23)
                                        B+
                                    @elseif ($presentStudents >= 20)
                                        B
                                    @elseif ($presentStudents >= 15)
                                        C+
                                    @elseif ($presentStudents > 10)
                                        D+
                                    @else
                                        D
                                    @endif
                                </div>
                                <div class="col-md-9">Leaved</div>
                                <div class="col-md-3"> {{ $leavedStudents }} </div>
                                <div class="col-md-9">Apsent</div>
                                <div class="col-md-3"> {{ $apsentsStudents }} </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="mt-2">Attendance Details</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="80px">#</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($record->attendance == 1)
                                            Present
                                        @elseif ($record->attendance == 2)
                                            Leave
                                        @else
                                            Absant
                                        @endif
                                    </td>
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
