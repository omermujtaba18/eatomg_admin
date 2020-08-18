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
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"> <?= isset($addon) ? 'Update add-on' : 'Create a new add on' ?>
                            <a class="btn btn-primary btn-sm" href="/addon">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-6" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid" id="name" type="text" placeholder="addon-plate" name="name" value="<?= isset($addon['addon_name']) ? $addon['addon_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Instruction</label>
                                    <input class="form-control form-control-solid" id="instruction" type="text" placeholder="Please select an addon" name="instruction" value="<?= isset($addon['addon_instruct']) ? $addon['addon_instruct'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control form-control-solid col-3" placeholder="1.99" step="0.01" id="price" name="price" value="<?= isset($addon['addon_price']) ? $addon['addon_price'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="items">Items</label>
                                    <small class="form-text text-muted">Seperate multiple items with a comma ( , )</small>
                                    <textarea class="form-control form-control-solid" id="items" rows="8" name="items"><?= isset($addon['addon_item']) ? $addon['addon_item'] : ''; ?></textarea>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($addon) ? 'Update addon' : 'Create addon' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>