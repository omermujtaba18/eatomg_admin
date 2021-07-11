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
                        <div class="card-header"> <?= isset($promotion) ? 'Update promotion' : 'Create a new promotion' ?>
                            <a class="btn btn-primary btn-sm" href="/promotion?rest_id=<?= $rest_id; ?>">Back</a>
                        </div>

                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid col-6" type="text" placeholder="" name="name" value="<?= isset($promotion['promo_name']) ? $promotion['promo_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Code</label>
                                    <input class="form-control form-control-solid col-6" type="text" placeholder="" name="code" value="<?= isset($promotion['promo_code']) ? $promotion['promo_code'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control form-control-solid col-6" name="type">
                                        <option value="flat" <?= isset($promotion['promo_type']) && $promotion['promo_type'] == 'flat' ? 'selected' : ''; ?>>Flat discount</option>
                                        <option value="percent" <?= isset($promotion['promo_type']) && $promotion['promo_type'] == 'percent' ? 'selected' : ''; ?>>Percent discount</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Amount ($ or %)</label>
                                    <input class="form-control form-control-solid col-6" step="0.01" type="number" placeholder="" name="amount" value="<?= isset($promotion['promo_amount']) ?  ($promotion['promo_type'] == 'percent' ?  $promotion['promo_amount'] * 100 : $promotion['promo_amount']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Active</label>
                                    <select class="form-control form-control-solid col-6" name="active">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <hr class="mt-5">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($promotion) ? 'Update promotion' : 'Create promotion' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>