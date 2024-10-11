<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?= base_url('asset/css/placeholder.css') ?>">
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
                    <span class="material-icons-sharp"> close </span>
                </div>
            </div>

            <div class="sidebar">
                <!-- Search Bar -->
                <div class="search-bar" data-widget="sidebar-search">
                    <input id="search-input" class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" oninput="filterMenu()">
                </div>

                <!-- Dynamic Menu based on Permissions -->
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
                            <a href="<?= base_url($menu->file_name) ?>" class="menu-item <?= $visibilityClass ?>">
                                <span class="material-symbols-outlined"><?= $menu->icon ?></span>
                                <h3><?= $menu->menu_name ?></h3>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="brand-text font-weight-light">
                        <p class="sidemenu"><?= lang('app.sidemenu-alert'); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Static Menu Items -->
                <a href="#" class="active">
                    <span class="material-icons-sharp"> dashboard </span>
                    <h3>Dashboard</h3>
                </a>
                <!-- Add other static links as needed -->
            </div>

        </aside>

        <main>
            <h1>Dashboard</h1>

            <div class="date">
                <input type="date" />
            </div>

            <div class="insights">
                <!-- SALES -->
                <div class="sales">
                    <span class="material-icons-sharp"> analytics </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Sales</h3>
                            <h1>$25,024</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted"> Last 24 hours </small>
                </div>

                <!-- EXPENSES -->
                <div class="expenses">
                    <span class="material-icons-sharp"> bar_chart </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Expenses</h3>
                            <h1>$14,160</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>62%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted"> Last 24 hours </small>
                </div>

                <!-- INCOME -->
                <div class="income">
                    <span class="material-icons-sharp"> stacked_line_chart </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Income</h3>
                            <h1>$10,864</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>44%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted"> Last 24 hours </small>
                </div>
            </div>

            <div class="recent-orders">
                <h2>Recent Orders</h2>
                <table id="recent-orders--table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <!-- Add tbody here | JS insertion -->
                </table>
                <a href="#">Show All</a>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp"> menu </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active"> light_mode </span>
                    <span class="material-icons-sharp"> dark_mode </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Bruno</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="./images/profile-1.jpg" alt="Profile Picture" />
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
    </div>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="<?= base_url('asset/js/placeholder.js') ?>"></script>
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
</body>

</html>