<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0">Menu <?= esc(ucfirst($title)); ?></h1>
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
                                <h2>Item Details</h2>
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
                                <div class="form-group mb-0">
                                    <label>Image</label>
                                </div>
                                <div class="form-group">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label form-control-solid" for="image">Choose file...</label>
                                    </div>
                                </div>

                                <h2 class="mt-5">Modifiers</h2>
                                <hr>
                                <div class="form-group">
                                    <?php foreach ($modifiers as $modifier) : ?>
                                        <?php
                                        if (isset($itemModifier)) {
                                            $data = [
                                                'item_id' => $item['item_id'],
                                                'modifier_group_id' => $modifier['modifier_group_id']
                                            ];
                                            $item_modifier = $itemModifier->where($data)->first();
                                        }

                                        ?>
                                        <div class="custom-control custom-checkbox custom-control-solid">
                                            <input class="custom-control-input" type="checkbox" id="M<?= $modifier['modifier_group_id']; ?>" name="modifier[]" value="<?= $modifier['modifier_group_id']; ?>" <?php echo (!empty($item_modifier) ? 'checked' : '') ?>>
                                            <label class="custom-control-label" for="M<?= $modifier['modifier_group_id']; ?>"><?= $modifier['modifier_group_instruct'] ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <h2 class="mt-5">Addon</h2>
                                <hr>
                                <div class="form-group">
                                    <?php foreach ($addons as $addon) : ?>
                                        <?php
                                        if (isset($itemAddon)) {
                                            $data = [
                                                'item_id' => $item['item_id'],
                                                'addon_group_id' => $addon['addon_group_id']
                                            ];
                                            $item_addon = $itemAddon->where($data)->first();
                                        }

                                        ?>
                                        <div class="custom-control custom-checkbox custom-control-solid">
                                            <input class="custom-control-input" type="checkbox" id="A<?= $addon['addon_group_id']; ?>" name="addon[]" value="<?= $addon['addon_group_id']; ?>" <?php echo (!empty($item_addon) ? 'checked' : '') ?>>
                                            <label class="custom-control-label" for="A<?= $addon['addon_group_id']; ?>"><?= $addon['addon_group_instruct'] ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <hr class="mt-5">
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

<script>
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    });
</script>