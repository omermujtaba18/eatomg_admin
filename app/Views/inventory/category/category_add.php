<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"> <?= isset($inventory_category) ? 'Update inventory category' : 'Create a new inventory category' ?>
                            <a class="btn btn-primary btn-sm" href="/inventory/category">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-6" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid" id="name" type="text" placeholder="Bread" name="name" value="<?= isset($inventory_category['inventory_category_name']) ? $inventory_category['inventory_category_name'] : ''; ?>" required>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($inventory_category) ? 'Update category' : 'Create category' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>