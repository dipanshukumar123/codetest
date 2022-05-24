<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassCycle extends Model
{
    public function class() {
        return $this->belongsTo('App\Classes', 'class_id', 'id');
    }
}
