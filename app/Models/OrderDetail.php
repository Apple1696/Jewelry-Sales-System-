<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'gem_id',
        'quantity',
        'order_id',
    ];

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'order_id');
    }
    
}
