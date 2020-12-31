<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary text-right"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header"><?= esc(ucfirst($title)); ?>
                            <!-- <a class="btn btn-primary btn-sm" href="/customer/create">Add a new customer</a> -->
                        </div>
                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Has registered</th>
                                            <th>DOB</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <!-- <th style="min-width: 5em;">Actions</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($customers)) : ?>

                                            <?php foreach ($customers as $customer) : ?>

                                                <tr>
                                                    <td><?= esc($customer['cus_name']); ?></td>
                                                    <td><?= esc($customer['cus_email']); ?></td>
                                                    <td><?= !empty($customer['cus_phone']) ? $customer['cus_phone'] : '-'; ?></td>
                                                    <td><?= $customer['has_register'] == 1 ? 'Yes' : 'No'; ?></td>
                                                    <td><?= !empty($customer['cus_dob']) ? $customer['cus_dob'] : '-'; ?></td>
                                                    <td><?= !empty($customer['cus_address']) ? $customer['cus_address'] : '-'; ?></td>
                                                    <td><?= !empty($customer['cus_city']) ? $customer['cus_city'] : '-'; ?></td>
                                                    <td><?= !empty($customer['cus_state']) ? $customer['cus_state'] : '-'; ?></td>
                                                    <!-- <td>
                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="customer/edit/<?php //esc($customer['cus_id']); 
                                                                                                                                        ?>">
                                                            <i data-feather="edit"></i></a>
                                                    </td> -->
                                                </tr>

                                            <?php endforeach; ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>