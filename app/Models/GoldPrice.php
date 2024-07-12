<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldPrice extends Model
{
    use HasFactory;
    protected $table = 'gold_prices';

    protected $fillable = [
        'price',
    ];
}
