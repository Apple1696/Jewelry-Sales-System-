<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';  // Ensure this matches your table name
    protected $primaryKey = 'order_detail_id';

    protected $fillable = [
        'gem_id',
        'order_id',
    ];

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'order_id');
    }
    
}
