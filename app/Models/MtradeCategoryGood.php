<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtradeCategoryGood extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id', 'parent_category_id'];

    public function parent()
    {
        return $this->belongsTo('App\Models\MtradeCategoryGood', 'parent_category_id');
    }


}
