<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Counter extends Model
{
    use HasFactory;
    protected $table = 'counter';
    protected $fillable = [
        'user_id',
        'counter_name',
        'revenue',
        'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function getRevenueByStaff($staffId)
    {
        return self::where('user_id', $staffId)->sum('revenue');
    }
}
