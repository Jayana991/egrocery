<?php
if (isset($_GET['cat_id'])) {
    $catid = $_GET['cat_id'];

    //header
    $title = "PRODUCT PAGE"; //page title
    require_once('./Header.php');

    //get products data
    $product_rs = Database::search("SELECT product.* , unit.* , product.id AS pid FROM product INNER JOIN unit ON product.unit_id = unit.id  WHERE category_id = '".$catid."' LIMIT 4 ");
    $cat_rs = Database::search("SELECT * FROM category WHERE id = '" . $catid . "' ");
    $cat_data = $cat_rs->fetch_assoc();

?>

    <section class="product-section " style="margin-top: 100px;">
        <div class="container-fluid">
            <h3 class="text-start fw-bold fs-3 mb-4 offset-1"><?php echo $cat_data["category_name"] ?></h3>
            <div class="row" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
                <?php
                foreach ($product_rs as $product_data) {
                ?>
                    <div class="col-12 col-md-3">
                        <div class="card mb-4">
                            <img src="../document/<?php echo $product_data["img_path"] ?>" class="card-img-top" alt="Product 1">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product_data["name"] ?></h5>
                                <h5 class="card-title">Rs : <?php echo number_format($product_data["price"] )?> (<?php echo $product_data["priceQty"] . "" . $product_data["unit_name"] ?> )</h5>
                                <p class="card-text"><?php echo $product_data["smapleDis"] ?></p>
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
            </div>
        </div>
    </section>

<?php
    //footer
    require_once('./Footer.php');
} else {
    header('Location: ./home.php');
    exit();
}


?>