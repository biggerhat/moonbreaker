<?php

namespace App\Http\Controllers;

use App\Enums\UnitAttackTypeEnum;
use App\Enums\UnitSizeEnum;
use App\Enums\UnitTypeEnum;
use App\Models\Ability;
use App\Models\Action;
use App\Models\Culture;
use App\Models\Unit;
use App\Models\VoiceActor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

class UnitAdminController extends Controller {
    public function index(Request $request) {
        return inertia("Units/Index", [
            "units" => Unit::all(),
        ]);
    }
    public function create(Request $request) {
        return inertia("Units/UnitForm", [
            "types" => fn () => UnitTypeEnum::toSelectOptions(),
            "sizes" => fn () => UnitSizeEnum::toSelectOptions(),
            "attack_types" => fn () => UnitAttackTypeEnum::toSelectOptions(),
            "cultures" => fn () => Culture::toSelectOptions("name"),
            "abilities" => fn () => Ability::toSelectOptions("name"),
            "actions" => fn () => Action::toSelectOptions("name"),
            "voice_actors" => fn () => VoiceActor::toSelectOptions("name"),
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "name" => ["required", "string"],
            "cultures" => ["required", "array"],
            "type" => ["required", new Enum(UnitTypeEnum::class)],
            "size" => ["required", new Enum(UnitSizeEnum::class)],
            "cost" => ["required", "integer"],
            "cinder" => ["required", "integer"],
            "attack_type" => ["required", new Enum(UnitAttackTypeEnum::class)],
            "damage" => ["nullable"],
            "health" => ["required", "integer"],
            "speed" => ["nullable"],
            "actions" => ["nullable", "array"],
            "abilities" => ["nullable", "array"],
            "is_hireable" => ["required", "boolean"],
            "voice_actor" => ["nullable"],
            "basic_image" => ["required","file","max:30000","mimes:heic,jpeg,jpg,png,webp"],
        ]);

        $cultures = $validated["cultures"];
        $cultures = collect($cultures)->pluck("value");
        unset($validated["cultures"]);

        $actions = $validated["actions"];
        $actions = collect($actions)->pluck("value");
        unset($validated["actions"]);

        $abilities = $validated["abilities"];
        $abilities = collect($abilities)->pluck("value");
        unset($validated["abilities"]);

        if ($request->basic_image) {
            $basicImage = Storage::disk("public")->put("units", $request->basic_image);
            unset($validated["basic_image"]);
            $validated["base_image"] = $basicImage;
        }

        $unit = Unit::create($validated);
        $unit->cultures()->sync($cultures);
        $unit->actions()->sync($actions);
        $unit->abilities()->sync($abilities);

        return redirect()->route("admin.units.index")->withMessage("Unit added successfully.");
    }

    public function edit(Request $request, Unit $unit) {
        $unit->loadMissing("cultures", "actions", "abilities");

        $assignedCultures = $unit->cultures->map(function ($culture) {
            return ["name" => $culture->name, "value" => $culture->id];
        });

        $assignedActions = $unit->actions->map(function ($action) {
            return ["name" => $action->name, "value" => $action->id];
        });

        $assignedAbilities = $unit->abilities->map(function ($ability) {
            return ["name" => $ability->name, "value" => $ability->id];
        });

        return inertia("Units/UnitForm", [
            "unit" => fn () => $unit,
            "selected_cultures" => fn () => $assignedCultures,
            "selected_actions" => fn () => $assignedActions,
            "selected_abilities" => fn () => $assignedAbilities,
            "types" => fn () => UnitTypeEnum::toSelectOptions(),
            "sizes" => fn () => UnitSizeEnum::toSelectOptions(),
            "attack_types" => fn () => UnitAttackTypeEnum::toSelectOptions(),
            "cultures" => fn () => Culture::toSelectOptions("name"),
            "abilities" => fn () => Ability::toSelectOptions("name"),
            "actions" => fn () => Action::toSelectOptions("name"),
            "voice_actors" => fn () => VoiceActor::toSelectOptions("name"),
        ]);
    }

    public function update(Request $request, Unit $unit) {
        $validated = $request->validate([
            "name" => ["required", "string", "unique:units,name,{$unit->id}"],
            "cultures" => ["required", "array"],
            "type" => ["required", new Enum(UnitTypeEnum::class)],
            "size" => ["required", new Enum(UnitSizeEnum::class)],
            "cost" => ["required", "integer"],
            "cinder" => ["required", "integer"],
            "attack_type" => ["required", new Enum(UnitAttackTypeEnum::class)],
            "damage" => ["nullable"],
            "health" => ["required", "integer"],
            "speed" => ["nullable"],
            "actions" => ["nullable", "array"],
            "abilities" => ["nullable", "array"],
            "is_hireable" => ["required", "boolean"],
            "voice_actor" => ["nullable"],
            "basic_image" => ["nullable","file","max:30000","mimes:heic,jpeg,jpg,png,webp"],
        ]);

        $cultures = $validated["cultures"];
        $cultures = collect($cultures)->pluck("value");
        unset($validated["cultures"]);

        $actions = $validated["actions"];
        $actions = collect($actions)->pluck("value");
        unset($validated["actions"]);

        $abilities = $validated["abilities"];
        $abilities = collect($abilities)->pluck("value");
        unset($validated["abilities"]);

        if ($request->basic_image) {
            $basicImage = Storage::disk("public")->put("units", $request->basic_image);
            unset($validated["basic_image"]);
            $validated["base_image"] = $basicImage;
        } else {
            unset($validated["basic_image"]);
        }

        $unit->update($validated);
        $unit->cultures()->sync($cultures);
        $unit->actions()->sync($actions);
        $unit->abilities()->sync($abilities);

        return redirect()->route("admin.units.index")->withMessage("Unit updated successfully.");
    }

    public function delete(Request $request, Unit $unit) {
        $unit->delete();

        return redirect()->route("admin.units.index")->withMessage("Unit has been deleted.");
    }
}
