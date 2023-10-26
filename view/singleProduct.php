<?php

if (isset($_GET['pr_id'])) {
    $prid = $_GET['pr_id'];

    //header
    $title = "SINGLE PRODUCT VIEW"; //page title
    require_once('./Header.php');

    //get product data
    $pr_rs = Database::search("SELECT product.id AS pid, product.* , unit.* FROM product INNER JOIN unit ON product.unit_id = unit.id WHERE product.id = '" . $prid . "' ");
    $pr_data = $pr_rs->fetch_assoc();

?>

    <!-- Product Details -->
    <div class="row " style="margin-top: 100px;">
        <div class="col-12 col-md-6">
            <img src="../document/<?php echo $pr_data['img_path'] ?>" alt="Product Name" class="img-fluid">
        </div>
        <div class="col-12 col-md-6">
            <h2 class="fw-bold fs-3"><?php echo $pr_data['name'] ?></h2>
            <p class="fs-4"><?php echo $pr_data['smapleDis'] ?></p>
            <p class="fw-bold fs-4">Unit Price: RS:<?php echo number_format($pr_data['price']) ?>.00 (<?php echo $pr_data['priceQty'] ?> <?php echo $pr_data['unit_name'] ?>)</p>
            <div class="input-group my-3 w-50">
                <!-- <label class="input-group-text" for="quantity">Quantity:</label>
                <input type="number" id="quantity" class="form-control" value="1" min="1" class="w-50">
                <button class="btn btn-outline-secondary" onclick="decreaseQuantity('<?php //echo $pr_data['price'] ?>')">-</button>
                <button class="btn btn-outline-secondary" onclick="increaseQuantity('<?php //echo $pr_data['price'] ?>')">+</button> -->
            </div>
            <div>
            <p id="totalPriceSinglePageVisibility" class="d-none fw-bold fs-4">Total Price: RS: <span id="totalPriceSinglePage"></span>.00 </p>
            </div>
            <div>
                <button class="btn btn-primary" id="cart-<?php echo $pr_data['pid'] ?>" onclick="addCardItem('<?php echo $pr_data['pid'] ?>')">Add to Cart <i class="bi bi-cart-check-fill"></i></button>
                <button class="btn btn-primary" onclick=" location.href = './cart.php' ">Cart <i class="bi bi-cart-check-fill"></i></button>
            </div>
        </div>
    </div>

    <!-- Product Details Description -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="fw-bold fs-4">Product Details</h3>
            <p class="fs-5"><?php echo $pr_data['discription'] ?></p>
        </div>
    </div>

    <br>
    <hr class="fw-bold mt-5"><br>

    <h3 class="text-start fw-bold fs-3 mb-4">Related Items</h3>

    <div class="row" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
        <?php
        $product_rs = Database::search("SELECT product.* , unit.* , product.id AS pid  FROM product INNER JOIN unit ON product.unit_id = unit.id  WHERE category_id = '" . $pr_data["category_id"] . "' LIMIT 4 ");
        foreach ($product_rs as $product_data) {
        ?>
            <div class="col-12 col-md-3">
                <div class="card mb-4">
                    <img src="../document/<?php echo $product_data["img_path"] ?>" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product_data["name"] ?></h5>
                        <h5 class="card-title">Rs : <?php echo number_format($product_data["price"] )?> (<?php echo $product_data["priceQty"] . "" . $product_data["unit_name"] ?> )</h5>
                        <p class="card-text"><?php echo $product_data["discription"] ?></p>
                        <div>
                            <a href="./singleProduct.php?pr_id=<?php echo $product_data["pid"] ?>" class="btn btn-primary">Buy Now</a>
                            <button class="btn btn-primary" id="cart-<?php echo $product_data['pid'] ?>" onclick="addCardItem('<?php echo $product_data['pid'] ?>')"><i class="bi bi-cart-check-fill"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <div class="text-end float-right">
            <a href="./product.php?cat_id=<?php echo $product_data['category_id'] ?>" class="text-primery">see more...</a>
        </div>
    </div>



<?php
    //footer
    require_once('./Footer.php');
} else {
    header('Location: ./home.php');
    exit();
}
?>