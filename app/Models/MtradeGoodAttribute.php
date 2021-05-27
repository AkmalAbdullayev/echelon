<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtradeGoodAttribute extends Model
{
    use HasFactory;


    public function mtradeCategoryGood()
    {
        return $this->belongsTo('App\Models\MtradeCategoryGood');
    }

    public function mtradeUnit()
    {
        return $this->belongsTo('App\Models\MtradeUnit', 'unit_id');
    }

    public function mtradeAttributeValues()
    {
        return $this->hasMany('App\Models\MtradeAttributeValue');
    }
}
