<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rebuy extends Model
{
    use HasFactory;

    public $table = "rebuys";

    protected $fillable = [
        "item_id",
        "staff_id",
        "price"
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function($model)
        {
            $item = JewelryItem::find($model->item_id);
            $item->status = "rebuy";
            $item->save();
        });
  
    }

    public function item() {
        return $this->hasOne(JewelryItem::class, 'id', 'item_id');
    } 

    public function staff() {
        return $this->hasOne(User::class, 'id', 'staff_id');
    }
}
