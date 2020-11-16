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
                        <div class="card-header"> <?= isset($user) ? 'Update user account' : 'Create a new user account' ?>
                            <a class="btn btn-primary btn-sm" href="/user">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-6" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-solid" id="name" type="text" placeholder="John Doe" name="name" value="<?= isset($user['user_name']) ? $user['user_name'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input class="form-control form-control-solid" id="email" type="email" placeholder="name@example.com" name="email" value="<?= isset($user['user_email']) ? $user['user_email'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control form-control-solid" id="password" type="password" placeholder="********" name="password" value="<?= isset($user['user_password']) ? $user['user_password'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control form-control-solid" id="role" name="role">
                                        <option value="E" <?= isset($user['user_role']) && $user['user_role'] == "E" ? 'selected' : ''; ?>>Employee</option>
                                        <option value="BM" <?= isset($user['user_role']) && $user['user_role'] == "BM" ? 'selected' : ''; ?>>Branch Manager</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select class="form-control form-control-solid" id="branch" name="branch">
                                        <?php foreach ($restaurants as $r) : ?>
                                            <option value="<?= $r['rest_id'] ?>" <?= isset($user['user_rest']) && $user['user_rest'] == $r['rest_id'] ? 'selected' : ''; ?>><?= $r['rest_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($user) ? 'Update user account' : 'Create user account' ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>