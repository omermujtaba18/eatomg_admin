<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid mt-5">
            <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                <div class="mr-4 mb-3 mb-sm-0">
                    <h1 class="mb-0">Order# <?= $id . '  (' . ($order['order_payment_type'] == 'CASH' ? 'DUE' : 'PAID') . ")"; ?> </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8" id="order">
                    <div class="card mb-4">
                        <div class="card-header text-dark">Order Information</div>

                        <div class="card-body">
                            <div class="row">
                                <?php
                                $placed_at = new DateTime($order['placed_at']);
                                $deliver_at = new DateTime($order['deliver_at']);
                                ?>
                                <div class="col-8">
                                    <span class="font-weight-bolder">Placed At: </span><?= $placed_at->format('h:i A'); ?></br>
                                    <span class="font-weight-bolder">Deliver At: </span><?= $deliver_at->format('h:i A'); ?></br>
                                </div>
                                <div class="col-4 text-right">
                                    <h2>
                                        <div class="badge badge-primary badge-pill" onclick="window.print();">Print</div>
                                        <?php if ($order['order_status'] == "Pending") : ?>
                                            <div class="badge badge-warning badge-pill"><?= esc($order['order_status']); ?></div>
                                        <?php endif; ?>
                                        <?php if ($order['order_status'] == "Confirmed") : ?>
                                            <div class="badge badge-success badge-pill"><?= esc($order['order_status']); ?></div>
                                        <?php endif; ?>
                                        <?php if ($order['order_status'] == "Ready") : ?>
                                            <div class="badge badge-primary badge-pill"><?= esc($order['order_status']); ?></div>
                                        <?php endif; ?>
                                        <?php if ($order['order_status'] == "Delivered") : ?>
                                            <div class="badge badge-success badge-pill"><?= esc($order['order_status']); ?></div>
                                        <?php endif; ?>
                                        <?php if ($order['order_status'] == "Cancelled") : ?>
                                            <div class="badge badge-danger badge-pill"><?= esc($order['order_status']); ?></div>
                                        <?php endif; ?>
                                    </h2>
                                </div>
                            </div>

                            <hr class="my-4">

                            <?php if (!empty($items)) : ?>
                                <?php foreach ($items as $item) : ?>
                                    <div class="mb-3">
                                        <div class="row font-weight-bolder">
                                            <div class="col-2 text-right"><?= $item['order_item_quantity']; ?> X</div>
                                            <div class="col-8"><?= $item['item_name']; ?></div>
                                            <div class="col-2"><?= '$' . $item['item_price']; ?></div>
                                        </div>

                                        <?php if (!empty($item['modifier'])) : ?>
                                            <?php foreach ($item['modifier'] as $modifier) : ?>
                                                <div class="row">
                                                    <div class="col-2"></div>
                                                    <div class="col-8"> <?= '- ' . $modifier['modifier_item']; ?></div>
                                                    <div class="col-2 float-right"><?= $modifier['modifier_price'] > 0 ? '+ $' . number_format($modifier['modifier_price'], "2", ".", "") : ''; ?></div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (!empty($item['addon'])) : ?>
                                            <?php foreach ($item['addon'] as $addon) : ?>
                                                <div class="row">
                                                    <div class="col-2"></div>
                                                    <div class="col-8"> <?= '+ ' . $addon['addon_item']; ?></div>
                                                    <div class="col-2 float-right"><?= '+ $' . number_format($addon['addon_price'], "2", ".", ""); ?></div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php if (!empty($item['order_item_note'])) : ?>
                                            <div class="row mt-4">
                                                <div class="col-2 text-right font-weight-bolder">Note</div>
                                                <div class="col-8"><?= $item['order_item_note']; ?></div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <hr class="my-4">

                                <?php endforeach; ?>
                            <?php endif ?>

                            <div class="row">
                                <div class="col-3 font-weight-bolder">Special Instructions</div>
                                <div class="col-8"><?= $order['order_instruct']; ?></div>
                            </div>
                            <hr class="my-4">
                            <div class="row pr-4">
                                <div class="col-5"></div>
                                <div class="col-5">Subtotal</div>
                                <div class="col-2 text-right">$<?= $order['order_subtotal']; ?></div>
                            </div>
                            <div class="row  pr-4">
                                <div class="col-5"></div>
                                <div class="col-5">Promotion</div>
                                <div class="col-2 text-right">- $<?= empty($order['order_discount']) ? '00.00' : $order['order_discount']; ?></div>
                            </div>
                            <div class="row  pr-4 mb-3">
                                <div class="col-5"></div>
                                <div class="col-5">Taxes</div>
                                <div class="col-2 text-right">$<?= $order['order_tax'] ?></div>
                            </div>
                            <!-- <div class="row mb-3">
                                <div class="col-5"></div>
                                <div class="col-5">Tip</div>
                                <div class="col-2 float-right">$0.00</div>
                            </div> -->
                            <div class="row  pr-4 font-weight-bolder">
                                <div class="col-5"></div>
                                <div class="col-5">Total</div>
                                <div class="col-2 text-right">$<?= $order['order_total'] ?></div>
                            </div>
                            <hr class="my-4">
                            <div class="row text-white">
                                <div class="col text-left">
                                    <?php if (ucfirst($order['order_status']) == "Pending") : ?>
                                        <a class="btn btn-secondary" href="../edit/<?= $order['order_id']; ?>?status=Confirmed&num=<?= $id; ?>&rest_id=<?= $rest_id; ?>">Confirm Order</a>
                                    <?php endif; ?>


                                    <?php if ($order['order_status'] == "Confirmed") : ?>
                                        <a class="btn btn-primary " href="../edit/<?= $order['order_id']; ?>?status=Ready&num=<?= $id; ?>&rest_id=<?= $rest_id; ?>">Order is Ready</a>
                                    <?php endif; ?>


                                    <?php if ($order['order_status'] == "Ready") : ?>
                                        <a class="btn btn-success " href="../edit/<?= $order['order_id']; ?>?status=Delivered&num=<?= $id; ?>&rest_id=<?= $rest_id; ?>">Delivered</a>
                                    <?php endif; ?>
                                </div>

                                <?php if ($order['order_status'] != "Cancelled") : ?>
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href="../cancel/<?= $order['order_id']; ?>?status=Cancelled&num=<?= $id; ?>&rest_id=<?= $rest_id; ?>">Cancel Order</a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header text-dark">Customer Information</div>
                        <div class="card-body">
                            <span class="font-weight-600">Name: </span><?= $order['cus_name']; ?></br>
                            <span class="font-weight-600">Phone: </span><?= $order['cus_phone']; ?></br>
                            <span class="font-weight-600">Address: </span><?= $order['cus_address']; ?></br>
                            <span class="font-weight-600">City: </span><?= $order['cus_city']; ?></br>
                            <span class="font-weight-600">Restaurant: </span><?= $order['rest_name']; ?></br>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>



<script>
    function printDiv() {
        var divContents = document.getElementById("order").innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write('<html><body>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
</script>