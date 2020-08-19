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
                            <a class="btn btn-primary btn-sm" href="/addon/create">Add a new Add-On</a>
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th style="min-width: 15em;">Instruction</th>
                                            <th>Options</th>
                                            <th style="min-width: 5em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($addons)) : ?>

                                            <?php foreach ($addons as $addon) : ?>

                                                <tr>
                                                    <td><?= esc($addon['addon_group_name']); ?></td>
                                                    <td><?= esc($addon['addon_group_instruct']); ?></td>

                                                    <td>
                                                        <?php
                                                        $addonItems = $addonModel->where('addon_group_id', $addon['addon_group_id'])->findAll();
                                                        ?>
                                                        <?php foreach ($addonItems as $item) : ?>
                                                            <span class="badge badge-pill badge-success"> <?= $item['addon_item'] . ' - $' . number_format($item['addon_price'], 2, '.', ''); ?></span><br>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/addon/update/<?= esc($addon['addon_group_id']); ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="/addon/delete/<?= esc($addon['addon_group_id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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