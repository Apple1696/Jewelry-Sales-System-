<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'revenue',
        'user_id',
        'order_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order(){
        return $this->belongsTo(Orders::class);
    }
}
