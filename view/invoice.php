<?php
require '../connection.php';
session_start();
if (isset($_GET["oid"]) && isset($_SESSION["user"])) {

    $user = $_SESSION["user"];
    $oid = $_GET["oid"];
    $cartArray = $_SESSION["cart"];

    $order_rs = Database::search("SELECT * FROM `order` WHERE `oid`= '" . $oid . "'  ");
    $order_data = $order_rs->fetch_assoc();


    //date
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d"); //reg date

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>INVOICE </title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <style type="text/css">
            @page {
                size: auto;
                /* auto is the initial value */
                margin: 0
            }

            body {
                font-size: 14px;

            }

            .invoice-label {
                font-size: 30px;
                font-weight: bold;
                color: rgb(9, 124, 5);
            }

            .color-green {
                color: rgb(9, 124, 5);

            }

            .header-bg {
                background-color: rgb(31, 28, 71);
            }

            .bg-light-dark {
                background-color: rgb(212, 212, 212);
            }

            .watermark {
                position: fixed;
                opacity: 0.1;
                pointer-events: none;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                z-index: 9999;
                background-color: rgba(255, 255, 255, 0.8);
                /* Add a semi-transparent white background */
            }

            .watermark-text {
                font-size: 30px;
                font-weight: bold;
                color: rgb(9, 124, 5);
            }
        </style>
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">

                <div class="watermark"></div>

                <div class="col-12 col-lg-8 offset-lg-2 ">
                    <div class="row">

                        <!-- header section -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 header-bg p-2 mb-3">
                                </div>
                                <div class="watermark">
                                    <div class="watermark-text">CASH ON DELIVERY</div>
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
                            <span><?php echo $user["name"] ?>,</span><br>
                            <span><?php echo $user["address"] ?></span><br>
                            <span><?php echo $user["contact"] ?></span><br>
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
                                    <span><?php echo $date ?></span><br>
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
                                    foreach ($cartArray as $arr) {
                                        $cat_product_rs = Database::search("SELECT * FROM product WHERE id = '" . $arr . "'");
                                        $cat_product_data = $cat_product_rs->fetch_assoc();
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
                            <p>Please keep this invoice for your order confirmation.</p>
                            <p class="fw-bold">Thank you for shopping with us!</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const oid = document.getElementById("oid").innerText;
            function redirectToHomePage() {
                window.location.href = './myOrderStatus.php?id=' + oid; // Use oid instead of id
            }
            window.addEventListener('afterprint', redirectToHomePage);
            window.onload = print; // Use print as a function without ()
        </script>

    </body>

    </html>
<?php
}

$_SESSION["cart"] = array();

?>