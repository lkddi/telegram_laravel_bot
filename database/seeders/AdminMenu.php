<?php

namespace Database\Seeders;

use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Models\Menu;
use Dcat\Admin\Models\Permission;
use Dcat\Admin\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createdAt = date('Y-m-d H:i:s');
        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id'     => 0,
                'order'         => 1,
                'title'         => 'Index',
                'icon'          => 'feather icon-bar-chart-2',
                'uri'           => '/',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 2,
                'title'         => '群组管理',
                'icon'          => 'fa-align-center',
                'uri'           => '',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 3,
                'title'         => 'Bot设置',
                'icon'          => 'fa-bank',
                'uri'           => '',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 0,
                'order'         => 4,
                'title'         => 'Admin',
                'icon'          => 'feather icon-settings',
                'uri'           => '',
                'created_at'    => $createdAt,
            ],




//群组管理
            [
                'parent_id'     => 2,
                'order'         => 1,
                'title'         => '群组列表',
                'icon'          => 'fa-bar-chart-o',
                'uri'           => 'groups',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 2,
                'order'         => 2,
                'title'         => '群管理',
                'icon'          => 'fa-area-chart',
                'uri'           => 'tadmins',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 2,
                'order'         => 3,
                'title'         => '群用户',
                'icon'          => 'fa-chain-broken',
                'uri'           => 'tusers',
                'created_at'    => $createdAt,
            ],
//            [
//                'parent_id'     => 2,
//                'order'         => 4,
//                'title'         => '实贩导入',
//                'icon'          => 'fa-plus',
//                'uri'           => 'nccsale/import',
//                'created_at'    => $createdAt,
//            ],


            //机器人设置菜单
            [
                'parent_id'     => 3,
                'order'         => 1,
                'title'         => 'bot设置',
                'icon'          => 'fa-product-hunt',
                'uri'           => 'botset',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 3,
                'order'         => 2,
                'title'         => '验证设置',
                'icon'          => 'fa-sitemap',
                'uri'           => 'verification',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 3,
                'order'         => 3,
                'title'         => '网站设置',
                'icon'          => 'fa-list-ul',
                'uri'           => 'webset',
                'created_at'    => $createdAt,
            ],

            //系统设置菜单
            [
                'parent_id'     => 4,
                'order'         => 3,
                'title'         => 'Users',
                'icon'          => '',
                'uri'           => 'auth/users',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 4,
                'order'         => 4,
                'title'         => 'Roles',
                'icon'          => '',
                'uri'           => 'auth/roles',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 4,
                'order'         => 5,
                'title'         => 'Permission',
                'icon'          => '',
                'uri'           => 'auth/permissions',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 4,
                'order'         => 6,
                'title'         => 'Menu',
                'icon'          => '',
                'uri'           => 'auth/menu',
                'created_at'    => $createdAt,
            ],
            [
                'parent_id'     => 4,
                'order'         => 7,
                'title'         => 'Extensions',
                'icon'          => '',
                'uri'           => 'auth/extensions',
                'created_at'    => $createdAt,
            ],

        ]);

        (new Menu())->flushCache();
    }
}
