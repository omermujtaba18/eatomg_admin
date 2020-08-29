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
                        <div class="card-header"> <?= isset($modifier) ? 'Update order' : 'Create a new order' ?>
                            <a class="btn btn-primary btn-sm" href="/order">Back</a>
                        </div>

                        <div class="card-body">
                            <form class="col-12" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Customer Details</h5>
                                    </div>
                                    <!-- <div class="col-md-8 text-right">
                                        <a class="btn btn-dark btn-sm text-white" onclick="showNewCustomer();">Create a new Customer</a>
                                    </div> -->
                                </div>
                                <hr>
                                <div class="row mb-2">
                                    <div class="form-group col-md-4">
                                        <label for="name">Select cutomer</label>
                                        <select class="form-control form-control-solid" onchange="hideNewCustomer();" name="customer_id">
                                            <?php foreach ($customers as $customer) : ?>
                                                <option value="<?= $customer['cus_id']; ?>"><?= $customer['cus_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Select restaurant</label>
                                        <select class="form-control form-control-solid" name="rest_id">
                                            <option value="1">North Eve</option>
                                            <option value="2">Evanston</option>
                                            <option value="3">West Illinois</option>
                                            <option value="4">Van Buren</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- 
                                <div id="NewCustomer">
                                    <div class="row mb-2">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <input class="form-control form-control-solid" id="name" type="text" placeholder="John Doe" name="name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email</label>
                                            <input class="form-control form-control-solid" id="email" type="text" placeholder="john@example.com" name="email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="address">Address</label>
                                            <input class="form-control form-control-solid" id="address" type="text" placeholder="XYZ Street, FL." name="address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="city">City</label>
                                            <input class="form-control form-control-solid" id="city" type="text" placeholder="New York" name="city">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="state">State</label>
                                            <input class="form-control form-control-solid" id="state" type="text" placeholder="FL" name="state">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="zip">ZIP</label>
                                            <input class="form-control form-control-solid" id="zip" type="text" placeholder="123456" name="zip">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone</label>
                                            <input class="form-control form-control-solid" id="phone" type="text" placeholder="1231231234" name="phone">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="dob">Date of Birth</label>
                                            <input name="dob" class="form-control form-control-solid" id="dob" type="text" placeholder="01/01/2020" size=10 maxlength=10 onkeyup="this.value=this.value.replace(/^(\d\d)(\d)$/g,'$1/$2').replace(/^(\d\d\/\d\d)(\d+)$/g,'$1/$2').replace(/[^\d\/]/g,'')">
                                        </div>
                                    </div>
                                </div> -->

                                <div class="row">
                                    <div class="col-md-4">
                                        <h5>Order Details</h5>
                                    </div>
                                    <div class="col-md-8 text-right">
                                        <a class="btn btn-dark btn-sm text-white" onclick="addNewItem();">Add a new Item</a>
                                    </div>
                                </div>
                                <hr>

                                <div id="items" class="mb-2">
                                    <div id="item1">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <a class="text-danger" onclick="deleteItem(this);">(Delete this item?)</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="phone">Category</label>
                                                <select class="form-control form-control-solid" id="category1" onchange="getItems(this.id.substring(8));" name="category[]">
                                                    <option>Select..</option>
                                                    <?php foreach ($category as $c) : ?>
                                                        <option value="<?= $c['category_id']; ?>"><?= $c['category_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="phone">Item</label>
                                                <select class="form-control form-control-solid" id="ItemName1" onchange="getModifier(this.id.substring(8));" name="item[]">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Quantity</label>
                                                <input class="form-control form-control-solid" id="" type="number" placeholder="1" name="quantity[]" value="1">
                                            </div>

                                            <input type="hidden" id="price1" name="price[]">
                                        </div>
                                        <div class="row" id="modifiers1">

                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"><?= isset($modifier) ? 'Update modifier' : 'Create order' ?></button>
                                </div>
                            </form>
                            <div class="form-group col-md-3" id="Modifier0" style="display: none;">
                                <label for="phone">Item</label>
                                <select class="form-control form-control-solid" id="" name="modifier[]">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>

<script>
    $('#NewCustomer').hide();

    const hideNewCustomer = () => {
        $('#NewCustomer').hide();
    }

    const showNewCustomer = () => {
        $('#NewCustomer').show();
    }

    var cloneCount = 2;
    const addNewItem = () => {
        $('#items').append($('#item1').clone().attr('id', 'item' + cloneCount));
        $('#item' + cloneCount).find('#category1').attr('id', 'category' + cloneCount);
        $('#item' + cloneCount).find('#ItemName1').attr('id', 'ItemName' + cloneCount);
        $('#item' + cloneCount).find('#modifiers1').attr('id', 'modifiers' + cloneCount);
        $('#item' + cloneCount).find('input[type=hidden]').attr('id', 'price' + cloneCount++);
    }

    const deleteItem = (item) => {
        itemID = item.parentElement.parentElement.parentElement.id;
        if (itemID != 'item1')
            $('#' + itemID).remove();
    }

    const getItems = (val) => {
        id = $('#category' + val).val();
        if (id != "Select..") {
            $.ajax({
                url: "/item/getItemsByCategory/" + id,
                success: function(result) {
                    var items = JSON.parse(result);
                    $('#ItemName' + val).empty();
                    for (item of items) {
                        $('#ItemName' + val).append(`<option value='${item.item_id}'> ${item.item_name} </option>`);
                    }
                    getModifier(val);
                }
            });
        } else {
            $('#ItemName' + val).empty();
            $('#modifiers' + val).empty();
        }
    }

    const getModifier = (val) => {
        id = $('#ItemName' + val).val();
        $.ajax({
            url: "/item/getModifierByItemID/" + id,
            success: function(result) {
                var modifiers = JSON.parse(result);
                if (modifiers.length != 0) {
                    var count = 1;
                    for (m in modifiers) {
                        $("#modifiers" + val).append($('#Modifier0').clone().attr('id', "Modifier" + val + "-" + count));
                        $("#Modifier" + val + "-" + count).show();
                        $("#Modifier" + val + "-" + count).find("select").attr('id', "ModifierItem" + count);
                        var itemArray = modifiers[m]['modifier_item'].split(',');
                        var modifierName = modifiers[m]['modifier_instruct'];
                        for (i in itemArray) {
                            $("#Modifier" + val + "-" + count).find("label").text(modifierName);
                            $("#Modifier" + val + "-" + count).find("select").append(`<option value='${itemArray[i]}'> ${itemArray[i]} </option>`);
                            $("#Modifier" + val + "-" + count).find("select").attr('name', 'modifier' + val + '[]');
                        }
                        count++;
                    }

                } else {
                    console.log('no modifier');
                    $('#modifiers' + val).empty();
                }
            }
        });
        getItemByID(id, val);
    }


    const getItemByID = (id, val) => {
        $.ajax({
            url: "/item/getItemByID/" + id,
            success: function(result) {
                var item = JSON.parse(result);
                $('#price' + val).val(item.item_price);
            }
        });
    }
</script>