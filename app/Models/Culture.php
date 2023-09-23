<?php

namespace App\Models;

use App\Enums\UnitTypeEnum;
use App\Traits\ToSelectOptionsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Culture extends Model {
    use HasFactory;
    use ToSelectOptionsScope;

    protected $guarded = [];

    protected static function booted(): void {
        static::creating(function (Culture $culture) {
            $culture->slug = Str::slug($culture->name);
        });

        static::updating(function (Culture $culture) {
            $culture->slug = Str::slug($culture->name);
        });
    }

    public function units(): BelongsToMany {
        return $this->belongsToMany(Unit::class);
    }

    public function captains(): BelongsToMany {
        return $this->units()->where("type", UnitTypeEnum::captain);
    }

    public function crew(): BelongsToMany {
        return $this->units()->where("type", UnitTypeEnum::crew);
    }
}
