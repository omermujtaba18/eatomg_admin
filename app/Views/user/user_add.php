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
                                        <option value="Employee" <?= isset($user['user_role']) && $user['user_role'] == "Employee" ? 'selected' : ''; ?>>Employee</option>
                                        <option value="Branch Manager" <?= isset($user['user_role']) && $user['user_role'] == "Branch Manager" ? 'selected' : ''; ?>>Branch Manager</option>
                                        <option value="Administrator" <?= isset($user['user_role']) && $user['user_role'] == "Administrator" ? 'selected' : ''; ?>>Administrator</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <select class="form-control form-control-solid" id="branch" name="branch">
                                        <option value="1" <?= isset($user['user_rest']) && $user['user_rest'] == "1" ? 'selected' : ''; ?>>North Eve</option>
                                        <option value="2" <?= isset($user['user_rest']) && $user['user_rest'] == "2" ? 'selected' : ''; ?>>Evanston</option>
                                        <option value="3" <?= isset($user['user_rest']) && $user['user_rest'] == "3" ? 'selected' : ''; ?>>West Illinois St</option>
                                        <option value="4" <?= isset($user['user_rest']) && $user['user_rest'] == "4" ? 'selected' : ''; ?>>Van Buren</option>
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