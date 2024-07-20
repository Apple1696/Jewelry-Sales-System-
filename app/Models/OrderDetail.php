<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JewelryItem;

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

    public static function boot()
    {
        parent::boot();

        static::created(function($model)
        {
            $item = JewelryItem::find($model->item_id);
            $customer = Customer::find($model->order->customer_id);
            $promotion = Promotion::find($model->order->promotion_id);
            $percentant = $promotion ? (1 - ($promotion->discount_percentage / 100)) : 1;
            $item->update([
                'status' => 'sold'
            ]);

            $customer->update([
                'point' => (int) (($customer->point + ($item->price * $percentant)) / 10000000)
            ]);
        });
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }
    
    public function item()
    {
        return $this->belongsTo(JewelryItem::class, 'item_id', 'id');
    }
}
