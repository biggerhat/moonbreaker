<?php

namespace App\Enums;

use App\Traits\DefaultLabelsFromEnum;
use App\Traits\ToSelectOptionsFromEnum;

enum UnitTypeEnum: string {
    use ToSelectOptionsFromEnum;
    use DefaultLabelsFromEnum;
    case boss = "boss";
    case captain = "captain";
    case crew = "crew";
}
