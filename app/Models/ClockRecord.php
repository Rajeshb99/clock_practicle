<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClockRecord extends Model
{
    protected $fillable = ['user_id', 'clock_in', 'clock_out'];
    protected $dates = ['clock_in', 'clock_out'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }

    public function totalTime()
    {
        $totalTime = $this->clock_in->diffInMinutes($this->clock_out);

        foreach ($this->breakTimes as $break) {
            $totalTime -= $break->break_start->diffInMinutes($break->break_end);
        }

        return $totalTime;
    }
}
