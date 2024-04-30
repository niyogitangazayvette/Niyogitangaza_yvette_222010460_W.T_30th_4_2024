<?php
include 'header.php';

// Retrieve orders from your database
$orders = OHSMS::getOrdersByUserId($_SESSION['id']); // Assuming you have a method to retrieve orders by user ID

// Separate orders based on status
$appendedOrders = [];
$approvedOrders = [];
$canceledOrders = [];

foreach ($orders as $order) {
    if ($order['pstatus'] === 'Appending') {
        $appendedOrders[] = $order;
    } elseif ($order['pstatus'] === 'Approved') {
        $approvedOrders[] = $order;
    } elseif ($order['pstatus'] === 'Cancelled') {
        $canceledOrders[] = $order;
    }
}
?>

<!-- Orders section -->
<div class="container">
    <div class="section-title">
        <h2>My Orders</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h3>All Orders</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>House UPI</th>
                        <th>House Price</th>
                        <th>House Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Combine all orders
                    $allOrders = array_merge($appendedOrders, $approvedOrders, $canceledOrders);
                    
                    // Iterate over all orders
                    foreach ($allOrders as $order) :
                    ?>
                        <tr>
                            <td><?php echo $order['orderId']; ?></td>
                            <td><?php echo $order['houseUPI']; ?></td>
                            <td><?php echo $order['housePrice']; ?></td>
                            <td><?php echo $order['houseLocation']; ?></td>
                            <td><?php echo $order['pstatus']; ?></td>
                            <td>
                                <?php if ($order['pstatus'] === 'Appending') : ?>
                                    <button type="button" class="btn btn-danger cancel-btn" data-toggle="modal" data-target="#cancelModal<?php echo $order['orderId']; ?>" data-order-id="<?php echo $order['orderId']; ?>">Cancel</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Cancel Modals -->
<?php
// Modals for canceling orders
foreach ($allOrders as $order) :
?>
    <div class="modal fade" id="cancelModal<?php echo $order['orderId']; ?>" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Cancel Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="cancelForm" action="../Administrator/server.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="orderIdCancel" name="orderIdCancel2" value="<?php echo $order['orderId']; ?>">
                        <p>Are you sure you want to cancel this order?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="cancelOrderBtn">Confirm</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
