<?php

namespace App\Models;

use App\Enums\UnitAttackTypeEnum;
use App\Enums\UnitSizeEnum;
use App\Enums\UnitTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Unit extends Model {
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        "type" => UnitTypeEnum::class,
        "size" => UnitSizeEnum::class,
        "attack_type" => UnitAttackTypeEnum::class,
    ];

    protected static function booted(): void {
        static::creating(function (Unit $unit) {
            $unit->slug = Str::slug($unit->name);
        });

        static::updating(function (Unit $unit) {
            $unit->slug = Str::slug($unit->name);
        });
    }

    public function cultures(): BelongsToMany {
        return $this->belongsToMany(Culture::class);
    }

    public function actions(): BelongsToMany {
        return $this->belongsToMany(Action::class);
    }

    public function abilities(): BelongsToMany {
        return $this->belongsToMany(Ability::class);
    }

    public function voiceActors(): BelongsTo {
        return $this->belongsTo(VoiceActor::class);
    }


}
