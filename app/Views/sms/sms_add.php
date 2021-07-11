<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
                        <div class="card-header"> <?= isset($sms) ? 'Update SMS' : 'Schedule a new SMS' ?>
                            <a class="btn btn-primary btn-sm" href="/sms">Back</a>
                        </div>

                        <div class="card-body">
                            <form method="post" class="col" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="datetime">Schedule (Date and Time)</label>
                                    <input class="form-control form-control-solid col-4" type="text" placeholder="" name="datetime" value="<?= isset($sms['schedule']) ? $sms['schedule'] : ''; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea id="body" class="form-control form-control-solid col-5" name="body">
                                        <?= ltrim(isset($sms['sms_body']) ? $sms['sms_body'] : ''); ?>
                                    </textarea>
                                </div>
                                <hr class="mb-3">

                                <h2 class="border-bottom mt-4 mb-4">Filters</h2>
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="datetime">Restaurant</label>
                                            <?php foreach ($restaurants as $r) : ?>
                                                <div class="custom-control custom-checkbox custom-control-solid">
                                                    <input class="custom-control-input" id="restaurant[1]" name="restaurant[]" type="checkbox" value="OMG - North Avenue">
                                                    <label class="custom-control-label" for="restaurant[1]">
                                                        <?= $r['rest_name']; ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($sms) ? 'Update SMS' : 'Schedule SMS' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>


<script>
    $(function() {
        $('input[name="datetime"]').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'YYYY-MM-DD hh:mm:ss'
            },
            "opens": "right",
            "drops": "auto"

        });
    });
</script>