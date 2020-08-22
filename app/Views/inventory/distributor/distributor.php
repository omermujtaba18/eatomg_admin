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
                            <a class="btn btn-primary btn-sm" href="distributor/create">Add a new distributor</a>
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 1em;">ID</th>
                                            <th>Name</th>
                                            <th>Abbreviation</th>
                                            <th>Contact Person</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th style="width: 5em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($inventory_distributor)) : ?>

                                            <?php foreach ($inventory_distributor as $distributor) : ?>

                                                <tr>
                                                    <td><?= esc($distributor['inventory_distributor_id']); ?></td>
                                                    <td><?= esc($distributor['inventory_distributor_name']); ?></td>
                                                    <td><?= esc($distributor['inventory_distributor_abbr']); ?></td>
                                                    <td><?= esc($distributor['inventory_distributor_contact']); ?></td>
                                                    <td><?= esc($distributor['inventory_distributor_email']); ?></td>
                                                    <td><?= esc($distributor['inventory_distributor_phone']); ?></td>
                                                    <td>

                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="distributor/update/<?= esc($distributor['inventory_distributor_id']); ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="distributor/delete/<?= esc($distributor['inventory_distributor_id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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