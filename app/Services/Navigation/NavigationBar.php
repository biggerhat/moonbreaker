<?php

namespace App\Services\Navigation;

use App\Models\Culture;
use App\Models\User;

class NavigationBar {

    /**
     * @param User|null $user
     * @return array
     */
    public static function build(?User $user): array {
        $links = [];

        $links =  array_merge($links, self::basic());

        if (!$user) {
            return $links;
        }

        if ($user->hasRole("super_admin")) {
            $links = array_merge($links, self::superAdmin());
        }

        return $links;
    }

    private static function basic(): array {
        $cultures = Culture::all();

        $culturesMenu = [];
        foreach ($cultures as $culture) {
            $culturesMenu[] = [
                "label" => $culture->name,
                "icon" => "pi pi-users",
                "route" => route("cultures.view", $culture),
            ];
        }

        $basic = [
            [
                "label" => "Cultures",
                "icon" => "fa fa-street-view",
                "items" => $culturesMenu,
            ],
            [
                "label" => "Roster Lists",
                "icon" => "pi pi-list",
                "route" => route("rosters.index"),
            ]
        ];

        return $basic;
    }

    private static function superAdmin(): array {
        return [
            [
                "label" => "Admin",
                "icon" => "pi pi-wrench",
                "items" => [
                    [
                        "label" => "Cultures",
                        "icon" => "pi pi-wrench",
                        "route" => route("admin.cultures.index"),
                    ],
                    [
                        "label" => "Abilities",
                        "icon" => "pi pi-wrench",
                        "route" => route("admin.abilities.index"),
                    ],
                    [
                        "label" => "Actions",
                        "icon" => "pi pi-wrench",
                        "route" => route("admin.actions.index"),
                    ],
                    [
                        "label" => "Units",
                        "icon" => "pi pi-wrench",
                        "route" => route("admin.units.index"),
                    ]
                ]
            ]
        ];
    }
}
