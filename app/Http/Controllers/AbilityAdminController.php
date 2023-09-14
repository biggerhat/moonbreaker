<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Culture;
use Illuminate\Http\Request;

class AbilityAdminController extends Controller {
    public function index(Request $request) {
        return inertia("Abilities/Index", [
            "abilities" => Ability::all(),
        ]);
    }
    public function create(Request $request) {
        return inertia("Abilities/AbilityForm");
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "name" => ["required", "string", "unique:abilities,name"],
            "description" => ["required", "string"]
        ]);

        Ability::create($validated);

        return redirect()->route("admin.abilities.index")->withMessage("Ability created successfully.");
    }

    public function edit(Request $request, Ability $ability) {
        return inertia("Abilities/AbilityForm", [
            "ability" => $ability,
        ]);
    }

    public function update(Request $request, Ability $ability) {
        $validated = $request->validate([
            "name" => ["required", "string", "unique:abilities,name,{$ability->id}"],
            "description" => ["required", "string"]
        ]);

        $ability->update($validated);

        return redirect()->route("admin.abilities.index")->withMessage("Ability updated successfully.");
    }

    public function delete(Request $request, Ability $ability) {
        $ability->delete();

        return redirect()->route("admin.abilities.index")->withMessage("Ability has been deleted");
    }
}
