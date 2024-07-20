<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'points_required', 
        'discount_percentage', 
        'start_date', 
        'end_date'
    ];

    public function scopeIsHappening(Builder $query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '<=', $now)
                     ->where(function($query) use ($now) {
                         $query->where('end_date', '>=', $now)
                               ->orWhereNull('end_date');
                     });
    }

    public function scopeIsAvailableForCustomer(Builder $query, $customer_id)
    {
        $point = Customer::find($customer_id)?->point;
        if ($point !== null) {
            return $query->isHappening()->where('points_required', '<=', $point);
        }

        return $query->isHappening()->whereRaw('0 = 1');
    }
}
