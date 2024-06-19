<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotion';
    protected $primaryKey = 'promotion_id';
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'discount_amount',
        'approve',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'promotion_id', 'promotion_id');
    }
}
