<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{

    public function index()
    {
        session()->forget('data');
        $students = User::where('role', '0')->paginate(50);
        return view('admin.student.std', compact('students'));
    }

    public function generateStdPdf(string $id)
    {
        $student = User::findOrFail($id);
        $attendances = $student->attendances;

        if (session()->has('stdAttenStartDate') && session()->has('stdAttenEndDate')) {
            $start = session()->get('stdAttenStartDate');
            $end = session()->get('stdAttenEndDate');
            $attendances = $student->attendances()
                ->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $start)->get();
        }

        $presentStudents = 0;
        $leavedStudents = 0;
        $apsentsStudents = 0;
        foreach ($attendances as $value) {
            if ($value->attendance == 1) {
                $presentStudents++;
            } elseif ($value->attendance == 2) {
                $leavedStudents++;
            } else {
                $apsentsStudents++;
            }
        }
        // return view('admin.student.stdPdf',compact('student','presentStudents','leavedStudents','apsentsStudents'));
        $data = [
            'student' => $student,
            'attendances' => $attendances,
            'presentStudents' => $presentStudents,
            'leavedStudents' => $leavedStudents,
            'apsentsStudents' => $apsentsStudents,
        ];

        $pdf = Pdf::loadView('admin.student.stdPdf', $data);
        return $pdf->download($student->name . '-Student.pdf');
    }
    public function generateAllStdPdf()
    {
        $students = User::where('role', '0')->get();
        if (session()->has('data')) {
            $students = session()->get('data');
        }

        $data = [
            'students' => $students,
        ];

        $pdf = Pdf::loadView('admin.student.allStdPdf', $data);

        return $pdf->download('All-students.pdf');
    }

    public function show(string $id)
    {
        if (session()->has('stdAttenStartDate')) {
            session()->forget('stdAttenStartDate');
        }
        if (session()->has('stdAttenEndDate')) {
            session()->forget('stdAttenEndDate');
        }

        $student = User::findOrFail($id);
        $attendances = $student->attendances;
        $presentStudents = 0;
        $leavedStudents = 0;
        $apsentsStudents = 0;
        foreach ($attendances as $value) {
            if ($value->attendance == 1) {
                $presentStudents++;
            } elseif ($value->attendance == 2) {
                $leavedStudents++;
            } else {
                $apsentsStudents++;
            }
        }
        return view('admin.student.show', compact('student', 'presentStudents', 'attendances', 'leavedStudents', 'apsentsStudents'));
    }
    public function allStudentsSearch(Request $request)
    {
        if (session()->has('data')) {
            session()->forget('data');
        }
        $validated = $request->validate(
            [
                'start' => 'required|date',
                'end' => 'required|date|after_or_equal:start',
            ]
        );
        $students = User::where('role', '0')
            ->whereDate('created_at', '>=', $validated['start'])
            ->wheredate('created_at', '<=', $validated['end'])
            ->paginate(50);
        session()->put('data', $students);
        // dd($students);
        return view('admin.student.std', compact('students'));
    }
    public function StudentSearch(Request $request, string $id)
    {
        if (session()->has('stdAttenStartDate')) {
            session()->forget('stdAttenStartDate');
        }
        if (session()->has('stdAttenEndDate')) {
            session()->forget('stdAttenEndDate');
        }
        $validated = $request->validate(
            [
                'start' => 'required|date',
                'end' => 'required|date|after_or_equal:start',
            ]
        );
        $student = User::where('role', '0')->find($id);

        $attendances = $student->attendances()
            ->whereDate('created_at', '>=', $validated['start'])
            ->whereDate('created_at', '<=', $validated['end'])->get();
        // ->whereBetween('created_at', [$validated['start'], $validated['end']])->get();
        $presentStudents = 0;
        $leavedStudents = 0;
        $apsentsStudents = 0;
        foreach ($attendances as $value) {
            if ($value->attendance == 1) {
                $presentStudents++;
            } elseif ($value->attendance == 2) {
                $leavedStudents++;
            } else {
                $apsentsStudents++;
            }
        }
        session()->put('stdAttenStartDate', $validated['start']);
        session()->put('stdAttenEndDate', $validated['end']);
        return view('admin.student.show', compact('student', 'presentStudents', 'attendances', 'leavedStudents', 'apsentsStudents'));
    }
}
