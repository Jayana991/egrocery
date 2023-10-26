<?php
session_start();
if (isset($_SESSION["admin"])) {
    require('./header.php');
?>

<div class="col-12 my-3 d-lg-flex d-block flex-column flex-lg-row align-items-end" style="margin-top: 80px !important;">
        <h1 class="text-center text-uppercase mx-auto col-12 col-lg-6">Pending Order</h1>
    </div>

    <div style="overflow-x: scroll !important;" class="col-12 mx-auto">
        <table class="table table-dark">
            <thead>
                <tr class="text-center">
                    <th scope="col">Order Id</th>
                    <th scope="col">View Order Details</th>
                    <th scope="col">Contact number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="orderBody">
            <?php
                $get_order_rs = Database::search("SELECT * FROM `order` INNER JOIN orderstatus ON order.orderStatus_id = orderstatus.id INNER JOIN user ON order.user_id = user.id WHERE orderStatus_id = '1';");

                foreach ($get_order_rs as $get_order_data) {
                ?>
                     <tr class="text-center">
                         <th><?php echo $get_order_data["oid"] ?></th>
                         <td><a class="btn btn-primary rounded" href="<?php echo $pageData['domain'] ?>/view/myOrderStatus.php?id=<?php echo $get_order_data["oid"]; ?>" target="_blank">View Order</a></td>
                         <td><a href="tel:<?php echo $get_order_data["contact"] ?>"><?php echo $get_order_data["contact"] ?> </a>(<?php echo $get_order_data["name"] ?>)</td>
                         <td><button class="btn btn-success rounded" onclick="deliveryorder('<?php echo $get_order_data['oid'] ?>')">delivery</button></td>
                     </tr>
                    <?php
                }

                ?>
            </tbody>
        </table>
    </div>

<?php

require './footer.php';

} else {
    header('Location: ../signIn.php');
    exit();
}

?>