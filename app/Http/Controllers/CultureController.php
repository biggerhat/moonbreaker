<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Http\Request;

class CultureController extends Controller {
    public function view(Request $request, Culture $culture) {
        $culture->loadMissing("units");

        return inertia("Cultures/View", [
            "culture" => $culture,
            "captains" => $culture->captains(),
        ]);
    }
}
