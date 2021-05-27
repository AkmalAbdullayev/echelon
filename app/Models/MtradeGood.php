<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtradeGood extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku', 'mtrade_good_attribute_id', 'attributes', 'picture'
    ];

    public function mTradeGoodAttribute()
    {
        return $this->belongsTo("App\Models\MtradeGoodAttribute", 'mtrade_good_attribute_id');
    }

    public function getAttributeName($key)
    {
        return MtradeAttributeValue::whereId($key)->pluck('value')->first();
    }
}
