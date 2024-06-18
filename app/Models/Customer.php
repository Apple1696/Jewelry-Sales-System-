<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Promotion;

class Customer extends Model
{
    use HasFactory; 

    protected $table = 'customers';
    protected $fillable = [
        'full_name',
        'location',
        'phone_number',
        'point',
        'promotion_id',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id', 'promotion_id');
    }
}