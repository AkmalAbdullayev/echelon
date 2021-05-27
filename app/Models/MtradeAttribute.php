<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MtradeAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'name', 'is_required', 'type'
    ];

    public function typeName()
    {
        $data = [
            1 => 'Радио',
            2 => 'Чекбокс',
            3 => 'Поле'
        ];
        return $data[$this->type];
    }
}
