<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $casts = [
        'working_days' => 'array',
    ];
    public function setWorkingDaysAttribute($value) {
        $this->attributes['working_days'] = $value ? json_encode($value) : $value;
    }

    public function getWorkingDaysAttribute($value) {
        return json_decode($value, true);
    }

    public function getDispTimeAttribute() {
        return $this->attributes['disp_time'] = Carbon::parse($this->start_time)->format('h:i A') . '  -  ' . Carbon::parse($this->end_time)->format('h:i A');
    }
}
