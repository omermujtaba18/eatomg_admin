<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucwords($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"></div>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"> Update Business Information</div>

                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Business Name</label>
                                        <input class="form-control form-control-solid" type="text" name="business_name" value="<?= isset($business['business_name']) ? $business['business_name'] : ''; ?>" required>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="form-group col-md-5">
                                        <label for="name">Business Contact</label>
                                        <input class="form-control form-control-solid" type="text" name="business_contact" value="<?= isset($business['business_contact']) ? $business['business_contact'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-12">
                                        <label for="name">Business Address</label>
                                        <input class="form-control form-control-solid" type="text" name="business_address" value="<?= isset($business['business_address']) ? $business['business_address'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Website URL</label>
                                        <input class="form-control form-control-solid" type="text" name="business_webiste" value="<?= isset($business['business_webiste']) ? $business['business_webiste'] : ''; ?>">
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="form-group col-md-5">
                                        <label for="name">Facebook URL</label>
                                        <input class="form-control form-control-solid" type="text" name="business_url_facebook" value="<?= isset($business['business_url_facebook']) ? $business['business_url_facebook'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Twitter URL</label>
                                        <input class="form-control form-control-solid" type="text" name="business_url_twitter" value="<?= isset($business['business_url_twitter']) ? $business['business_url_twitter'] : ''; ?>">
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="form-group col-md-5">
                                        <label for="name">Instagram URL</label>
                                        <input class="form-control form-control-solid" type="text" name="business_url_instagram" value="<?= isset($business['business_url_instagram']) ? $business['business_url_instagram'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Logo</label>
                                </div>
                                <?php if (isset($business['business_logo']) && !empty($business['business_logo'])) : ?>
                                    <div class="form-group mb-3">
                                        <img src="<?= $business['business_logo'] ?>" class="img-thumbnail" width="200" />
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="logo" name="logo">
                                        <label class="custom-file-label form-control-solid col-md-4" for="logo">Choose file...</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Save</button>
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