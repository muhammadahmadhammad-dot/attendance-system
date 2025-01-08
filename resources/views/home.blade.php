@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mt-2">
                <h4>Student Dashboard</h4>
            </div>
            <div class="col-md-6 d-flex justify-content-end mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>

            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="m-0">Attendance Histroy</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-info atten-btn" id="1">Mark Attendance</button>
                        <a href="{{ route('std.leave.create') }}" class="btn ms-2 btn-warning ">Leave Request</a>

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
                                <th>Attendance</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $record)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
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


    <script>
        const attenBtn = document.querySelector('.atten-btn');
        attenBtn.addEventListener('click', () => {
            attenBtn.disabled = true;
            const id = attenBtn.id;
            markAtten(id);
        });

        const markAtten = async (id) => {
            const sending = await fetch('{{ route('std.attendance.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: id
                }),
            });
            const result = await sending.json();

            if (result.status) {
                alert(result.message);
            } else {
                alert(result.message);
            }

            window.location = '{{ route('home') }}';
        }
    </script>
@endsection
