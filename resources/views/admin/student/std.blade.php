@extends('layouts.layout')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mt-2">
            <h4>Students</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Students</li>
                </ol>
            </nav>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="m-0">All Students </h5>
                </div>
                <div class="col-md-6">
                    <form action="{{route('students.search.all')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="date" required name="start" class="form-control">
                                <small>From</small>
                                
                                @error('start')
                                <p class="fs-6 text-danger">{{$message}}</p>
                                    
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <input type="date" required name="end" class="form-control">
                                <small>To</small>
                                @error('end')
                                <p class="fs-6 text-danger">{{$message}}</p>
                                    
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="Search" class="btn btn-danger">
                            </div>
                                
                        </div>
                       
                       
                        
                    </form>
                </div>
                <div class="col-md-3 text-end">
                    @if (Route::is('students.search.all'))
                    <a href="{{route('students.index')}}" class="btn btn-danger">Clear</a>
                    @endif
                    <a href="{{route('students.pdf')}}" class="btn btn-outline-primary">Create Report</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="80px">#</th>
                            <th width="80px">Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="50px">Present</th>
                            <th width="50px">Apsent</th>
                            <th width="50px">Leave</th>
                            <th width="120px">Registeration</th>
                            <th width="100px">View</th>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($record->image)
                                        <img src="{{URL::asset('storage/'.$record->image)}}" class="img-fluid" alt="">
                                    @else
                                        <p>Image Not Upload</p>
                                    @endif
                                </td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->email}}</td>
                                <td>{{$present}}</td>
                                <td>{{$apsent}}</td>
                                <td>{{$leave}}</td>
                                <td>{{ $record->created_at->format('M d, Y') }}</td>
                                <td><a href="{{route('students.view',$record->id)}}" class="btn btn-outline-success">View</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="my-2">
                {{$students->links()}}
            </div>
        </div>
    </div>
</div>
@endsection