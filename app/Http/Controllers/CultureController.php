<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Http\Request;

class CultureController extends Controller {
    public function index(Request $request) {
        dd("Hello");
    }

    public function view(Request $request, Culture $culture) {
        dd($culture);
    }
}
