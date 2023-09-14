<?php

namespace App\Models;

use App\Traits\ToSelectOptionsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoiceActor extends Model {
    use HasFactory;
    use ToSelectOptionsScope;

    protected $guarded = [];

    public function units(): HasMany {
        return $this->hasMany(Unit::class);
    }
}
