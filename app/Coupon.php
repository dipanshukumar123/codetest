<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    use SoftDeletes;

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    public function getDispValidityAttribute() {
        return $this->attributes['disp_validity'] = Carbon::parse($this->start_date)->format('dS M Y') . '  -  ' . Carbon::parse($this->end_date)->format('dS M Y');
    }
}
