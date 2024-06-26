<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class JewelryItem extends Model
{
    use HasFactory;

    protected $table = "jewelry_items";

    protected $goldPrice = 10000;

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

    protected function price(): Attribute
    {
        
        return new Attribute(
            get: function() {
                return (($this->gems()->sum('price') + ($this->gold_weight * $this->goldPrice)) + 0) * 1;
            },
        );
    }
}
