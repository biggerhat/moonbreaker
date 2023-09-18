<?php

namespace App\Models;

use App\Traits\ToSelectOptionsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Action extends Model {
    use HasFactory;
    use ToSelectOptionsScope;

    protected $guarded = [];

    protected static function booted(): void {
        static::creating(function (Action $action) {
            $action->slug = Str::slug($action->name);
        });

        static::updating(function (Action $action) {
            $action->slug = Str::slug($action->name);
        });
    }

    public function units(): BelongsToMany {
        return $this->belongsToMany(Unit::class);
    }
}
