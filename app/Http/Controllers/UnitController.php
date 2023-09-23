<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller {
    public function view(Request $request, Unit $unit) {
        dd($unit);
        return inertia("Units/View", [
            "unit" => $unit,
        ]);
    }
}
