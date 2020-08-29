<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0">Menu <?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"></div>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"> <?= isset($customer) ? 'Update customer' : 'Create a new customer' ?>
                            <a class="btn btn-primary btn-sm" href="/customer">Back</a>
                        </div>

                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input class="form-control form-control-solid" id="name" type="text" placeholder="John Doe" name="name" value="<?= isset($customer['cus_name']) ? $customer['cus_name'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input class="form-control form-control-solid" id="email" type="text" placeholder="john@example.com" name="email" value="<?= isset($customer['cus_email']) ? $customer['cus_email'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="address">Address</label>
                                        <input class="form-control form-control-solid" id="address" type="text" placeholder="XYZ Street, FL." name="address" value="<?= isset($customer['cus_address']) ? $customer['cus_address'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="city">City</label>
                                        <input class="form-control form-control-solid" id="city" type="text" placeholder="New York" name="city" value="<?= isset($customer['cus_city']) ? $customer['cus_city'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">State</label>
                                        <input class="form-control form-control-solid" id="state" type="text" placeholder="FL" name="state" value="<?= isset($customer['cus_state']) ? $customer['cus_state'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="zip">ZIP</label>
                                        <input class="form-control form-control-solid" id="zip" type="text" placeholder="123456" name="zip" value="<?= isset($customer['cus_zip']) ? $customer['cus_zip'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone</label>
                                        <input class="form-control form-control-solid" id="phone" type="text" placeholder="1231231234" name="phone" value="<?= isset($customer['cus_phone']) ? $customer['cus_phone'] : ''; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="dob">Date of Birth</label>
                                        <input name="dob" class="form-control form-control-solid" id="dob" type="text" placeholder="01-01-2020" size=10 maxlength=10 onkeyup="this.value=this.value.replace(/^(\d\d)(\d)$/g,'$1/$2').replace(/^(\d\d\/\d\d)(\d+)$/g,'$1/$2').replace(/[^\d\/]/g,'')" value="<?= isset($customer['cus_dob']) && !empty($customer['cus_dob']) ? substr($customer['cus_dob'], -2) . "/" . substr($customer['cus_dob'], -5, 2) . "/" . substr($customer['cus_dob'], 0, 4) : ''; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($customer) ? 'Update customer' : 'Create item' ?></button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>

<script>
    // val = $('#dob').val();
    // newVal = val.substr(val, 0, 2) +
    //     "/" + val.substr(val, 2, 2)
    // "/" + val.substr(val, 4, 4);
    // $('#')
</script>