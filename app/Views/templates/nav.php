<?php

use App\Models\RestaurantModel;

$restaurantModel = new RestaurantModel();
$restaurant = $restaurantModel->orderBy('priority', 'ASC')->findAll();
?>


<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu mb-5">
                <div class="nav accordion" id="accordionSidenav">

                    <?php if ($_SESSION['user_role'] == 'A') : ?>
                        <div class="sidenav-menu-heading">Administrator</div>

                        <a class="nav-link <?= $title == 'overview' ? 'active' : ''; ?>" href="/dashboard">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link <?= $title == 'users' ? 'active' : ''; ?>" href="/user">
                            <div class="nav-link-icon"><i data-feather="user-plus"></i></div>
                            Users
                        </a>
                        <a class="nav-link <?= $title == 'restaurants' ? 'active' : ''; ?>" href="/restaurant">
                            <div class="nav-link-icon"><i data-feather="compass"></i></div>
                            Restaurant
                        </a>
                        <a class="nav-link <?= $title == 'Facebook Auto Post'  ? 'active' : ''; ?>" href="/facebook">
                            <div class="nav-link-icon"><i data-feather="user-plus"></i></div>
                            Facebook Auto Post
                        </a>
                        <a class="nav-link <?= $title == 'customers' ? 'active' : ''; ?>" href="/customer">
                            <div class="nav-link-icon"><i data-feather="users"></i></div>
                            Customers
                        </a>
                        <a class="nav-link <?= $title == 'email' ? 'active' : ''; ?>" href="/email">
                            <div class="nav-link-icon"><i data-feather="mail"></i></div>
                            CRM (Emails)
                        </a>
                        <a class="nav-link <?= $title == 'sms' ? 'active' : ''; ?>" href="/sms">
                            <div class="nav-link-icon"><i data-feather="mail"></i></div>
                            CRM (SMS)
                        </a>
                    <?php endif; ?>


                    <?php foreach ($restaurant as $r) :
                        if ($_SESSION['user_role'] == 'A' || $_SESSION['user_rest'] == $r['rest_id']) : ?>
                            <div class="sidenav-menu-heading"><?= $r['rest_name']; ?></div>
                            <a class="nav-link" href="/order?rest_id=<?= $r['rest_id']; ?>">
                                <div class="nav-link-icon"><i data-feather="clipboard"></i></div>
                                Orders
                            </a>
                            <?php if ($_SESSION['user_role'] != 'E') : ?>
                                <a class="nav-link" href="/item?rest_id=<?= $r['rest_id']; ?>">
                                    <div class="nav-link-icon"><i data-feather="menu"></i></div>
                                    Menu Items
                                </a>
                                <a class="nav-link" href="/category?rest_id=<?= $r['rest_id']; ?>">
                                    <div class="nav-link-icon"><i data-feather="grid"></i></div>
                                    Category
                                </a>
                                <a class="nav-link" href="/modifier?rest_id=<?= $r['rest_id']; ?>">
                                    <div class="nav-link-icon"><i data-feather="list"></i></div>
                                    Modifier
                                </a>
                                <a class="nav-link" href="/addon?rest_id=<?= $r['rest_id']; ?>">
                                    <div class="nav-link-icon"><i data-feather="plus-square"></i></div>
                                    Addon
                                </a>
                                <a class="nav-link" href="/promotion?rest_id=<?= $r['rest_id']; ?>">
                                    <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                                    Promotion
                                </a>
                                <!-- <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="false" aria-controls="collapseInventory">
                                    <div class="nav-link-icon"><i data-feather="package"></i></div>
                                    Inventory
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a> -->
                                <!-- <div class="collapse" id="collapseInventory" data-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="/inventory?rest_id=<?php // $r['rest_id']; 
                                                                                                                        ?>">Item</a></nav>
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="/inventory/category?rest_id=<?php // $r['rest_id']; 
                                                                                                                                ?>">Category</a></nav>
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="/inventory/distributor?rest_id=<?php // $r['rest_id']; 
                                                                                                                                    ?>">Distributor</a></nav>
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="/inventory/recipe?rest_id=<?php // $r['rest_id']; 
                                                                                                                                ?>">Recipe</a></nav>
                                </div> -->
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </div>
        </nav>
    </div>