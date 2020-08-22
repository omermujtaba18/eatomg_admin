<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu mb-5">
                <div class="nav accordion" id="accordionSidenav">

                    <div class="sidenav-menu-heading">Administrator</div>
                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
                        <div class="nav-link-icon"><i data-feather="activity"></i></div>
                        Dashboards
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                            <a class="nav-link <?= $title == 'overview' ? 'active' : ''; ?>" href="/dashboard">Overview</a>
                            <!-- <a class="nav-link <?= $title == 'north-eve' ? 'active' : ''; ?>" href="/dashboard/north-eve">North Ave</a>
                            <a class="nav-link <?= $title == 'evanston' ? 'active' : ''; ?>" href="/dashboard/evanston">Evanston</a>
                            <a class="nav-link <?= $title == 'west-illinois' ? 'active' : ''; ?>" href="/dashboard/west-illinois">West Illinois St</a>
                            <a class="nav-link <?= $title == 'van-buren' ? 'active' : ''; ?>" href="/dashboard/van-buren">Van Buren</a> -->
                        </nav>
                    </div>
                    <a class="nav-link <?= $title == 'users' ? 'active' : ''; ?>" href="/user">
                        <div class="nav-link-icon"><i data-feather="user-plus"></i></div>
                        Users
                    </a>
                    <div class="sidenav-menu-heading">North Ave</div>
                    <a class="nav-link <?= $title == 'orders' ? 'active' : ''; ?>" href="/order">
                        <div class="nav-link-icon"><i data-feather="clipboard"></i></div>
                        Orders
                    </a>
                    <a class="nav-link <?= $title == 'items' ? 'active' : ''; ?>" href="/item">
                        <div class="nav-link-icon"><i data-feather="menu"></i></div>
                        Menu Items
                    </a>

                    <a class="nav-link <?= $title == 'category' ? 'active' : ''; ?>" href="/category">
                        <div class="nav-link-icon"><i data-feather="grid"></i></div>
                        Category
                    </a>
                    <a class="nav-link <?= $title == 'modifiers' ? 'active' : ''; ?>" href="/modifier">
                        <div class="nav-link-icon"><i data-feather="list"></i></div>
                        Modifier
                    </a>
                    <a class="nav-link <?= $title == 'addon' ? 'active' : ''; ?>" href="/addon">
                        <div class="nav-link-icon"><i data-feather="plus-square"></i></div>
                        Addon
                    </a>
                    <a class="nav-link <?= $title == 'customers' ? 'active' : ''; ?>" href="/customer">
                        <div class="nav-link-icon"><i data-feather="users"></i></div>
                        Customers
                    </a>
                    <a class="nav-link <?= $title == 'promotion' ? 'active' : ''; ?>" href="/promotion">
                        <div class="nav-link-icon"><i data-feather="dollar-sign"></i></div>
                        Promotion
                    </a>
                    <div class="sidenav-menu-heading">Inventory</div>

                    <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="false" aria-controls="collapseInventory">
                        <div class="nav-link-icon"><i data-feather="package"></i></div>
                        Inventory
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseInventory" data-parent="#accordionSidenav">
                        <nav class="sidenav-menu-nested nav"><a class="nav-link" href="/inventory">Item</a></nav>
                        <nav class="sidenav-menu-nested nav"><a class="nav-link" href="/inventory/category">Category</a></nav>
                        <nav class="sidenav-menu-nested nav"><a class="nav-link" href="/inventory/distributor">Distributor</a></nav>
                        <nav class="sidenav-menu-nested nav"><a class="nav-link" href="/inventory/recipe">Recipe</a></nav>
                    </div>

                </div>
            </div>
            <!-- <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title"></div>
                </div>
            </div> -->
        </nav>
    </div>