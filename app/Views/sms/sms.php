<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0"><?= esc(ucfirst($title)); ?></h1>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">Scheduled SMS
                            <a class="btn btn-primary btn-sm" href="/sms/create">Schedule a new SMS</a>
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 15em;">Schedule</th>
                                            <th>SMS</th>
                                            <th>Filters</th>
                                            <th>Status</th>
                                            <th style="width: 10em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($sms)) : ?>

                                            <?php foreach ($sms as $s) : ?>

                                                <tr>
                                                    <td><?= esc($s['schedule']); ?></td>
                                                    <td><?= esc($s['sms_body']); ?></td>
                                                    <td><?= esc($s['sms_filters']); ?></td>
                                                    <td>
                                                        <?= $s['status'] == 0 ? "<div class=\"badge badge-primary badge-pill\">Scheduled</div>" : "<div class=\"badge badge-success badge-pill\">Sent</div>" ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/sms/update/<?= esc($s['sms_id']); ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="/sms/delete/<?= esc($s['sms_id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i data-feather="trash-2"></i></a>
                                                    </td>
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