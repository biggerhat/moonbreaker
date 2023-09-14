<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionAdminController extends Controller {
    public function index(Request $request) {
        return inertia("Actions/Index", [
            "actions" => Action::all(),
        ]);
    }
    public function create(Request $request) {
        return inertia("Actions/ActionForm");
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "name" => ["required", "string", "unique:actions,name"],
            "cost" => ["required", "integer"],
            "description" => ["required", "string"]
        ]);

        Action::create($validated);

        return redirect()->route("admin.actions.index")->withMessage("Action created successfully.");
    }

    public function edit(Request $request, Action $action) {
        return inertia("Action/ActionForm", [
            "action" => $action,
        ]);
    }

    public function update(Request $request, Action $action) {
        $validated = $request->validate([
            "name" => ["required", "string", "unique:actions,name,{$action->id}"],
            "cost" => ["required", "integer"],
            "description" => ["required", "string"]
        ]);

        $action->update($validated);

        return redirect()->route("admin.actions.index")->withMessage("Action updated successfully.");
    }

    public function delete(Request $request, Action $action) {
        $action->delete();

        return redirect()->route("admin.actions.index")->withMessage("Action has been deleted.");
    }
}
