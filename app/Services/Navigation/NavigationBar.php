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
        $basic = [
            [
                "label" => "Cultures",
                "icon" => "pi pi-sun",
                "items" => [
                    [
                        "label" => "View All",
                        "icon" => "pi pi-sun",
                        "route" => route("cultures.index"),
                    ],
                    $cultures->flatMap(function (Culture $culture) {
                        return [
                            "label" => $culture->name,
                            "icon" => "pi pi-sun",
                            "route" => route("cultures.view", $culture),
                        ];
                    })
                ],
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
