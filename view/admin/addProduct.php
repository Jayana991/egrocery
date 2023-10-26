<?php
session_start();
if (isset($_SESSION["admin"])) {

    require('./header.php');
?>

    <div class="d-flex flex-row justify-content-between align-items-center" style="margin-top: 80px;">
        <h1 class="fw-bold fs-2 m-3 text-center"><span id="productDataProcessType">Add</span> Product </h1>
        <div>
            <button class="btn btn-primary btn-sm rounded-pill px-3" onclick="crudProductdata()"><span id="btnStatus">Update</span></button>
        </div>
    </div>

    <div class="d-flex flex-row justify-content-center align-items-center d-none" id="selectProcutForUD">
        <!-- student select -->
        <div class="d-flex flex-column w-75 my-3">
            <label for="">Select Product name / id</label>
            <select class="form-select rounded-pill text-center" id="selecteProduct" onchange="productIdForUpdate(this.value)">
                <option value="" selected disabled>---Select product---</option>
                <?php
                $set_productdata_rs = Database::search("SELECT `id`,`name` FROM product");
                while ($set_productdata_data = $set_productdata_rs->fetch_assoc()) {
                ?>
                    <option value="<?php echo $set_productdata_data["id"] ?>"><?php echo $set_productdata_data["name"] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>


    <div class="d-flex flex-column flex-md-row my-3 align-items-center">
        <div class="row col-12">

            <!-- product images -->
            <div class="col-12 col-md-4 mx-auto ">
                <div class="row mx-auto">
                    <div class="col-12 d-flex justify-content-center mx-auto">
                        <img src="../../src/img/empty.jpg" class="bg-transparent w-75 img-thumbnail border-0 " id="addProductimg">
                    </div>
                </div>

                <!-- image select -->
                <div class="row my-2 ">
                    <div class="col-12 mt-1 text-center">
                        <input type="file" class="d-none" accept=".jpg, .jpeg, .png" id="addproduct_imageSelect">
                        <label for="addproduct_imageSelect" class="w-75 btn py-2 btn-primary col-12  rounded-0" onclick="addProductimage()">Add Image</label>
                    </div>
                </div>

            </div>

            <!-- product data form -->
            <div class="col-12 col-md-8 d-flex flex-column">
                <div>
                    <h3 class="fw-bold">Product Details</h3>

                    <div id="alertMsg" class="alert alert-danger d-none" role="alert">
                    </div>
                </div>

                <!-- form -->
                <div class="d-flex flex-column">

                    <!-- name -->
                    <div class="d-flex flex-column flex-md-row justify-content-between my-1">
                        <div class="d-flex flex-column w-100 me-1">
                            <label for="">Product Name <span class="text-danger ms-1 fw-bold">*</span></label>
                            <input type="text" class="rounded-pill form-control py-2" id="productName">
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="d-flex flex-column flex-md-row justify-content-between my-3">
                        <div class="d-flex flex-column w-100 me-1">
                            <label for="">Category<span class="text-danger ms-1 fw-bold">*</span></label>
                            <select class="form-select rounded-pill text-center" id="productcategory">
                                <option value="null" selected disabled>---Select category---</option>
                                <?php
                                $set_category_rs = Database::search("SELECT * FROM category");
                                while ($set_category_data = $set_category_rs->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $set_category_data["id"] ?>"><?php echo $set_category_data["category_name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <!-- sample discription -->
                    <div class="d-flex flex-column w-100 my-1">
                        <label for="">Sample discription<span class="text-danger ms-1 fw-bold">*</span></label>
                        <textarea cols="30" rows="2" class="rounded form-control py-2" id="productSampleDiscription"></textarea>
                    </div>

                    <!-- discription -->
                    <div class="d-flex flex-column w-100 my-1">
                        <label for="">Discription<span class="text-danger ms-1 fw-bold">*</span></label>
                        <textarea cols="30" rows="2" class="rounded form-control py-2" id="productDiscription"></textarea>
                    </div>


                    <!-- Parent's details -->
                    <div class="d-flex flex-column flex-md-row justify-content-between my-1">
                        <div class="d-flex flex-column w-100 me-1">
                            <label for="">Price<span class="text-danger ms-1 fw-bold">*</span></label>
                            <input type="text" class="rounded-pill form-control py-2" id="productPrice">
                        </div>
                        <div class="d-flex flex-column w-100">
                            <label for="">The unit of the price<span class="text-danger ms-1 fw-bold">*</span> </label>
                            <input type="text" class="rounded-pill form-control py-2" id="productPriceQty">
                        </div>
                        <div class="d-flex flex-column w-100 me-1">
                            <label for="">unit<span class="text-danger ms-1 fw-bold">*</span></label>
                            <select class="form-select rounded-pill text-center" id="productUnit">
                                <option value="null" selected disabled>---Select unit---</option>
                                <?php
                                $set_unit_rs = Database::search("SELECT * FROM unit");
                                while ($set_unit_data = $set_unit_rs->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $set_unit_data["id"] ?>"><?php echo $set_unit_data["unit_name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- add student btn -->
                    <div class="col-12 mx-auto d-flex flex-column justify-content-center my-5">
                        <button class="btn btn-lg btn-primary rounded-pill mx-5 px-3" id="productAddBtnSection" onclick="addProduct()">Add Student</button>
                    </div>

                    <!-- update/delete student btn -->
                    <div class="col-12 mx-auto d-flex flex-column justify-content-center mb-5 mt-2 d-none" id="productUDbtnSection">
                        <button class="btn btn-lg btn-primary rounded-pill mx-5 px-3 my-2" onclick="UpdateProduct()">Update Product</button>
                        <button class="btn btn-lg btn-danger rounded-pill mx-5 px-3 my-2" onclick="deleteProduct()">Delete Product</button>
                    </div>

                </div>
            </div>

        </div>
    </div>


<?php

    require('./footer.php');
} else {
    header('Location: ../signIn.php');
    exit();
}

?>