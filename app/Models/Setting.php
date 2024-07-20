<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    /**
     * Retrieve a setting by key.
     *
     * @param  string  $key
     * @return string|null
     */
    public static function get($key)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : null;
    }

    /**
     * Set a setting value by key.
     *
     * @param  string  $key
     * @param  string  $value
     * @return void
     */
    public static function set($key, $value)
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

}
