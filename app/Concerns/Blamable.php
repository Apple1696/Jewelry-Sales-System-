<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Wallo\FilamentCompanies\FilamentCompanies;

trait Blamable
{
    public static function bootBlamable(): void
    {
        static::creating(static function ($model) {
            $auth = Auth::id();
            $model->created_by = $auth;
            $model->updated_by = $auth;
        });

        static::updating(static function ($model) {
            $auth = Auth::id();
            $model->updated_by = $auth;
        });
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo($this->userModel(), 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo($this->userModel(), 'updated_by');
    }

    protected function userModel(): string
    {
        return FilamentCompanies::userModel();
    }
}
