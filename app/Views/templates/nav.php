<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
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
                    <!-- <div class="sidenav-menu-heading">RESTAURANT</div>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                            data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="nav-link-icon"><i data-feather="layout"></i></div>
                            Layout
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a><a class="nav-link"
                                    href="layout-dark.html">Dark Sidenav</a><a class="nav-link"
                                    href="layout-rtl.html">RTL Layout</a><a class="nav-link collapsed" href="#"
                                    data-toggle="collapse" data-target="#collapseLayoutsPageHeaders"
                                    aria-expanded="false" aria-controls="collapseLayoutsPageHeaders">Page Headers
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                <div class="collapse" id="collapseLayoutsPageHeaders"
                                    data-parent="#accordionSidenavLayout">
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link"
                                            href="header-simplified.html">Simplified</a><a class="nav-link"
                                            href="header-overlap.html">Content Overlap</a><a class="nav-link"
                                            href="header-breadcrumbs.html">Breadcrumbs</a><a class="nav-link"
                                            href="header-light.html">Light</a></nav>
                                </div>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                            data-target="#collapseComponents" aria-expanded="false" aria-controls="collapseComponents">
                            <div class="nav-link-icon"><i data-feather="package"></i></div>
                            Components
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseComponents" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="alerts.html">Alerts</a><a class="nav-link"
                                    href="avatars.html">Avatars<span class="badge badge-primary ml-2">New!</span></a><a
                                    class="nav-link" href="badges.html">Badges</a><a class="nav-link"
                                    href="buttons.html">Buttons</a><a class="nav-link" href="cards.html">Cards</a><a
                                    class="nav-link" href="dropdowns.html">Dropdowns</a><a class="nav-link"
                                    href="forms.html">Forms</a><a class="nav-link" href="modals.html">Modals</a><a
                                    class="nav-link" href="navigation.html">Navigation</a><a class="nav-link"
                                    href="progress.html">Progress</a><a class="nav-link" href="toasts.html">Toasts</a><a
                                    class="nav-link" href="tooltips.html">Tooltips</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                            data-target="#collapseUtilities" aria-expanded="false" aria-controls="collapseUtilities">
                            <div class="nav-link-icon"><i data-feather="tool"></i></div>
                            Utilities
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUtilities" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="animations.html">Animations</a><a class="nav-link"
                                    href="background.html">Background<span
                                        class="badge badge-primary ml-2">New!</span></a><a class="nav-link"
                                    href="borders.html">Borders</a><a class="nav-link" href="lift.html">Lift<span
                                        class="badge badge-primary ml-2">New!</span></a><a class="nav-link"
                                    href="shadows.html">Shadows</a><a class="nav-link"
                                    href="typography.html">Typography</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                            data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="nav-link-icon"><i data-feather="book-open"></i></div>
                            Pages
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">Authentication
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                <div class="collapse" id="pagesCollapseAuth" data-parent="#accordionSidenavPagesMenu">
                                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesAuth">
                                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                                            data-target="#pagesCollapseAuthBasic" aria-expanded="false"
                                            aria-controls="pagesCollapseAuthBasic">Basic
                                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseAuthBasic"
                                            data-parent="#accordionSidenavPagesAuth">
                                            <nav class="sidenav-menu-nested nav"><a class="nav-link"
                                                    href="login-basic.html">Login</a><a class="nav-link"
                                                    href="register-basic.html">Register</a><a class="nav-link"
                                                    href="password-basic.html">Forgot Password</a></nav>
                                        </div>
                                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                                            data-target="#pagesCollapseAuthSocial" aria-expanded="false"
                                            aria-controls="pagesCollapseAuthSocial">Social
                                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseAuthSocial"
                                            data-parent="#accordionSidenavPagesAuth">
                                            <nav class="sidenav-menu-nested nav"><a class="nav-link"
                                                    href="login-social.html">Login</a><a class="nav-link"
                                                    href="register-social.html">Register</a><a class="nav-link"
                                                    href="password-social.html">Forgot Password</a></nav>
                                        </div>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">Error
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div></a>
                                <div class="collapse" id="pagesCollapseError" data-parent="#accordionSidenavPagesMenu">
                                    <nav class="sidenav-menu-nested nav"><a class="nav-link" href="401.html">401
                                            Page</a><a class="nav-link" href="404.html">404 Page</a><a class="nav-link"
                                            href="404-glitch.html">404 Page (Glitch Effect)</a><a class="nav-link"
                                            href="500.html">500 Page</a></nav>
                                </div>
                                <a class="nav-link" href="blank.html">Blank</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                            data-target="#collapseFlows" aria-expanded="false" aria-controls="collapseFlows">
                            <div class="nav-link-icon"><i data-feather="repeat"></i></div>
                            Flows
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseFlows" data-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav"><a class="nav-link"
                                    href="multi-tenant-select.html">Multi-Tenant Registration</a></nav>
                        </div> -->

                </div>
            </div>
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title"><?= $_SESSION['user_name']; ?></div>
                </div>
            </div>
        </nav>
    </div>