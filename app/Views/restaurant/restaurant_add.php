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
                        <div class="card-header"> <?= isset($restaurant) ? 'Update restaurant account' : 'Create a new restaurant account' ?>
                            <a class="btn btn-primary btn-sm" href="/restaurant">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-6" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="name" value="<?= isset($restaurant['rest_name']) ? $restaurant['rest_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="description" value="<?= isset($restaurant['rest_description']) ? $restaurant['rest_description'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="address" value="<?= isset($restaurant['rest_address']) ? $restaurant['rest_address'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="phone" value="<?= isset($restaurant['rest_phone']) ? $restaurant['rest_phone'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="takeout_url">Store URL</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="url" value="<?= isset($restaurant['url']) ? $restaurant['url'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="takeout_url">Priority</label>
                                    <input class="form-control form-control-solid" type="number" placeholder="" name="priority" value="<?= isset($restaurant['priority']) ? $restaurant['priority'] : 1; ?>">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($restaurant) ? 'Update restaurant account' : 'Create restaurant account' ?></button>
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