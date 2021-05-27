<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtradeAttributeValue extends Model
{
    use HasFactory;

    protected $with = ['mtradeAttribute'];

    protected $fillable = [
        'mtrade_good_attribute_id', 'mtrade_attribute_id', 'value'
    ];

    public function mTradeGoodAttribute()
    {
        return $this->belongsTo("App\Models\MtradeGoodAttribute", 'mtrade_good_attribute_id');
    }

    public function mtradeAttribute()
    {
        return $this->belongsTo('App\Models\MtradeAttribute', 'mtrade_attribute_id');
    }
}
