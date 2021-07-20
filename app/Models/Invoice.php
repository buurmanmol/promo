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
        'invoice_name',
        'user_id',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
