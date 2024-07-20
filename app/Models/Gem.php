<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gem extends Model
{
    use HasFactory;

    protected $table = "gems";

    protected $fillable = [
        "name",
        "is_gem_stone",
        "price",
        "image",
        "barcode"
    ];

    public function jewelryItems() {
        return $this->belongsToMany(JewelryItem::class, "gems_jewelry_items", "gem_id", "jewelry_id");
    }
}
