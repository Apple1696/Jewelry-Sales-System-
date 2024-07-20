<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'order_type',
        'total_price',
        'customer_id',
        'staff_id',
        'promotion_id',
        'counter_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $user = Auth::user();
            $model->staff_id = $user->id;
        });
  
        static::created(function($model)
        {
            
        });
    }


    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function customer() 
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'order_id');
    }
    
    public function counter(){
        return $this->belongsTo(Counter::class, 'counter_id');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }

    protected function price(): Attribute
    {
        return new Attribute(
            get: function() {
                $details = $this->details;
                $price = 0;
                foreach($details as $detail) {
                    $price += $detail->item->price * $detail->quantity;
                }
                $promotion = Promotion::find($this->promotion_id);
                $percentant = $promotion ? (1 - ($promotion->discount_percentage / 100)) : 1;
                return $price * $percentant;
            },
        );
    }
}

