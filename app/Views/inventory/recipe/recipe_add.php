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
                        <div class="card-header"> <?= isset($recipe) ? 'Update recipe' : 'Create a new recipe' ?>
                            <a class="btn btn-primary btn-sm" href="/inventory/recipe">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="" method="post">
                                <div class="form-group">
                                    <label for="name">Menu Item</label>
                                    <select class="form-control form-control-solid col-6" name="item_id">
                                        <?php foreach ($items as $item) : ?>
                                            <option value="<?= $item['item_id']; ?>" <?= $item['item_id'] == $recipe['item_id'] ? 'selected' : '' ?>><?= $item['item_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4">Item</div>
                                    <div class="col-2">Quantity</div>
                                </div>

                                <?php if (isset($recipe)) {
                                    foreach ($recipe_items as $item) : ?>
                                        <div>
                                            <div class="row" id="item">
                                                <div class="form-group col-4">
                                                    <select class="form-control form-control-solid" name="inventory_id[]">
                                                        <?php foreach ($inventory as $i) : ?>
                                                            <option value="<?= $i['inventory_id']; ?>" <?= isset($recipe) && $i['inventory_id'] == $item['inventory_id'] ? 'selected' : '' ?>><?= $i['inventory_desc']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select> </div>
                                                <div class="form-group col-2">
                                                    <input class="form-control form-control-solid" value="<?= isset($recipe) ? $item['recipe_item_quantity']  : '' ?>" type="number" placeholder="" name="quantity[]" required>
                                                </div>
                                                <div class="form-group col-3">
                                                    <a class="btn btn-danger text-white btn-sm mt-1" onclick="deleteItem(this)">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php } else { ?>
                                    <div>
                                        <div class="row" id="item">
                                            <div class="form-group col-4">
                                                <select class="form-control form-control-solid" name="inventory_id[]">
                                                    <?php foreach ($inventory as $i) : ?>
                                                        <option value="<?= $i['inventory_id']; ?>"><?= $i['inventory_desc']; ?></option>
                                                    <?php endforeach; ?>
                                                </select> </div>
                                            <div class="form-group col-2">
                                                <input class="form-control form-control-solid" type="number" placeholder="" name="quantity[]" required>
                                            </div>
                                            <div class="form-group col-3">
                                                <a class="btn btn-danger text-white btn-sm mt-1" onclick="deleteItem(this)">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <a class="btn btn-primary text-white btn-sm" onclick="addItem(this)" id="test">+ Add more</a>

                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($recipe) ? 'Update recipe' : 'Create recipe' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>

<script>
    function deleteItem(element) {
        parent = element.parentElement.parentElement.parentElement;
        parent.removeChild(element.parentElement.parentElement)
    }

    function addItem(element) {
        new_item = document.querySelector("#item").cloneNode(true)
        item_group = element.previousElementSibling.appendChild(new_item)
    }
</script>