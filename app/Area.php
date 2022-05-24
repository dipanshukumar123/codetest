<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['id','governorate_id','title','status'];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class,'governorate_id','id');
    }
}
