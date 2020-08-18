<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0">Order# <?= esc(ucfirst($id)); ?> </h1>
                    <div class="small"><span class="font-weight-500 text-primary"></div>
                    <div class="small"><span class="font-weight-500 text-primary"><?= $time->toLocalizedString('EEEE') ?></span> &middot; <?= $time->toLocalizedString('MMMM d, yyyy') ?> &middot; <?= $time->toLocalizedString('hh:mm aaa') ?></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">


                            <div class="row">
                                <div class="col-9">
                                    <span class="font-weight-bolder">Placed On: </span><?= $info[0]->order_placed_time; ?></br>
                                    <span class="font-weight-bolder">Deliver At: </span><?= $info[0]->order_delivery_time; ?></br>
                                </div>
                                <div class="col-3 text-right">
                                    <h2>
                                        <?php if ($info[0]->order_status == "Pending") : ?>
                                            <div class="badge badge-warning badge-pill"><?= esc($info[0]->order_status); ?></div>
                                        <?php endif; ?>
                                        <?php if ($info[0]->order_status == "Confirmed") : ?>
                                            <div class="badge badge-success badge-pill"><?= esc($info[0]->order_status); ?></div>
                                        <?php endif; ?>
                                        <?php if ($info[0]->order_status == "Ready") : ?>
                                            <div class="badge badge-primary badge-pill"><?= esc($info[0]->order_status); ?></div>
                                        <?php endif; ?>
                                        <?php if ($info[0]->order_status == "Delivered") : ?>
                                            <div class="badge badge-success badge-pill"><?= esc($info[0]->order_status); ?></div>
                                        <?php endif; ?>
                                        <?php if ($info[0]->order_status == "Cancelled") : ?>
                                            <div class="badge badge-danger badge-pill"><?= esc($info[0]->order_status); ?></div>
                                        <?php endif; ?>
                                    </h2>
                                </div>
                            </div>

                            <hr class="my-4">

                            <?php if (!empty($items)) : ?>
                                <?php foreach ($items as $item) : ?>
                                    <div class="mb-3">
                                        <div class="row font-weight-bolder">
                                            <div class="col-1 text-right"><?= $item->order_item_quantity; ?> X</div>
                                            <div class="col-9"><?= $item->item_name; ?></div>
                                            <div class="col-2"><?= '$' . $item->order_item_price; ?></div>

                                        </div>

                                        <?php if (!empty($item->modifier)) : ?>
                                            <?php $arr = explode(",", $item->modifier); ?>
                                            <?php foreach ($arr as $m) : ?>
                                                <div class="row">
                                                    <div class="col-2"></div>
                                                    <div class="col-8"> <?= '-' . $m; ?></div>
                                                    <div class="col-2 float-right"></div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (!empty($item->addon)) : ?>
                                            <?php $arr = explode(",", $item->addon); ?>
                                            <?php foreach ($arr as $a) : ?>
                                                <div class="row">
                                                    <div class="col-2"></div>
                                                    <div class="col-8"> <?= '+' . $a; ?></div>
                                                    <div class="col-2 float-right"></div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </div>
                                <?php endforeach; ?>
                            <?php endif ?>




                            <hr class="my-4">
                            <div class="row">
                                <div class="col-3 font-weight-bolder">Instructions</div>
                                <div class="col-9 text-justify"><?= $info[0]->order_instruct; ?></div>
                            </div>
                            <hr class="my-4">
                            <div class="row font-weight-bolder">
                                <div class="col-5"></div>
                                <div class="col-5">Subtotal</div>
                                <div class="col-2 text-right">$<?= $info[0]->order_subtotal; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-5">Promotion</div>
                                <div class="col-2 text-right">- $<?= empty($info[0]->order_discount) ? '00.00' : $info[0]->order_discount; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-5"></div>
                                <div class="col-5">Taxes</div>
                                <div class="col-2 text-right">$<?= $info[0]->order_tax; ?></div>
                            </div>
                            <!-- <div class="row mb-3">
                                <div class="col-5"></div>
                                <div class="col-5">Tip</div>
                                <div class="col-2 float-right">$0.00</div>
                            </div> -->
                            <div class="row font-weight-bolder">
                                <div class="col-5"></div>
                                <div class="col-5">Restaurant Total</div>
                                <div class="col-2 text-right">$<?= $info[0]->order_total; ?></div>
                            </div>
                            <hr class="my-4">
                            <div class="row text-white">
                                <div class="col text-left">
                                    <?php if (ucfirst($info[0]->order_status) == "Pending") : ?>
                                        <a class="btn btn-secondary" href="../edit/<?= $info[0]->order_id; ?>?status=Confirmed&num=<?= $id; ?>">Confirm Order</a>
                                    <?php endif; ?>


                                    <?php if ($info[0]->order_status == "Confirmed") : ?>
                                        <a class="btn btn-primary " href="../edit/<?= $info[0]->order_id; ?>?status=Ready&num=<?= $id; ?>">Order is Ready</a>
                                    <?php endif; ?>


                                    <?php if ($info[0]->order_status == "Ready") : ?>
                                        <a class="btn btn-success " href="../edit/<?= $info[0]->order_id; ?>?status=Delivered&num=<?= $id; ?>">Delivered</a>
                                    <?php endif; ?>
                                </div>
                                <div class="col text-right">
                                    <a class="btn btn-danger" href="../edit/<?= $info[0]->order_id; ?>?status=Cancelled&num=<?= $id; ?>">Cancel Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header text-dark">Customer Information</div>
                        <div class="card-body">
                            <span class="font-weight-600">Name: </span><?= $info[0]->cus_name; ?></br>
                            <span class="font-weight-600">Phone: </span><?= $info[0]->cus_phone; ?></br>
                            <span class="font-weight-600">Address: </span><?= $info[0]->cus_address; ?></br>
                            <span class="font-weight-600">City: </span><?= $info[0]->cus_city; ?></br>
                            <span class="font-weight-600">Restaurant: </span><?= $info[0]->rest_name; ?></br>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>