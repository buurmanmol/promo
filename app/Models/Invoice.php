<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $keyType = 'string';
    protected $table = 'invoices';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'invoice_path',
        'payed',
        'user_id',
        'company_id'
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}
