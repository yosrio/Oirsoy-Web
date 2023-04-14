<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sidebar;

class SidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sidebarData = [
            [
                'header' => 'Pages',
                'item' =>  json_encode([
                    "items" =>  [
                        [
                            "menu_id" => "dashboardMenu",
                            "menu_title" => "Dashboard",
                            "route" => "dashboard",
                            "feather" => "sliders"
                        ]
                    ]
                ]),
                'sort_order' => 0
            ],
            [
                'header' => 'Admin',
                'item' =>  json_encode([
                    "items" =>  [
                        [
                            "menu_id" => "usersMenu",
                            "menu_title" => "Users",
                            "route" => "users",
                            "feather" => "users"
                        ],
                        [
                            "menu_id" => "rolesMenu",
                            "menu_title" => "Roles",
                            "route" => "roles",
                            "feather" => "user-check"
                        ]
                    ]
                ]),
                'sort_order' => 20
            ],
            [
                'header' => 'System',
                'item' =>  json_encode([
                    "items" =>  [
                        [
                            "menu_id" => "configMenu",
                            "menu_title" => "Configuration",
                            "route" => "config",
                            "feather" => "server"
                        ]
                    ]
                ]),
                'sort_order' => 60
            ],
            [
                'header' => 'Message',
                'item' =>  json_encode([
                    "items" =>  [
                        [
                            "menu_id" => "inboxMenu",
                            "menu_title" => "Inbox",
                            "route" => "feather",
                            "feather" => "inbox"
                        ],
                        [
                            "menu_id" => "sentMenu",
                            "menu_title" => "Sent",
                            "route" => "sent",
                            "feather" => "send"
                        ]
                    ]
                ]),
                'sort_order' => 40
            ]
        ];
        Sidebar::upsert($sidebarData, ['header']);
    }
}
