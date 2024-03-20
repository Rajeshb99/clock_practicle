<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    protected $fillable = ['clock_record_id', 'break_start', 'break_end'];
    protected $dates = ['break_start', 'break_end'];
    public function clockRecord()
    {
        return $this->belongsTo(ClockRecord::class);
    }
}
