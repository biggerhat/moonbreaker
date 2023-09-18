<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CultureAdminController extends Controller {
    public function index(Request $request) {
        return inertia("Cultures/AdminIndex", [
            "cultures" => Culture::all(),
        ]);
    }
    public function create(Request $request) {
        return inertia("Cultures/CultureForm");
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "name" => ["required", "string", "unique:cultures,name"],
            "description" => ["nullable", "string"]
        ]);

        Culture::create($validated);

        return redirect()->route("admin.cultures.index")->withMessage("Culture created successfully");
    }

    public function edit(Request $request, Culture $culture) {
        return inertia("Cultures/CultureForm", [
            "culture" => $culture,
        ]);
    }

    public function update(Request $request, Culture $culture) {
        $validated = $request->validate([
            "name" => ["required", "string", "unique:cultures,name,{$culture->id}"],
            "description" => ["nullable", "string"]
        ]);

        $culture->update($validated);

        return redirect()->route("admin.cultures.index")->withMessage("Culture updated successfully");
    }

    public function delete(Request $request, Culture $culture) {
        $culture->delete();

        return redirect()->route("admin.cultures.index")->withMessage("Culture has been deleted.");
    }
}
