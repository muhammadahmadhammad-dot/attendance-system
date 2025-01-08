<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('assets/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <title>All Students Report</title>

</head>

<body>
    <div class="container-fluid mt-2">
        <div>
            <h2>Attendance System</h2>
        </div>
        <h5>All Student Report</h5>





        <div class="card">
            <div class="card-header">

                <h5 class="mt-2">Students Details</h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Present</th>
                                <th>Apsant</th>
                                <th>Leave</th>
                                <th>Registeration</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($students as $record)
                                @php
                                    $present = 0;
                                    $leave = 0;
                                    $apsent = 0;
                                @endphp
                                @foreach ($record->attendances as $attendance)
                                    @if ($attendance->attendance == 1)
                                        @php
                                            $present++;
                                        @endphp
                                    @elseif($attendance->attendance == 2)
                                        @php
                                            $leave++;
                                        @endphp
                                    @else
                                        @php
                                            $apsent++;
                                        @endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->email }}</td>
                                    <td>{{ $present }}</td>
                                    <td>{{ $apsent }}</td>
                                    <td>{{ $leave }}</td>
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
