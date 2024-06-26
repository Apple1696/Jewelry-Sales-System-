<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'order_type',
        'total_price',
        'user_id',
        'staff_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $user = Auth::user();
            $model->staff_id = $user->id;
        });
  
    }


    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function staff(){
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'order_id');
    }
}
