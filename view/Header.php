<?php
require '../connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-GROCERY - <?php echo $title ?></title>

    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/js/aos/aos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- navigation bar -->
            <nav class="navbar navbar-expand-lg bg-primary position-fixed mb-5 d-block" style="z-index: 9999;" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold fs-3" href="./Home.php">e-Grocery</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item"><a class="nav-link active" href="./Home.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="Home.php#aboutus">About Us</a></li>
                            <li class="nav-item"><a class="nav-link" href="Home.php#contactus">Contact Us</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Category</a>
                                <div class="dropdown-menu">
                                    <?php
                                    $cat_rs = Database::search("SELECT * FROM category");
                                    foreach ($cat_rs as $cat_data) {
                                    ?>
                                        <a class="dropdown-item" href="<?php echo "./product.php?cat_id=" . $cat_data['id']; ?>"><?php echo $cat_data['category_name']; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                        <div class="d-flex">
                            <input class="form-control me-sm-2" type="search" id="checkProductStatus" placeholder="Check your product status">
                            <button class="btn btn-secondary my-2 my-sm-0" type="button" onclick="checkProductStatus()">Search</button>
                        </div>
                        <div class="flex">
                            <a href="./signin.php" class="btn btn-sm fw-bold fs-4"><i class="bi bi-person-circle"></i></a>
                            <a href="./cart.php" class="btn btn-sm fw-bold fs-4"><i class="bi bi-cart-check-fill"></i></a>
                        </div>
                    </div>
                </div>
            </nav>