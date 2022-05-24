<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class ClassSchedule extends Model
{
    use SoftDeletes;

    public function classes() {
        return $this->belongsTo('App\Classes', 'class_id', 'id');
    }

    public function coach() {
        return $this->belongsTo('App\User', 'coach_id', 'id');
    }

    public function getDispTimeAttribute() {
        return $this->attributes['disp_time'] = Carbon::parse($this->start_date)->format('h:i A') . '  -  ' . Carbon::parse($this->end_date)->format('h:i A');
    }

    public function getDispDateAttribute() {
        return $this->attributes['disp_date'] = Carbon::parse($this->start_date)->format('dS M Y');
    }

    public function getDispCreatedByAttribute() {
        return $this->attributes['disp_created_by'] = $this->created_by == 1 ? 'Admin' : 'Freelancer';
    }
}
