<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Administrator Login</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/assets/img/OMG_Logo-Final_Icon-Black.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-11">
                            <div class="card my-5">
                                <div class="card-body text-center">
                                    <div class="h1 font-weight-heavy">Administrator Login</div>
                                </div>
                                <hr class="my-0" />
                                <div class="card-body p-5">
                                    <form method="post" action="">
                                        <?php
                                        if (isset($msg)) { ?>
                                            <div class="text-danger pb-2">
                                                <?= $msg; ?>
                                            </div>
                                        <?php }
                                        ?>

                                        <div class="form-group"><label class="text-gray-600 small" for="emailExample">Email address</label><input class="form-control form-control-solid" type="text" placeholder="" name="email" aria-label="Email Address" aria-describedby="emailExample" required /></div>
                                        <div class="form-group"><label class="text-gray-600 small" for="passwordExample">Password</label><input class="form-control form-control-solid py-4" type="password" name="password" placeholder="" aria-label="Password" aria-describedby="passwordExample" required /></div>
                                        <div class="form-group d-flex align-items-center justify-content-between mb-0">
                                            <!-- <div class="custom-control custom-control-solid custom-checkbox">
                                                <input class="custom-control-input small" id="customCheck1" type="checkbox" />
                                                <label class="custom-control-label" for="customCheck1">Remember password</label>
                                            </div> -->
                                            <button class="btn btn-primary btn-block mt-5" type="submit">Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
</body>

</html>