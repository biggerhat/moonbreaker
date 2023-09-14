<?php

namespace App\Enums;

use App\Traits\DefaultLabelsFromEnum;
use App\Traits\ToSelectOptionsFromEnum;

enum UnitAttackTypeEnum: string {
    use ToSelectOptionsFromEnum;
    use DefaultLabelsFromEnum;

    case none = "none";
    case melee = "melee";
    case ranged = "ranged";
}
