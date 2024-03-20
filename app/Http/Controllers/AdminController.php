<?php
namespace App\Http\Controllers;

use App\Models\ClockRecord;
use App\Models\BreakTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function reports()
    {
    	$clockRecords = ClockRecord::with('breakTimes')->get();

        return view('admin.report', compact('clockRecords'));
    }
}