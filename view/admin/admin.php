<?php
session_start();
if (isset($_SESSION["admin"])) {

    require('./header.php');
?>



    <div class="col-12 mb-1" style="margin-top: 80px;">
        <div class="row">
            <div class="col-12 col-lg-4 p-4 bg-success ">
                <div class="row">
                    <div class="col-12 font-weight-bold h4 text-black"><i class="bi bi-gear-wide-connected"></i> &nbsp; Total Products</div>
                    <div class="col-12 mt-4 h5 text-black">
                        <?php
                        $product_rs = Database::search("SELECT * FROM `product` ");
                        echo ($product_rs->num_rows . " Products");
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 p-4 bg-danger ">
                <div class="row">
                    <div class="col-12 font-weight-bold h4 text-white"><i class="bi bi-bookmarks"></i> &nbsp; Total Pending Order</div>
                    <div class="col-12 mt-4 h5 text-white">
                        <?php
                        $order_rs = Database::search("SELECT * FROM `order` WHERE orderStatus_id = '1' ");
                        echo ($order_rs->num_rows . " order");
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 p-4 bg-primary ">
                <div class="row">
                    <div class="col-12 font-weight-bold h4 text-white"><i class="bi bi-browser-chrome"></i> &nbsp; Total Deliverd order</div>
                    <div class="col-12 mt-4 h5 text-white">
                        <?php
                        $order_rs = Database::search("SELECT * FROM `order` WHERE orderStatus_id = '2' ");
                        echo ($order_rs->num_rows . " order");
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 w-50 mx-auto mt-3 p-4 bg-white">
        <div class="row">
            <div class="col-12 font-weight-bold">Admin Features</div>
            <div class="col-12">
                <hr class="bg-secondary">
            </div>
            <a href="./addProduct.php" class="btn-dark my-1 btn py-2 col-12 text-white">Add Product</a>
            <a href="./viewOrder.php" class="btn-dark btn py-2 col-12 mt-2 text-white">View Orders</a>
            <button class="btn-dark btn py-2 mt-2 col-12 text-white" onclick="signOut();">Sign Out</button>
        </div>
    </div>

<?php

require './footer.php';

} else {
    header('Location: ../signIn.php');
    exit();
}

?>