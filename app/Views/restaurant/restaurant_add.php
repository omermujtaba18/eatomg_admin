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
                                    <label for="takeout_url">Website URL</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="takeout_url" value="<?= isset($restaurant['url']) ? $restaurant['url'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="url_facebook">Facebook URL</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="url_facebook" value="<?= isset($restaurant['url_facebook']) ? $restaurant['url_facebook'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="url_instagram">Instagram URL</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="url_instagram" value="<?= isset($restaurant['url_instagram']) ? $restaurant['url_instagram'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="url_twitter">Twitter URL</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="url_twitter" value="<?= isset($restaurant['url_twitter']) ? $restaurant['url_twitter'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control form-control-solid" id="type" name="type">
                                        <option value="takeout" <?= isset($restaurant['type']) && $restaurant['type'] == "takeout" ? 'selected' : ''; ?>>Takeout</option>
                                        <option value="catering" <?= isset($restaurant['type'])  && $restaurant['type'] == "catering"  ? 'selected' : ''; ?>>Catering</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Logo</label>
                                </div>
                                <div class="form-group">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="logo" name="logo">
                                        <label class="custom-file-label form-control-solid" for="logo">Choose file...</label>
                                    </div>
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