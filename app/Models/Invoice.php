<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "invoices";

    protected $primaryKey = "id";

    protected $fillable = [
        'order_id',
        'type',
        'expire_date'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
