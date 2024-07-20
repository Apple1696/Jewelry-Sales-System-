<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'points', 'description'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
