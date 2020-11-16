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
                            <form class="col-6" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="name" value="<?= isset($restaurant['rest_name']) ? $restaurant['rest_name'] : ''; ?>" required>
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
                                    <label for="takeout_url">URL</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="takeout_url" value="<?= isset($restaurant['url']) ? $restaurant['url'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control form-control-solid" id="type" name="type">
                                        <option value="takeout" <?= isset($restaurant['type']) && $restaurant['type'] == "takeout" ? 'selected' : ''; ?>>Takeout</option>
                                        <option value="catering" <?= isset($restaurant['type'])  && $restaurant['type'] == "catering"  ? 'selected' : ''; ?>>Catering</option>
                                    </select> </div>
                                <div class="form-group">
                                    <label for="api_id">API ID</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="api_id" value="<?= isset($restaurant['rest_api_id']) ? $restaurant['rest_api_id'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="api_key">API Key</label>
                                    <input class="form-control form-control-solid" type="text" placeholder="" name="api_key" value="<?= isset($restaurant['rest_api_key']) ? $restaurant['rest_api_key'] : ''; ?>">
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