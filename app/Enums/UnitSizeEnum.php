<?php

namespace App\Enums;

use App\Traits\DefaultLabelsFromEnum;
use App\Traits\ToSelectOptionsFromEnum;

enum UnitSizeEnum: string {
    use ToSelectOptionsFromEnum;
    use DefaultLabelsFromEnum;

    case small = "small";
    case large = "large";
}
