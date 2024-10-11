<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new dashboard testing</title>
    <?= $this->renderSection('links'); ?>
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
                <input type="date">
            </div>
            <!-- Start of insights -->
            <div class="insights">
                <!-- Sales -->
                <div class="sales">
                    <span class="material-symbols-outlined">
                        monitoring
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>total sales</h3>
                            <h1>$25,090</h1>
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
                    <small class="text-muted"> Last 24 hours</small>
                </div>
                <!-- End of Sales -->

                <!-- expenses -->
                <div class="expenses">
                    <span class="material-symbols-outlined">
                        bar_chart
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Expenses</h3>
                            <h1>$18,200</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>32%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted"> Last 24 hours</small>
                </div>
                <!-- End of expenses -->

                <!-- income -->
                <div class="income">
                    <span class="material-symbols-outlined">
                        payments
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>total income</h3>
                            <h1>$50,120</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>71%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted"> Last 24 hours</small>
                </div>
                <!--End of income -->
            </div>
            <!-- End of insights -->

            <!-- Start of recent orders -->
            <div class="recent-orders">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Product number</th>
                            <th>Payment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Foldable Mini Drone</th>
                            <th>Rp 250.000</th>
                            <th>due</th>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <th>Foldable Mini Drone</th>
                            <th>Rp 250.000</th>
                            <th>due</th>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <th>Foldable Mini Drone</th>
                            <th>Rp 250.000</th>
                            <th>due</th>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <th>Foldable Mini Drone</th>
                            <th>Rp 250.000</th>
                            <th>due</th>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                        <tr>
                            <th>Foldable Mini Drone</th>
                            <th>Rp 250.000</th>
                            <th>due</th>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>
                    </tbody>
                </table>
                <a href="#">Show All</a>
            </div>
            <!-- End of recent orders -->
        </main>
        <!-- End of main -->

        <!-- right -->
        <!-- top -->
        <div class="right">
            <div class="top">
                <button class="menu-btn">
                    <span class="material-symbols-outlined">
                        menu
                    </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-outlined active">
                        brightness_5
                    </span>
                    <span class="material-symbols-outlined">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p class="dropdown">
                            <?php if (!empty($nama)) ?>
                            <a href="#" class="dropbtn">
                                <p>Welcome back, <?= $nama; ?></p>
                            </a>
                            <small class="text-muted">Admin</small>
                        </p>
                    </div>
                    <div class="profile-photo">
                        <span class="material-symbols-outlined">
                            <a href="<?= base_url('/logout') ?>" class="dropdown-item dropdown-footer">logout</a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- End of top -->

            <!-- Start of recent updates -->
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="public/asset/img/Seele.jpg">
                        </div>
                        <div class="message">
                            <p><b>Nian</b> brought something unusual</p>
                            <small class="text-muted">2 days ago"></small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="public/asset/img/Seele.jpg">
                        </div>
                        <div class="message">
                            <p><b>Nian</b> brought something unusual</p>
                            <small class="text-muted">2 days ago"></small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="public/asset/img/Seele.jpg">
                        </div>
                        <div class="message">
                            <p><b>Nian</b> brought something unusual</p>
                            <small class="text-muted">2 days ago"></small>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of recent updates -->
            <div class="sales-analytics">
                <h2>Sales analytics</h2>
                <div class="item">
                    <div class="icon">
                        <span class="material-symbols-outlined">
                            shopping_cart
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Online Order</h3>
                            <small class="text-muted">Last 24 hours</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item">
                    <div class="icon">
                        <span class="material-symbols-outlined">
                            shopping_cart
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Online Order</h3>
                            <small class="text-muted">Last 24 hours</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item">
                    <div class="icon">
                        <span class="material-symbols-outlined">
                            shopping_cart
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>Online Order</h3>
                            <small class="text-muted">Last 24 hours</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div>
                        <span class="material-icons-sharp"></span>
                        <h3>Add product</h3>
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
        <?= $this->renderSection('scripts'); ?>

</body>

</html>