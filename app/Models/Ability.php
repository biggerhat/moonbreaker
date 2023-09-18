<?php

namespace App\Models;

use App\Traits\ToSelectOptionsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Ability extends Model {
    use HasFactory;
    use ToSelectOptionsScope;

    protected $guarded = [];

    protected static function booted(): void {
        static::creating(function (Ability $ability) {
            $ability->slug = Str::slug($ability->name);
        });

        static::updating(function (Ability $ability) {
            $ability->slug = Str::slug($ability->name);
        });
    }

    public function units(): BelongsToMany {
        return $this->belongsToMany(Unit::class);
    }
}
