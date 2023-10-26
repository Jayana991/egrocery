<?php
session_start();
if (isset($_SESSION["user"])) {

    $cartArray = $_SESSION["cart"];
    $title = "CART"; //page title
    require_once('./Header.php');

?>
    <h2 class="text-center mb-4" style="margin-top: 100px;">Shopping Cart</h2>
    <div class="row">
        <div class="col-md-8">

            <?php
            $totle = 0;

            foreach ($cartArray as $arr) {

                $cat_product_rs = Database::search("SELECT * FROM product WHERE id = '" . $arr . "'");
                $cat_product_data = $cat_product_rs->fetch_assoc();

                $totle = $cat_product_data["price"] + $totle;
            ?>
                <!-- Cart Items -->
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="../document/<?php echo $cat_product_data["img_path"] ?>" alt="Product 1" class="img-fluid">
                            </div>
                            <div class="col-md-7">
                                <h5 class="card-title"><a href="./singleProduct.php?pr_id=<?php echo $cat_product_data["id"] ?>" class="text-dark"><?php echo $cat_product_data["name"] ?></a></h5>
                                <p class="card-text"><?php echo $cat_product_data["smapleDis"] ?></p>
                            </div>
                            <div class="col-md-3">
                                <p class="card-text">Rs: <?php echo number_format($cat_product_data["price"]) ?>.00</p>
                                <button class="btn btn-primary" id="cart-<?php echo $cat_product_data['id'] ?>" onclick="addCardItem('<?php echo $cat_product_data['id'] ?>' , this)"><i class="bi bi-cart-check-fill"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>



        </div>

        <div class="col-md-4">
            <!-- Cart Summary -->
            <div class="card mb-3">
                <div class="card-body text-center mx-auto">
                    <h5 class="card-title">Cart Summary</h5>
                    <hr>
                    <h2 class="card-text">Total: <?php echo number_format($totle); ?></h2>
                    <br>
                    <h5 class="text-danger t">Payment type (cash on delivery)</h5>
                    <?php
                    if (!empty($_SESSION["cart"])) {
                    ?>
                        <button class=" btn btn-primary btn-block mt-3" onclick="placeOrder('<?php echo $totle ?>')">Place Order</button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php

} else {
    header('Location: ./signin.php');
    exit();
}

//footer
require_once('./Footer.php');
?>