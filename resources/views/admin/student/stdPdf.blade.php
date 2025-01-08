<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <title>{{$student->name}}-Student Report</title>

</head>

<body>
    <div class="container-fluid mt-2">
        <div>
            <h2>Attendance System</h2>
        </div>
        <h5>Student Report</h5>




        <table class="table">
            <tbody>
                <tr>
                    <td>
                        @if ($student->image)
                        <img src="{{ public_path('storage/' . $student->image) }}" class="img-fluid rounded" width="120px"
                            alt="">
                    @endif
                    </td>
                    <td>
                        <p>Name</p>
                        <p>Email</p>
                        <p>Registration Date</p>
                    </td>
                    <td>
                        <p>{{ $student->name }}</p>
                        <p>{{ $student->email }}</p>
                        <p>{{ $student->created_at->format('M d, Y') }}</p>
                    </td>
                   
                </tr>
                <tr>
                    <td>Total Attendance</td>
                    <td>{{ count($attendances) }}</td>

                    <td>Present</td>
                    <td>{{ $presentStudents }}
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
                    @endif</td>

                    
                </tr>
                <tr>
                    <td>Leaved</td>
                    <td>{{ $leavedStudents }}</td>

                    <td>Apsent</td>
                    <td>{{ $apsentsStudents }}</td>
                </tr>
            </tbody>
        </table>




        <div class="card">
            <div class="card-header">

                <h5 class="mt-2">Attendance Details</h5>
            </div>
            <div class="card-body">

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
</body>

</html>
