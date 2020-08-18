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
                        <div class="card-header"> <?= isset($modifier) ? 'Update modifier' : 'Create a new modifier' ?>
                            <a class="btn btn-primary btn-sm" href="/modifier">Back</a>
                        </div>

                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid col-6" type="text" placeholder="e.g step-1-plate" name="name" value="<?= isset($modifier['modifier_group_name']) ? $modifier['modifier_group_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Instruction</label>
                                    <input class="form-control form-control-solid col-6" type="text" placeholder="e.g Pick a protein" name="instruction" value="<?= isset($modifier['modifier_group_instruct']) ? $modifier['modifier_group_instruct'] : ''; ?>" required>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-3 ">Item</div>
                                    <div class="col-3">Price</div>
                                </div>

                                <?php if (isset($modifier)) {
                                    foreach ($modifierItems as $item) : ?>
                                        <div>
                                            <div class="row" id="item">
                                                <div class="form-group col-3">
                                                    <input class="form-control form-control-solid" type="text" placeholder="" name="item[]" value="<?= isset($item['modifier_item']) ? $item['modifier_item'] : ''; ?>" required>
                                                </div>
                                                <div class="form-group col-3">
                                                    <input class="form-control form-control-solid" type="number" placeholder="" name="price[]" value="<?= isset($item['modifier_price']) ? $item['modifier_price'] : ''; ?>" required>
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
                                            <div class="form-group col-3">
                                                <input class="form-control form-control-solid" type="text" placeholder="" name="item[]" required>
                                            </div>
                                            <div class="form-group col-3">
                                                <input class="form-control form-control-solid" type="number" placeholder="" name="price[]" required>
                                            </div>
                                            <div class="form-group col-3">
                                                <a class="btn btn-danger text-white btn-sm mt-1" onclick="deleteItem(this)">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <a class="btn btn-primary text-white btn-sm" onclick="addItem(this)" id="test">+ Add more</a>

                                <hr class="mt-5">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($modifier) ? 'Update modifier' : 'Create modifier' ?></button>
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