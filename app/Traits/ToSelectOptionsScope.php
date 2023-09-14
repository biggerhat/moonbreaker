<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait ToSelectOptionsScope {
    public function scopeToSelectOptions(Builder $query, string $column, $primaryKeyColumn = "id"): Collection|array {
        return $query->select([$primaryKeyColumn, $column])->get()->map(function ($model) use ($column, $primaryKeyColumn) {
            return [
                "value" => $model->{$primaryKeyColumn},
                "name" => $model->{$column},
            ];
        });
    }
}
