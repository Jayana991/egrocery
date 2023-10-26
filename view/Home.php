<?php
//header
$title = "HOME PAGE"; //page title
require_once('./Header.php');
?>

<!-- Header -->
<header class="header-section d-flex justify-content-center align-items-center" data-aos="fade-down" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
    <div class="col-12 col-md-6 text-center">
        <p class="fw-bold fs-2" data-aos="fade-down" data-aos-duration="800" data-aos-delay="400" data-aos-once="true">eGrocery's vision is to redefine grocery shopping, making it convenient, sustainable, and community-driven. We're committed to quality, accessibility, and a greener future, simplifying the way you shop for everyday essentials</p>
    </div>
</header>

<!-- about us -->
<section class="about-us-section my-5 " id="aboutus">
    <div class="container ">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-6 " data-aos="flip-left" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
                <h2 class="fw-bold fs-3 text-center my-3">About eGrocery</h2>
                <p class="fs-5 text-center">Welcome to eGrocery, your one-stop destination for redefining grocery shopping. Our mission is to make grocery shopping convenient, sustainable, and community-driven, all while ensuring top-notch quality and accessibility. At eGrocery, we're committed to creating a greener future and simplifying the way you shop for everyday essentials.</p>
            </div>
            <div class="col-12 col-md-6" data-aos="flip-right" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
                <img src="../src/img/aboutus.jpg" alt="Our Team" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- product sectiom -->
<section class="product-section">
    <div class="container-fluid">
        <h2 class="text-center fw-bold fs-3 mb-4">Featured Products</h2>

        <?php
        $cat_rs = Database::search("SELECT * FROM category LIMIT 3");
        foreach ($cat_rs as $cat_data) {
        ?>
            <h3 class="text-start fw-bold fs-3 mb-4 offset-1"><?php echo $cat_data["category_name"] ?></h3>
            <div class="row" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
                <?php
                $product_rs = Database::search("SELECT product.* , unit.* , product.id AS pid FROM product INNER JOIN unit ON product.unit_id = unit.id  WHERE category_id = '" . $cat_data["id"] . "' ");
                foreach ($product_rs as $product_data) {
                ?>
                    <div class="col-12 col-md-3">
                        <div class="card mb-4">
                            <img src="../document/<?php echo $product_data["img_path"] ?>" class="card-img-top" alt="Product 1">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product_data["name"] ?></h5>
                                <h5 class="card-title">Rs : <?php echo number_format($product_data["price"]) ?> (<?php echo $product_data["priceQty"] . "" . $product_data["unit_name"] ?> )</h5>
                                <p class="card-text"><?php echo $product_data["discription"] ?></p>
                                <div>
                                    <a href="./singleProduct.php?pr_id=<?php echo $product_data["pid"] ?>" class="btn btn-primary">Buy Now</a>
                                    <button class="btn btn-primary" id="cart-<?php echo $product_data['pid'] ?>" onclick="addCardItem('<?php echo $product_data['pid'] ?>' , this)"><i class="bi bi-cart-check-fill"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="text-end float-right">
                    <a href="./product.php?cat_id=<?php echo $cat_data['id'] ?>" class="text-primery">see more...</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>

<!-- Contact Us -->
<section class="contact-us-section my-3" id="contactus">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-6" data-aos="fade-down" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
                <img src="../src/img/contactus.jpg" alt="Contact Us" class="img-fluid rounded">
            </div>
            <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200" data-aos-once="true">
                <h2 class="fw-bold fs-3 text-center my-3">Contact Us</h2>
                <p class="fs-5 text-center">Have questions or need assistance? Feel free to reach out to us!</p>
                <ul class="list-unstyled text-center">
                    <li class="my-1">Email: <a href="mailto:<?php echo $pageData['email'] ?>"><?php echo $pageData['email'] ?></a></li>
                    <li class="my-1">Phone: <a href="tel:<?php echo $pageData['mobile'] ?>"><?php echo $pageData['mobile'] ?></a></li>
                </ul>
                <div class="text-center mt-4">
                    <a href="#" target="_blank" class="social-icon mx-2 fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" target="_blank" class="social-icon mx-2 fs-5"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//footer
require_once('./Footer.php');
?>