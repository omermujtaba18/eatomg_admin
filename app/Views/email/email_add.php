<script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
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
                        <div class="card-header"> <?= isset($email) ? 'Update email' : 'Create a new email' ?>
                            <a class="btn btn-primary btn-sm" href="/addon">Back</a>
                        </div>

                        <div class="card-body">
                            <form method="post" class="col" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="name">Name</label>
                                            <input class="form-control form-control-solid" id="name" type="text" placeholder="" name="name" value="<?= isset($email['email_name']) ? $email['email_name'] : ''; ?>" required>
                                        </div>
                                        <div class="col-1"></div>
                                        <div class="col-5">
                                            <label for="subject">Subject</label>
                                            <input class="form-control form-control-solid" id="subject" type="text" placeholder="" name="subject" value="<?= isset($email['email_subject']) ? $email['email_subject'] : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editor">Body</label>
                                    <textarea name="body" id="editor" rows="10" cols="80">
                                        <?= isset($email['email_body']) ? $email['email_body'] : ''; ?>
                                 </textarea>
                                </div>
                                <hr class="mb-5">

                                <h2 class="border-bottom mb-5">Filters</h2>

                                <div class="form-group">
                                    <label for="datetime">Schedule (Date and Time)</label>
                                    <input class="form-control form-control-solid col-4" type="text" placeholder="" name="datetime" value="<?= isset($email['email_subject']) ? $email['email_subject'] : ''; ?>" required>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($email) ? 'Update email' : 'Create email' ?></button>
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
    CKEDITOR.replace('editor');
    CKEDITOR.config.height = 500;
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.allowedExtraContent = true;
    CKEDITOR.config.fullPage = true;
    CKEDITOR.config.startupMode = 'source';
</script>