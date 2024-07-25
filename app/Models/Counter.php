<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    protected static function booted()
    {
        static::addGlobalScope('multi-tenancy', function (Builder $builder) {
                if(!empty(auth()->user()->role_id)) {
                    if (auth()->user()->role->name !== "manager") {
                        $builder->where('id', auth()->user()->counter_id);
                    }
                }

        });
    }

    public function staffs() {
        return $this->hasMany(User::class, "counter_id", "id");
    }
}
