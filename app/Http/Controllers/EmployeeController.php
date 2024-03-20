<?php
namespace App\Http\Controllers;

use App\Models\ClockRecord;
use App\Models\BreakTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function clock()
    {
        return view('user.clock');
    }

    public function clockInOut(Request $request)
    {
        $user = Auth::user();

        $clockRecord = new ClockRecord();
        $clockRecord->user_id = $user->id;
        $clockRecord->clock_in = now();
        $clockRecord->save();

        // If you want to automatically clock out after a certain time, you can use Laravel's task scheduling to handle this.

        return redirect()->back()->with('success', 'Clocked in successfully!');
    }

    public function clockOut(Request $request)
    {
        $user = Auth::user();

        $clockRecord = ClockRecord::where('user_id', $user->id)->whereNull('clock_out')->latest()->first();
        if ($clockRecord) {
            $clockRecord->clock_out = now();
            $clockRecord->save();
            return redirect()->back()->with('success', 'Clocked out successfully!');
        }

        return redirect()->back()->with('error', 'No active clock-in record found!');
    }

    public function takeBreak(Request $request)
    {
        $user = Auth::user();

        $clockRecord = ClockRecord::where('user_id', $user->id)->whereNull('clock_out')->latest()->first();
        if ($clockRecord) {
            $breakTime = new BreakTime();
            $breakTime->clock_record_id = $clockRecord->id;
            $breakTime->break_start = now();
            $breakTime->save();
            return redirect()->back()->with('success', 'Break started successfully!');
        }

        return redirect()->back()->with('error', 'No active clock-in record found!');
    }

    public function endBreak(Request $request)
    {
        $user = Auth::user();

        $clockRecord = ClockRecord::where('user_id', $user->id)->whereNull('clock_out')->latest()->first();
        if ($clockRecord) {
            $breakTime = BreakTime::where('clock_record_id', $clockRecord->id)->whereNull('break_end')->latest()->first();
            if ($breakTime) {
                $breakTime->break_end = now();
                $breakTime->save();
                return redirect()->back()->with('success', 'Break ended successfully!');
            }
        }

        return redirect()->back()->with('error', 'No active break found!');
    }
}
