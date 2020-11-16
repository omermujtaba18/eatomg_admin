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
                        <div class="card-header"> <?= isset($category) ? 'Update category' : 'Create a new category' ?>
                            <a class="btn btn-primary btn-sm" href="/category?rest_id=<?= $rest_id; ?>">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-6" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid" id="name" type="text" placeholder="Burgers" name="name" value="<?= isset($category['category_name']) ? $category['category_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control form-control-solid" id="description" rows="3" name="desc"><?= isset($category['category_desc']) ? $category['category_desc'] : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control form-control-solid" id="type" name="type">
                                        <option value="takeout" <?= isset($category['category_type']) ? 'selected' : ''; ?>>Takeout</option>
                                        <option value="catering" <?= isset($category['category_type']) ? 'selected' : ''; ?>>Catering</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($category) ? 'Update category' : 'Create category' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>