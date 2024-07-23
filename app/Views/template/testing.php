<!-- Original -->
<!-- <?php foreach ($groupedMenus as $parentMenu => $menus) : ?>
                                <?php if ($parentMenu == 'root') : ?>
                                    <?php foreach ($menus as $menu) : ?>
                                        <li class="nav-item">
                                            <a href="<?= base_url($menu->file_name) ?>" class="nav-link">
                                                <i class="<?= $menu->icon ?>"></i>
                                                <p><?= $menu->menu_name ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-copy"></i>
                                            <p>
                                                <?= $parentMenu ?>
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <?php foreach ($menus as $menu) : ?>
                                                <?php
                                                // Determine if the menu item should be hidden based on 'visible' status
                                                $visibilityClass = ($menu->visible == 0) ? 'd-none' : '';
                                                // Check if the user has permission to view this menu
                                                $hasPermission = false;
                                                foreach ($permission as $perm) {
                                                    if ($perm->menu_id == $menu->menu_id && $perm->view == 1) {
                                                        $hasPermission = true;
                                                        break; // No need to continue checking once permission is found
                                                    }
                                                }
                                                ?>
                                                <li class="nav-item <?= $visibilityClass ?>">
                                                    <?php if ($hasPermission) : ?>
                                                        <a href="<?= base_url($menu->file_name) ?>" class="nav-link">
                                                            <i class="<?= $menu->icon ?>"></i>
                                                            <p><?= $menu->menu_name ?></p>
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?> -->