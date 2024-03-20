<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if($user->role == "admin"){
            return view('admin.home');
        }else{
            $clockedIn = $this->isClockedIn(); // Assuming you have a method to check if the user is clocked in
        return view('employee.home', compact('clockedIn'));
        }
    }

    private function isClockedIn()
    {
        $user = Auth::user();
        $latestClockRecord = $user->clockRecords()->latest()->first();
        return $latestClockRecord && !$latestClockRecord->clock_out;
    }
}
