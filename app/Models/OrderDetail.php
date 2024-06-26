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
        'item_id',
        'quantity',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }
    
    public function item()
    {
        return $this->belongsTo(JewelryItem::class, 'item_id', 'id');
    }
}
