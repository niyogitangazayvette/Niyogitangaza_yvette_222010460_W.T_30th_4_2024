<?php
include 'header.php'; 
$cancelled_orders = OHSMS::getCancelledOrdersWithDetails();
$approved_orders = OHSMS::getApprovedOrdersWithDetails();
$all_orders = array_merge($approved_orders, $cancelled_orders);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-md-center">All Orders</h2> 
            <div class="table-container "> 
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>UPI Number</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Date Done</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($all_orders)) { ?>
                            <tr>
                                <td colspan="6" class="text-center">No orders found</td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($all_orders as $order) { ?>
                                <tr>
                                    <td><?php echo $order['upiNumber']; ?></td>
                                    <td><?php echo $order['description']; ?></td>
                                    <td><?php echo $order['price']; ?></td>
                                    <td><?php echo $order['location']; ?></td>
                                    <td><?php echo isset($order['date_done']) ? $order['date_done'] : ''; ?></td>
                                    <td><?php echo $order['status']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <?php if (empty($all_orders)) { ?>
                            <tr>
                                <td colspan="6" class="text-center">No orders found</td>
                            </tr>
                        <?php } ?>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
