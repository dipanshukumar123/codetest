<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $table = 'governorates';

    protected $fillable = ['id','title','status'];

    public function areas()
    {
        return $this->hasMany(Area::class,'governorate_id');
    }
}
