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
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid col-6" type="text" placeholder="e.g step-1-plate" name="name" value="<?= isset($modifier['modifier_group_name']) ? $modifier['modifier_group_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Instruction</label>
                                    <input class="form-control form-control-solid col-6" type="text" placeholder="e.g Pick a protein" name="instruction" value="<?= isset($modifier['modifier_group_instruct']) ? $modifier['modifier_group_instruct'] : ''; ?>" required>
                                </div>
                                <div class="row mb-2 mt-5">
                                    <div class="col-1"></div>
                                    <div class="col-3">Item</div>
                                    <div class="col-2">Price</div>
                                    <div class="col-4">Choose new image</div>
                                </div>

                                <?php if (isset($modifier)) {
                                    foreach ($modifierItems as $key => $value) : ?>
                                        <div>
                                            <div class="row my-5" id="item">
                                                <div class="col-1">
                                                    <img src="<?= $value['modifier_pic']; ?>" width=60 />
                                                    <input type="hidden" name="id[]" value="<?= $value['modifier_id']; ?>">
                                                </div>
                                                <div class="form-group col-3">
                                                    <input class="form-control form-control-solid" type="text" placeholder="" name="item[]" value="<?= isset($value['modifier_item']) ? $value['modifier_item'] : ''; ?>" required>
                                                </div>
                                                <div class="form-group col-2">
                                                    <input class="form-control form-control-solid" type="number" step="0.01" placeholder="" name="price[]" value="<?= isset($value['modifier_price']) ? $value['modifier_price'] : ''; ?>" required>
                                                </div>
                                                <div class="form-group col-4">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image[]">
                                                        <label class="custom-file-label form-control-solid">Choose file...</label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-2">
                                                    <a class="btn btn-danger text-white btn-sm mt-1" onclick="deleteItem(this)">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                <?php } else { ?>
                                    <div>
                                        <div class="row" id="item">
                                            <div class="form-group col-4">
                                                <input class="form-control form-control-solid" type="text" placeholder="" name="item[]" required>
                                            </div>
                                            <div class="form-group col-2">
                                                <input class="form-control form-control-solid" type="number" step="0.01" placeholder="" name="price[]" required>
                                            </div>
                                            <div class="form-group col-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image[]">
                                                    <label class="custom-file-label form-control-solid" for="image">Choose file...</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <a class="btn btn-danger text-white btn-sm mt-1" onclick="deleteItem(this)">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <a class="btn btn-primary text-white btn-sm mt-5" onclick="addItem(this)" id="test">+ Add more</a>

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
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        e.target.parentElement.children[1].innerHTML = fileName;
    });
</script>