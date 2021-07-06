<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\AbstractList;

class Phone extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        "id",

    ];
    public function phone(){
        return $this->hasOne(Phone::class);
    }
}
