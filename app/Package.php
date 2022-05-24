<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    use SoftDeletes;

    public function getImageURLAttribute() {
        return $this->attributes['image_url'] = $this->image ? Storage::url($this->image) : null;
    }
}
