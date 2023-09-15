<?php

use App\Http\Controllers\AbilityAdminController;
use App\Http\Controllers\ActionAdminController;
use App\Http\Controllers\CultureAdminController;
use App\Http\Controllers\CultureController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\UnitAdminController;
use App\Services\Navigation\NavigationBar;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Index');
})->name("index");

Route::prefix("cultures")->name("cultures.")->group(function () {
    Route::get("/", [CultureController::class, "index"])->name("index");
    Route::get("/{culture}", [CultureController::class, "view"])->name("view");
});

Route::prefix("rosters")->name("rosters.")->group(function () {
    Route::get("/", [RosterController::class, "index"])->name("index");
});


Route::prefix("admin")->name("admin.")->middleware(["role:super_admin|admin"])->group(function () {
    Route::prefix("cultures")->name("cultures.")->group(function () {
        Route::get("/", [CultureAdminController::class, "index"])->name("index");
        Route::get("/create", [CultureAdminController::class, "create"])->name("create");
        Route::post("/create", [CultureAdminController::class, "store"])->name("store");
        Route::get("/edit/{culture}", [CultureAdminController::class, "edit"])->name("edit");
        Route::post("/edit/{culture}", [CultureAdminController::class, "update"])->name("update");
        Route::post("/delete/{culture}", [CultureAdminController::class, "delete"])->name("delete");
    });

    Route::prefix("units")->name("units.")->group(function () {
        Route::get("/", [UnitAdminController::class, "index"])->name("index");
        Route::get("/create", [UnitAdminController::class, "create"])->name("create");
        Route::post("/create", [UnitAdminController::class, "store"])->name("store");
        Route::get("/edit/{unit}", [UnitAdminController::class, "edit"])->name("edit");
        Route::post("/edit/{unit}", [UnitAdminController::class, "update"])->name("update");
        Route::post("/delete/{unit}", [UnitAdminController::class, "delete"])->name("delete");
    });

    Route::prefix("abilities")->name("abilities.")->group(function () {
        Route::get("/", [AbilityAdminController::class, "index"])->name("index");
        Route::get("/create", [AbilityAdminController::class, "create"])->name("create");
        Route::post("/create", [AbilityAdminController::class, "store"])->name("store");
        Route::get("/edit/{ability}", [AbilityAdminController::class, "edit"])->name("edit");
        Route::post("/edit/{ability}", [AbilityAdminController::class, "update"])->name("update");
        Route::post("/delete/{ability}", [AbilityAdminController::class, "delete"])->name("delete");
    });

    Route::prefix("actions")->name("actions.")->group(function () {
        Route::get("/", [ActionAdminController::class, "index"])->name("index");
        Route::get("/create", [ActionAdminController::class, "create"])->name("create");
        Route::post("/create", [ActionAdminController::class, "store"])->name("store");
        Route::get("/edit/{ability}", [ActionAdminController::class, "edit"])->name("edit");
        Route::post("/edit/{ability}", [ActionAdminController::class, "update"])->name("update");
        Route::post("/delete/{action}", [ActionAdminController::class, "delete"])->name("delete");
    });
});
