<?php
if (isset($_GET['id'])) {

    //header
    $title = "MY ORDER STATUS"; //page title
    require_once('./Header.php');

    $oid = $_GET["id"];


    $order_rs = Database::search("SELECT * FROM `order` INNER JOIN orderstatus ON order.orderStatus_id = orderstatus.id INNER JOIN user ON order.user_id = user.id WHERE `oid`= '" . $oid . "'  ");
    $order_num = $order_rs->num_rows;

    if ($order_num > 0) {
        $order_data = $order_rs->fetch_assoc();
?>
        <div class="col-12 col-lg-8 offset-lg-2 " style="margin-top: 80px !important;">
            <div class="row">

                <!-- header section -->
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 header-bg p-2 mb-3">
                        </div>
                        <div class="watermark">
                            <div class="fw-bold my-3 text-success fs-3">CASH ON DELIVERY ( <span class="text-danger text-uppercase">ORDER IS <?php echo $order_data["status"] ?></span> )</div>
                        </div>
                        <div class="col-4">
                            <img src="../src/img/logo.png" class="img-fluid">
                        </div>
                        <div class="col-8 text-end">
                            <span>e-Grocery ,</span><br>
                            <span>No: 404/B/1,</span><br>
                            <span>Kandy Road,</span><br>
                            <span>Malabr.</span><br>
                        </div>

                    </div>
                </div>
                <div class="col-12  invoice-label pb-1 mt-3 pt-1 border-top border-bottom">
                    INVOICE
                </div>
                <!-- header section -->
                <!-- detail section -->
                <div class="col-6 mt-3">
                    <span class=" fw-bold fs-5 ">Invoice To:</span><br>
                    <span><?php echo $order_data["name"] ?>,</span><br>
                    <span><?php echo $order_data["address"] ?></span><br>
                    <span><?php echo $order_data["contact"] ?></span><br>
                </div>

                <div class="col-6 mt-3 text-end">
                    <div class="row">
                        <div class="col-12">
                            <span class=" fw-bold fs-5 ">Invoice Details</span><br>
                        </div>
                        <div class="col-8 text-end fw-bold">
                            <span>Invoice Number:</span><br>
                            <span>Invoice Date:</span><br>
                        </div>

                        <div class="col-4 text-end fw-bold text-black-50">
                            <span id="oid"><?php echo $oid ?></span><br>
                            <span><?php echo $order_data["date"] ?></span><br>
                        </div>
                    </div>
                </div>
                <!-- detail section -->

                <!-- bill tabel section -->
                <div class="col-12 mt-4">
                    <table class="table">
                        <thead>
                            <tr class=" header-bg text-light">
                                <th class="col-8 text-center">product name</th>
                                <th class=" col-4 text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totle = 0;
                            $cat_product_rs = Database::search("SELECT * FROM `order` INNER JOIN user_has_product ON user_has_product.order_id = order.id INNER JOIN product ON product.id = user_has_product.product_id WHERE `oid` = '" . $oid . "'  ");

                            foreach ($cat_product_rs as $cat_product_data) {
                                $totle = $cat_product_data["price"] + $totle;
                            ?>
                                <tr>
                                    <td class=" col-8 p-3 "><?php echo $cat_product_data["name"]; ?></td>
                                    <td class="col-4 p-3 pe-0 fw-semibold border-start text-end "> Rs: <?php echo number_format($cat_product_data["price"]) ?>.00</td>
                                </tr>
                            <?php
                            }
                            ?>

                            <!-- total and discount -->
                            <tr class=" border-0">
                                <th class="text-end border-0 p-0 pt-1 fs-5"> Total:</th>
                                <th class="text-end border-0 p-0 pt-1 fs-5"> Rs: <?php echo number_format($totle) ?>.00</th>
                            </tr>
                            <!-- total and discount -->

                        </tbody>
                    </table>
                </div>
                <!-- bill tabel section -->

                <div class="col-12 mt-4 text-center text-black">
                    <p class="fw-bold">Thank you for shopping with us!</p>
                </div>
            </div>
        </div>
    <?php
    } else {
       ?>
       <script>
        alert("Please check order id again !");
        location.href = './home.php';
       </script>
       <?php
        exit();
    }
    ?>
<?php
    //footer
    require_once('./Footer.php');
} else {
    

    header('Location: ./home.php');
    exit();
}


?>