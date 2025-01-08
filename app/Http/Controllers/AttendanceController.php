<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::latest()->paginate(40);
        return view('admin.attendance.atten', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 0)->get();
        return view('admin.attendance.add', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'studentname' => 'required|integer',
                'attendance' => 'required|integer'
            ]
        );
        $attendance = new Attendance();
        $attendance->attendance = $validate['attendance'];
        $attendance->user_id = $validate['studentname'];
        $attendance->save();

        if ($attendance) {
            return to_route('attendance.index')->with('success', 'Attendance created successfully ');
        }
        return redirect()->back()->with('danger', 'Something Wrong, Please wait a moment.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        $students = User::where('role', 0)->get();
        return view('admin.attendance.edit', compact('attendance', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validate = $request->validate(
            [
                'attendance' => 'required|integer',
                'studentname' => 'required|integer',
            ]
        );
        $attendance->attendance = $validate['attendance'];
        $attendance->user_id = $validate['studentname'];
        $attendance->save();

        if ($attendance) {
            return to_route('attendance.index')->with('success', 'Attendance updated successfully ');
        }
        return redirect()->back()->with('danger', 'Something Wrong, Please wait a moment.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return to_route('attendance.index')->with('success', 'Attendance Deleted Successfully');
    }
}
