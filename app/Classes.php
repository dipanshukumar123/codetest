<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Classes extends Model
{
    use SoftDeletes;

    public function classSchedules() {
        return $this->hasMany('App\ClassSchedule', 'class_id', 'id');
    }

    public function coach() {
        return $this->belongsTo('App\User', 'coach_id', 'id');
    }

    public function classCycles() {
        return $this->hasMany('App\ClassCycle', 'class_id', 'id');
    }

    public function getImageURLAttribute() {
        return $this->attributes['image_url'] = $this->image ? Storage::url($this->image) : null;
    }
}
