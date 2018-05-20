<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
