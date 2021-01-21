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
                        <div class="card-header">Email Templates
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 10em;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($emailTemplates)) : ?>
                                            <?php foreach ($emailTemplates as $emailTemplate) : ?>
                                                <tr>
                                                    <td><?= esc($emailTemplate['email_name']); ?></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-yellow text-white" href="/email/create/<?= esc($emailTemplate['email_id']); ?>">
                                                            Use this template</a>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">Scheduled Emails
                        </div>

                        <div class="card-body">
                            <div class="datatable table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 15em;">Schedule</th>
                                            <th>Subject</th>
                                            <th>Filters</th>
                                            <th>Status</th>
                                            <th style="width: 10em;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (!empty($emails)) : ?>

                                            <?php foreach ($emails as $email) : ?>

                                                <tr>
                                                    <td><?= esc($email['schedule']); ?></td>
                                                    <td><?= esc($email['email_subject']); ?></td>
                                                    <td><?= esc($email['email_filters']); ?></td>
                                                    <td>
                                                        <?= $email['status'] == 0 ? "<div class=\"badge badge-primary badge-pill\">Scheduled</div>" : "<div class=\"badge badge-success badge-pill\">Sent</div>" ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-icon btn-sm btn-yellow ml-2 text-white" href="/email/update/<?= esc($email['email_id']); ?>">
                                                            <i data-feather="edit"></i></a>
                                                        <a class="btn btn-icon btn-sm btn-red ml-2 text-white" href="/email/delete/<?= esc($email['email_id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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