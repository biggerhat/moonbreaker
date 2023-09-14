<?php

namespace App\Enums;

use App\Traits\DefaultLabelsFromEnum;

enum MessageTypeEnum: string {
    use DefaultLabelsFromEnum;

    case success = "success";
    case info = "info";
    case warn = "warn";
    case error = "error";
}
