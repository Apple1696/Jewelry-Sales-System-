<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JewelryItem extends Model
{
    use HasFactory;

    protected $table = "jewelry_items";

    protected $fillable = [
        "name",
        "image",
        "gold_weight",
        "category_id",
        "status",
        "barcode"
    ];

    public function gems() {
        return $this->belongsToMany(Gem::class, "gems_jewelry_items", "jewelry_id", "gem_id");
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
