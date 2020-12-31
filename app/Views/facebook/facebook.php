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
                            <a class="btn btn-primary btn-sm" href="/facebook/create">Add a new post</a>
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 2em;">ID</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Published</th>
                                            <th style="min-width: 5em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($facebook)) : ?>

                                            <?php foreach ($facebook as $f) : ?>

                                                <tr>
                                                    <td><?= esc($f['fb_post_id']); ?></td>
                                                    <td><?= esc($f['fb_post_description']); ?></td>
                                                    <td>
                                                        <img src="<?= esc($f['fb_post_image']); ?>"  width="100px"/>
                                                            
                                                
                                                    <td><?= esc($f['is_published']) == 0 ? 'No':'Yes'; ?></td>

                                                    <td>

                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/facebook/update/<?= esc($f['fb_post_id']); ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="/facebook/delete/<?= esc($f['fb_post_id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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