<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"><?= esc(ucfirst($title)); ?>
                            <a class="btn btn-primary btn-sm" href="inventory/create">Add a new inventory</a>
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 1em;">ID</th>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Unit/Item</th>
                                            <th>Quantity/Item</th>
                                            <th>Stock</th>
                                            <th>Distributor</th>
                                            <th style="min-width: 5em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($inventory)) : ?>

                                            <?php foreach ($inventory as $item) : ?>

                                                <tr>
                                                    <td><?= esc($item['inventory_id']); ?></td>
                                                    <td><?= esc($item['inventory_code']); ?></td>
                                                    <td><?= esc($item['inventory_desc']); ?></td>
                                                    <td><?= esc($item['inventory_unit']); ?></td>
                                                    <td><?= esc($item['inventory_price']); ?></td>
                                                    <td><?= esc($item['inventory_item_unit']); ?></td>
                                                    <td><?= esc($item['inventory_item_amount']); ?></td>
                                                    <td><?= esc($item['inventory_stock']); ?></td>
                                                    <td><?= esc($item['inventory_distributor_abbr']); ?></td>
                                                    <td>
                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/inventory/update/<?= esc($item['inventory_id']); ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="/inventory/delete/<?= esc($item['inventory_id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i data-feather="trash-2"></i></a>
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