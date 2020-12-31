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
                        <div class="card-header"> <?= isset($facebook) ? 'Update facebook post' : 'Create a new facebook post' ?>
                            <a class="btn btn-primary btn-sm" href="/facebook">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-6" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <textarea class="form-control form-control-solid" id="description" name="description" rows="3" required><?= isset($facebook['fb_post_description']) ? $facebook['fb_post_description'] : ''; ?></textarea>
                                </div>
            
                                <div class="form-group mb-0">
                                    <label>Image</label>
                                </div>
                                <div class="form-group">
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label form-control-solid" for="image">Choose file...</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($facebook) ? 'Update facebook post' : 'Create facebook post' ?></button>
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