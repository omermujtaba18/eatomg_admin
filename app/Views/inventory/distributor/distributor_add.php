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
                        <div class="card-header"> <?= isset($inventory_distributor) ? 'Update inventory distributor' : 'Create a new inventory distributor' ?>
                            <a class="btn btn-primary btn-sm" href="/inventory/distributor">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-6" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid" id="name" type="text" placeholder="Coke Freestyle" name="name" value="<?= isset($inventory_distributor['inventory_distributor_name']) ? $inventory_distributor['inventory_distributor_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Abbreviation</label>
                                    <input class="form-control form-control-solid" id="abbr" type="text" placeholder="CFS" name="abbr" value="<?= isset($inventory_distributor['inventory_distributor_abbr']) ? $inventory_distributor['inventory_distributor_abbr'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Contact Person</label>
                                    <input class="form-control form-control-solid" id="contact" type="text" placeholder="John Doe" name="contact" value="<?= isset($inventory_distributor['inventory_distributor_contact']) ? $inventory_distributor['inventory_distributor_contact'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input class="form-control form-control-solid" id="email" type="text" placeholder="john@example.com" name="email" value="<?= isset($inventory_distributor['inventory_distributor_email']) ? $inventory_distributor['inventory_distributor_email'] : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="name">Phone</label>
                                    <input class="form-control form-control-solid" id="phone" type="text" placeholder="123 123 1234" name="phone" value="<?= isset($inventory_distributor['inventory_distributor_phone']) ? $inventory_distributor['inventory_distributor_phone'] : ''; ?>">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($inventory_distributor) ? 'Update distributor' : 'Create distributor' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>