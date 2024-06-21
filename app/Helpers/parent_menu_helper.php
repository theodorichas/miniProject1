<?php

if (!function_exists('groupMenusByParent')) {
    function groupMenusByParent($menus)
    {
        echo "Helper function loaded."; // Debug statement
        $groupedMenus = [];
        foreach ($menus as $menu) {
            $parent = $menu->parent_menu ?: 'root';
            if (!isset($groupedMenus[$parent])) {
                $groupedMenus[$parent] = [];
            }
            $groupedMenus[$parent][] = $menu;
        }
        return $groupedMenus;
    }
}
