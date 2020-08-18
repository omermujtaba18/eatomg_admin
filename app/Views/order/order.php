<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary text-right"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"><?= esc(ucfirst($title)); ?>
                            <a class="btn btn-primary btn-sm" href="/order/create">Add a new order</a>
                        </div>
                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order#</th>
                                            <th>Customer</th>
                                            <th>Restaurant</th>
                                            <th>Ordered On</th>
                                            <th>Delivered On</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($orders)) : ?>

                                            <?php foreach ($orders as $order) : ?>

                                                <tr>
                                                    <td><?= esc($order->order_num); ?></td>
                                                    <td><?= esc($order->cus_name); ?></td>
                                                    <td><?= esc($order->rest_name); ?></td>
                                                    <td><?= esc($order->order_placed_time); ?></td>
                                                    <td><?= esc($order->order_delivery_time); ?></td>
                                                    <td><?= esc($order->order_total); ?></td>
                                                    <td>
                                                        <?php if ($order->order_status == "Pending") : ?>
                                                            <div class="badge badge-warning badge-pill"><?= esc($order->order_status); ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($order->order_status == "Confirmed") : ?>
                                                            <div class="badge badge-success badge-pill"><?= esc($order->order_status); ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($order->order_status == "Ready") : ?>
                                                            <div class="badge badge-primary badge-pill"><?= esc($order->order_status); ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($order->order_status == "Delivered") : ?>
                                                            <div class="badge badge-success badge-pill"><?= esc($order->order_status); ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($order->order_status == "Cancelled") : ?>
                                                            <div class="badge badge-danger badge-pill"><?= esc($order->order_status); ?></div>
                                                        <?php endif; ?>

                                                    </td>
                                                    <td>

                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="order/view/<?= esc($order->order_num); ?>">
                                                            <i data-feather="eye"></i></a>

                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>