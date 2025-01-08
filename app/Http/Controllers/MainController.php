<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function leaveStore(Request $request)
    {

        $std_id  = auth()->id();
        $date = Carbon::today();

        $atten = Attendance::where('user_id', $std_id)
            ->whereDate('created_at', $date)
            ->exists();
        if ($atten) {
            return redirect()->back()->with('danger', 'Your Attendance is marked');
        }

        $leave = Leave::where('user_id', $std_id)
            ->whereDate('created_at', $date)
            ->exists();
        if ($leave) {
            return redirect()->back()->with('danger', 'Your Leave request already send to admin.');
        }

        $validated = $request->validate(
            [
                'type' => 'required|string',
                'reason' => 'required',
            ]
        );

        $leave = new Leave();
        $leave->user_id = auth()->id();
        $leave->type = $validated['type'];
        $leave->reason = $validated['reason'];
        $leave->status = 'Pending';
        $leave->save();

        if ($leave) {
            return to_route('std.leave.index')->with('success', 'leave sended successfully ');
        }
        return redirect()->back()->with('danger', 'Something Wrong, Please wait a moment.');
    }
    public function leaveCreate()
    {
        return view('leave.create');
    }
    public function index()
    {

        // mark all student absent who not mark attendane 
        $yesterday = Carbon::yesterday();
        if ($yesterday->dayOfWeek() != 0) {
            $students = User::where('role', 0)->get();
            foreach ($students as $student) {
                if (!$student->attendances()->whereDate('created_at', $yesterday)->exists()) {
                    if ($student->created_at < today()) {
                        $student->attendances()->create(
                            [
                                'attendance' => 0,
                                'created_at' => $yesterday,
                                'updated_at' => $yesterday,
                            ]
                        );
                    }
                }
            }
        }



        if (auth()->user()->role == 1) {
            return to_route('admin.home');
        }
        $attendances  = Attendance::where('user_id', auth()->id())->latest()->paginate(26);
        return view('home', compact('attendances'));
    }



    public function leave()
    {
        $leaves = Leave::where('user_id', auth()->id())->get();
        return view('leave.leaves', compact('leaves'));
    }

    public function adminHome()
    {

        $totalstudents = User::where('role', 0)->count();
        $attendances = Attendance::where('created_at', '>=', today())->get();


        $presentStudents = 0;
        $leavedStudents = 0;
        $apsentStudents = 0;
        foreach ($attendances as $value) {
            if ($value->attendance == 1) {
                $presentStudents++;
            } elseif ($value->attendance == 2) {
                $leavedStudents++;
            } else {
                $apsentStudents++;
            }
        }
        return view('admin.home', [
            'attendances' => $attendances,
            'totalStd' => $totalstudents,
            'presentStd' => $presentStudents,
            'apsentStd' => $apsentStudents,
            'leavedStd' => $leavedStudents,
        ]);
    }
    public function attendanceStore(Request $request)
    {
        $std_id  = auth()->id();
        $date = Carbon::today();

        $leave = Leave::where('user_id', $std_id)
            ->whereDate('created_at', $date)
            ->exists();
        if ($leave) {
            return response()->json([
                'status' => false,
                'message' => 'You already send leave request to admin.',
            ]);
        }

        $attendance = Attendance::where('user_id', $std_id)
            ->whereDate('created_at', $date)
            ->exists();
        if ($attendance) {
            return response()->json([
                'status' => false,
                'message' => 'Attendance Marked Already.',
            ]);
        }

        Attendance::create([
            'attendance' => 1,
            'user_id' =>  $std_id,
        ]);

        return response()->json([
            'status' => false,
            'message' => "Attendance Marked"
        ]);
    }
}
