<?php
$roles = ['A' => 'Administrator', 'BM' => 'Branch Manager', 'E' => 'Employee'];
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"></div>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"><?= esc(ucfirst($title)); ?>
                            <a class="btn btn-primary btn-sm" href="/restaurant/create">Add a new restaurant</a>
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Priority</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>URL</th>
                                            <th style="min-width: 5em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($restaurants)) : ?>

                                            <?php foreach ($restaurants as $r) : ?>

                                                <tr>
                                                    <td><?= esc($r['priority']); ?></td>
                                                    <td><?= esc($r['rest_name']); ?></td>
                                                    <td><?= esc($r['rest_address']); ?></td>
                                                    <td><?= esc($r['rest_phone']); ?></td>
                                                    <td><?= esc($r['url']); ?></td>
                                                    <td>
                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/restaurant/update/<?= esc($r['rest_id']); ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="/restaurant/delete/<?= esc($r['rest_id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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