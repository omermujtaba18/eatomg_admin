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
                            <form class="col-12" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="name">Name</label>
                                        <input class="form-control form-control-solid" type="text" placeholder="" name="name" value="<?= isset($restaurant['rest_name']) ? $restaurant['rest_name'] : ''; ?>" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="description">Description</label>
                                        <input class="form-control form-control-solid" type="text" placeholder="" name="description" value="<?= isset($restaurant['rest_description']) ? $restaurant['rest_description'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="address">Address</label>
                                        <input class="form-control form-control-solid" type="text" placeholder="" name="address" value="<?= isset($restaurant['rest_address']) ? $restaurant['rest_address'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="phone">Phone</label>
                                        <input class="form-control form-control-solid" type="text" placeholder="" name="phone" value="<?= isset($restaurant['rest_phone']) ? $restaurant['rest_phone'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="takeout_url">Store URL</label>
                                        <input class="form-control form-control-solid" type="text" placeholder="" name="url" value="<?= isset($restaurant['url']) ? $restaurant['url'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="takeout_url">Priority</label>
                                        <input class="form-control form-control-solid" type="number" placeholder="" name="priority" value="<?= isset($restaurant['priority']) ? $restaurant['priority'] : 1; ?>">
                                    </div>
                                </div>
                                <hr>
                                <h5>Hours of Operation</h5>
                                <hr>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Day</th>
                                            <th scope="col">Start Time</th>
                                            <th scope="col">End Time</th>
                                            <th scope="col">Closed</th>
                                            <th scope="col">24hour open</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($times as $time) : ?>
                                            <tr>
                                                <th><?= $time['day']; ?></th>
                                                <td>
                                                    <input type="hidden" name="ids[]" value="<?= $time['restaurant_time_id']; ?>">
                                                    <input class="form-control form-control-solid" type="time" name="start[<?= $time['restaurant_time_id']; ?>]" value="<?= isset($time['start_time']) ? $time['start_time'] : '00:00:00'; ?>">
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-solid" type="time" name="end[<?= $time['restaurant_time_id']; ?>]" value="<?= isset($time['end_time']) ? $time['end_time'] : '00:00:00'; ?>">
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" name="closed[<?= $time['restaurant_time_id']; ?>]" <?= isset($time['is_closed']) && $time['is_closed'] ? 'checked' : ''; ?>>
                                                        <label class="form-check-label">Closed</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" name="24h[<?= $time['restaurant_time_id']; ?>]" <?= isset($time['is_24h_open']) && $time['is_24h_open'] ? 'checked' : ''; ?>>
                                                        <label class="form-check-label">Open 24hours</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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