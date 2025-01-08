<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leave::latest()->paginate(40);
        return view('admin.leave.leave', compact('leaves'));
    }

 

    public function edit(Leave $leave)
    {
        $students = User::where('role', 0)->get();
        return view('admin.leave.edit', compact('leave', 'students'));
    }


    public function update(Request $request, Leave $leave)
    {
        $validated  = $request->validate(
            [
                'studentname' => 'required|integer',
                'type' => 'required',
                'status' => 'required',
                'reason' => 'required',
            ]
        );
        $leave->status = $validated['status'];
        $leave->reason = $validated['reason'];
        $leave->type = $validated['type'];
        $leave->user_id = $validated['studentname'];
        $leave->save();

        if ($leave) {
            if ($leave->status == 'Reject') {
                $attendance = new Attendance();
                $attendance->user_id = $leave->user_id;
                $attendance->attendance = 0; //Absent
                $attendance->save();
            }
            if ($leave->status == 'Approve') {
                $attendance = new Attendance();
                $attendance->user_id = $leave->user_id;
                $attendance->attendance = 2; // Leave
                $attendance->save();
            }
            return to_route('leave.index')->with('success', 'Leave Updated successfully.');
        }
        return redirect()->back()->with('danger', 'Something Wrong Please Try again');
    }


    public function destroy(Leave $leave)
    {
        $leave->delete();
        return to_route('leave.index')->with('success', 'Leave deleted successfully.');
    }
}
