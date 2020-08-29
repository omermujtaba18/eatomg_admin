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
                        <div class="card-header"> <?= isset($inventory) ? 'Update inventory' : 'Create a new inventory' ?>
                            <a class="btn btn-primary btn-sm" href="/inventory">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-6" method="post">
                                <div class="form-group">
                                    <label for="name">Code</label>
                                    <input class="form-control form-control-solid" id="code" type="text" placeholder="" name="code" value="<?= isset($inventory['inventory_code']) ? $inventory['inventory_code'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <input class="form-control form-control-solid" id="desc" type="text" placeholder="" name="desc" value="<?= isset($inventory['inventory_desc']) ? $inventory['inventory_desc'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Unit</label>
                                    <input class="form-control form-control-solid" id="unit" type="text" placeholder="" name="unit" value="<?= isset($inventory['inventory_unit']) ? $inventory['inventory_unit'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input class="form-control form-control-solid" id="price" type="number" step="0.01" placeholder="" name="price" value="<?= isset($inventory['inventory_price']) ? $inventory['inventory_price'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Unit/Item</label>
                                    <input class="form-control form-control-solid" id="item_unit" type="text" placeholder="" name="item_unit" value="<?= isset($inventory['inventory_item_unit']) ? $inventory['inventory_item_unit'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Quantity/Item</label>
                                    <input class="form-control form-control-solid" id="item_amount" type="number" step="0.01" placeholder="" name="item_amount" value="<?= isset($inventory['inventory_item_amount']) ? $inventory['inventory_item_amount'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Stock</label>
                                    <input class="form-control form-control-solid" id="stock" type="number" step="0.01" placeholder="" name="stock" value="<?= isset($inventory['inventory_stock']) ? $inventory['inventory_stock'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Stock Threshold</label>
                                    <input class="form-control form-control-solid" id="threshold" type="number" step="0.01" placeholder="" name="threshold" value="<?= isset($inventory['inventory_stock_threshold']) ? $inventory['inventory_stock_threshold'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Distributor</label>
                                    <select class="form-control form-control-solid" name="distributor_id">
                                        <?php foreach ($inventory_distributor as $distributor) : ?>
                                            <option value="<?= $distributor['inventory_distributor_id']; ?>" <?= isset($inventory['inventory_distributor_id']) && $inventory['inventory_distributor_id'] == $distributor['inventory_distributor_id'] ? 'selected' : '' ?>><?= $distributor['inventory_distributor_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Category</label>
                                    <select class="form-control form-control-solid" name="category_id">
                                        <?php foreach ($inventory_category as $category) : ?>
                                            <option value="<?= $category['inventory_category_id']; ?>" <?= isset($inventory['inventory_category_id']) && $inventory['inventory_category_id'] == $category['inventory_category_id'] ? 'selected' : '' ?>><?= $category['inventory_category_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($inventory) ? 'Update inventory' : 'Create inventory' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>