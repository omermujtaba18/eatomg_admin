<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0" id="title"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
                <!-- <div class="dropdown">
                    <a class="btn btn-white btn-sm font-weight-500 line-height-normal p-3 dropdown-toggle" id="dropdownMenuLink" href="#" role="button" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                    <i class="text-primary mr-2" data-feather="calendar"></i>Jan - Feb 2020</a>
                    <div class="dropdown-menu dropdown-menu-sm-right animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#!">Last 30 days</a>
                        <a class="dropdown-item" href="#!">Last week</a>
                        <a class="dropdown-item" href="#!">This year</a>
                        <a class="dropdown-item" href="#!">Yesterday</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">Custom</a>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-blue mb-1">Earnings (<?= $time->toLocalizedString('MMMM') ?>)</div>
                                    <div class="h5">$<?= $total; ?></div>
                                    <!-- <div class="text-xs font-weight-bold text-success d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-up"></i>12%</div> -->
                                </div>
                                <div class="ml-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-purple mb-1">Average sale price</div>
                                    <div class="h5">$<?= $average; ?></div>
                                    <!-- <div class="text-xs font-weight-bold text-danger d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-down"></i>3%</div> -->
                                </div>
                                <div class="ml-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-green mb-1">Total Orders (<?= $time->toLocalizedString('MMMM') ?>)</div>
                                    <div class="h5"><?= $totalOrders; ?></div>
                                    <!-- <div class="text-xs font-weight-bold text-success d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-up"></i>12%</div> -->
                                </div>
                                <div class="ml-2"><i class="fas fa-mouse-pointer fa-2x text-gray-200"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-top-0 border-bottom-0 border-right-0  h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <div class="small font-weight-bold text-yellow mb-1">Top Restaurant</div>
                                    <div class="h5"><?= $topRest; ?></div>
                                    <!-- <div class="text-xs font-weight-bold text-danger d-inline-flex align-items-center"><i class="mr-1" data-feather="trending-down"></i>1%</div> -->
                                </div>
                                <div class="ml-2"><i class="fas fa-percentage fa-2x text-gray-200"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-4 col-xl-3">
                    <div class="card">
                        <div class="card-header">Restaurants</div>
                        <div class="list-group list-group-flush small">
                            <a class="list-group-item list-group-item-action border-top" href="/dashboard">
                                <i class="fas fa-dollar-sign fa-fw text-blue mr-2"></i>Overview</a>
                            <?php foreach ($restaurants as $restaurant) : ?>
                                <a class="list-group-item list-group-item-action" href="/dashboard?rest_id=<?= $restaurant['rest_id']; ?>">
                                    <i class="fas fa-chart-line fa-fw text-yellow mr-2"></i><?= $restaurant['rest_name']; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">Sales Trend</div>
                        <div class="card-body">
                            <div class="chart-area"><canvas id="myAreaChart"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" row">
                <div class="col-lg-4 col-xl-3 mb-4">
                    <div class="card mb-4">
                        <div class="card-header">Reports</div>
                        <div class="list-group list-group-flush small">
                            <a class="list-group-item list-group-item-action border-top" href="" onclick="event.preventDefault();getTopSeller(event)">
                                <i class="fas fa-dollar-sign fa-fw text-blue mr-2"></i>Top Seller Items </a>
                            <a class="list-group-item list-group-item-action" href="" onclick="event.preventDefault();getTimingData()">
                                <i class="fas fa-tag fa-fw text-purple mr-2"></i>Order Timing Chart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9 mb-4">
                    <div class="card">
                        <div id="topseller">
                            <div class="card-header">Top Seller Items (<?= $time->toLocalizedString('MMMM'); ?>)</div>
                            <div class="card-body">
                                <div class="datatable table-responsive">
                                    <table class="table table-bordered table-hover" id="tableTopSeller" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Sold</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($topSellerItems)) : ?>
                                                <?php foreach ($topSellerItems as $item) : ?>
                                                    <tr>
                                                        <td><?= esc($item['item_name'] . " (" . $item['category_name'] .  ")"); ?></td>
                                                        <td><?= esc($item['total_sold']); ?></td>
                                                        <td><?= esc("$" . round($item['total_value'], 2)); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="timing">
                            <div class="card-header">Order Timing Chart (<?= $time->toLocalizedString('EEEE'); ?>)</div>
                            <div class="card-body">
                                <div class="chart-area"><canvas id="orderTimingChart" width="100%" height="30"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script id="monthlyData" src="/assets/demo/chart-area-demo.js" data-monthly="<?= json_encode($monthlyData); ?>"></script>
<script id="orderTiming" src="/assets/demo/chart-bar-demo.js" data-timing="<?= esc(json_encode($orderTiming)); ?>"></script>