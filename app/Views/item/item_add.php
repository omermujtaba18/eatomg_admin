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
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"> <?= isset($item) ? 'Update item' : 'Create a new item' ?>
                            <a class="btn btn-primary btn-sm" href="/item">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-7" method="post">
                                <h2>Item Info</h2>
                                <hr>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid" id="name" type="text" placeholder="Burgers" name="name" value="<?= isset($item['item_name']) ? $item['item_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control form-control-solid" id="description" rows="3" name="desc"><?= isset($item['item_desc']) ? $item['item_desc'] : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Price ($)</label>
                                    <input class="form-control form-control-solid col-6" id="price" type="number" step="any" placeholder="9.99" name="price" value="<?= isset($item['item_price']) ? $item['item_price'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control form-control-solid col-6" id="category" name="category">
                                        <?php foreach ($category as $c) : ?>
                                            <option value="<?= $c['category_id']; ?>" <?= isset($item['category_id']) && $item['category_id'] == $c['category_id'] ? 'selected' : ''; ?>><?= $c['category_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category">Status</label>
                                    <select class="form-control form-control-solid col-6" id="category" name="status">
                                        <option value="1" <?= isset($item['item_status']) && $item['item_status'] == "1" ? 'selected' : ''; ?>>Active</option>
                                        <option value="0" <?= isset($item['item_status']) && $item['item_status'] == "0" ? 'selected' : ''; ?>>Disable</option>
                                    </select>
                                </div>
                                <h2 class="mt-5">Modifiers</h2>
                                <hr>
                                <div class="form-group">
                                    <?php foreach ($modifiers as $modifier) : ?>
                                        <div class="custom-control custom-checkbox custom-control-solid">
                                            <input class="custom-control-input" type="checkbox" id="<?= $modifier['modifier_id']; ?>" name="modifier[]" value="<?= $modifier['modifier_id']; ?>" <?= isset($item['modifier_id']) && in_array($modifier['modifier_id'], explode(',', $item['modifier_id'])) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="<?= $modifier['modifier_id']; ?>"><?= $modifier['modifier_instruct'] ?></label>
                                            <small class="form-text text-muted"><?= $modifier['modifier_item'] ?></small>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <h2 class="mt-5">AddOns</h2>
                                <hr>
                                <div class="form-group">
                                    <?php foreach ($addons as $addon) : ?>
                                        <div class="custom-control custom-checkbox custom-control-solid">
                                            <input class="custom-control-input" type="checkbox" id="<?= $addon['addon_id']; ?>" name="addon[]" value="<?= $addon['addon_id']; ?>" <?= isset($item['addon_id']) && in_array($addon['addon_id'], explode(',', $item['addon_id'])) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="<?= $addon['addon_id']; ?>"><?= $addon['addon_instruct'] ?></label>
                                            <small class="form-text text-muted"><?= $addon['addon_item'] ?></small>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($item) ? 'Update item' : 'Create item' ?></button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>