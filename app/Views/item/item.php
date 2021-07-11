<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0">Menu <?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"></div>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">Menu <?= esc(ucfirst($title)); ?>
                            <a class="btn btn-primary btn-sm" href="/item/create?rest_id=<?= $rest_id; ?>">Add a new item</a>
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Type</th>
                                            <th>Modifier</th>
                                            <th>Addon</th>
                                            <th>Price</th>
                                            <th style="min-width: 5em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($items)) : ?>

                                            <?php foreach ($items as $item) : ?>

                                                <tr>
                                                    <td><img src="<?= isset($item->item_pic) && !empty($item->item_pic) ? $item->item_pic : "https://img.icons8.com/material-outlined/96/000000/image.png" ?>" width="50" height="50" /></td>

                                                    <td><?= esc($item->item_name); ?></td>
                                                    <td><?= esc($item->category_name); ?></td>
                                                    <td><?= esc(ucfirst($item->category_type)); ?></td>
                                                    <td>
                                                        <?php
                                                        $item_modifiers = $itemModifier->where('item_id', $item->item_id)->findAll();

                                                        foreach ($item_modifiers as $key => $value) {
                                                            $modifier = $modifierGroup->where('modifier_group_id', $item_modifiers[$key]['modifier_group_id'])->first();
                                                            echo ("<span class='badge badge-pill badge-success'>" . $modifier['modifier_group_instruct'] . "</span><br>");
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $item_addons = $itemAddon->where('item_id', $item->item_id)->findAll();

                                                        foreach ($item_addons as $key => $value) {
                                                            $addon = $addonGroup->where('addon_group_id', $item_addons[$key]['addon_group_id'])->first();
                                                            echo ("<span class='badge badge-pill badge-success'>" . $addon['addon_group_instruct'] . "</span><br>");
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= esc('$' . $item->item_price); ?></td>
                                                    <td>
                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/item/update/<?= esc($item->item_id); ?>?rest_id=<?= $rest_id; ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="/item/delete/<?= esc($item->item_id); ?>?rest_id=<?= $rest_id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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