<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new dashboard testing</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('asset/css/testing.css') ?>">
    <!-- Links -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="asset/AdminLTE/dist/img/AdminLTELogo.png" alt="">
                    <h2 class="program-name">
                        Puka
                        <p>System</p>
                    </h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-outlined">
                        close
                    </span>
                </div>
            </div>
            <!-- Menu -->

            <!-- Sidebar -->
            <div class="sidebar">

                <div class="search-bar" data-widget="sidebar-search">
                    <input id="search-input" class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" oninput="filterMenu()">
                </div>
                <?php if (session()->has('user_id')) : ?>
                    <?php foreach ($menus as $menu) : ?>
                        <?php
                        $visibilityClass = ($menu->visible == 0) ? 'd-none' : '';
                        $hasPermission = false;
                        foreach ($permission as $perm) {
                            if ($perm->menu_id == $menu->menu_id && $perm->view == 1) {
                                $hasPermission = true;
                                break;
                            }
                        }
                        ?>
                        <?php if ($hasPermission) : ?>
                            <div class="menu-item <?= $visibilityClass ?>">
                                <a href="<?= base_url($menu->file_name) ?>" class="active">
                                    <span class="material-symbols-outlined">
                                        <?= $menu->icon ?>
                                    </span>
                                    <h3><?= $menu->menu_name ?></h3>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="brand-text font-weight-light">
                        <p class="sidemenu"><?= lang('app.sidemenu-alert'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </aside>
        <!-- End Sidebar -->
        <main>
            <h1>Dashboard</h1>

            <div class="date">
                <input type="date" />
            </div>

            <div class="insights">
                <?php if (session()->has('user_id')) : ?>
                    <div class="content-wrapper">
                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid">
                                <div class="w3-container">
                                    <?= $this->renderSection('content'); ?>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <!-- /.content-wrapper -->
                <?php else : ?>
                    <div class="login-req">
                        <h1>
                            <?= lang('app.login-require') ?>
                        </h1>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-outlined active">
                        light_mode
                    </span>
                    <span class="material-symbols-outlined">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <?php if (!empty($nama)) : ?>
                            <a class="username" data-toggle="dropdown" href="#" id="welcome-text">
                                <p>Welcome back, <?= $nama; ?></p>
                            </a>
                            <div class="log-out-btn">
                                <!-- <a href="<?= base_url('/myprofile') ?>" class="dropdown-item dropdown-footer">Edit Profile</a> -->
                                <a href="<?= base_url('/logout') ?>" class="dropdown-item dropdown-footer">Log-out</a>
                            </div>
                        <?php else : ?>
                            <a href="<?= base_url('/login') ?>" class="nav-link">
                                <p>Log-in</p>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <!-- Add updates div here | JS insertion -->
            </div>

            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div id="analytics">
                    <!-- Add items div here | JS insertion -->
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp"> add </span>
                        <h3>Add Product</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Local JS -->
        <script src="<?= base_url('asset/js/testing.js') ?>"></script>

        <!-- menu Search bar script -->
        <script>
            function filterMenu() {
                const searchInput = document.getElementById('search-input').value.toLowerCase();
                const menuItems = document.querySelectorAll('.menu-item');

                menuItems.forEach(item => {
                    const menuName = item.querySelector('h3').textContent.toLowerCase();
                    if (menuName.includes(searchInput)) {
                        item.style.display = 'block'; // Show item
                    } else {
                        item.style.display = 'none'; // Hide item
                    }
                });
            }
        </script>
    </div>
</body>

</html>