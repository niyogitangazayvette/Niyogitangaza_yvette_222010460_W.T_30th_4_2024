<?php
include 'header.php'; // Include your header file
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Appending Orders</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>UPI Number</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Payment Status</th>
                        <th>Action</th> <!-- New Column for Action -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch houses with status "Appending" and payment status "Appending" from the database using OHMS class method
                    $appending_orders = OHSMS::getAppendingOrders();
                   
                    // Check if there are any appending orders
                    if (empty($appending_orders)) {
                        echo "<tr><td colspan='6' style='text-align: center; font-weight: bold;'>No appending orders found</td></tr>";
                    } else {
                        foreach ($appending_orders as $order) {
                            ?>
                            <tr>
                                <td><?php echo $order['upiNumber']; ?></td>
                                <td><?php echo $order['description']; ?></td>
                                <td><?php echo $order['price']; ?></td>
                                <td><?php echo $order['location']; ?></td>
                                <td>Appending</td>
                                <?php if ($order['pstatus'] === 'Appending') { ?>
                                    <td><button type="button" class="btn btn-success cancel-btn" data-toggle="modal" data-target="#approveModal<?php echo $order['orderId']; ?>">Approve</button></td>
                                    <td><button type="button" class="btn btn-danger cancel-btn" data-toggle="modal" data-target="#cancelModal<?php echo$order['orderId']; ?>">Cancel</button></td>
                                <?php } else { ?>
                                    <td colspan="2">Decision Taken</td>
                                <?php } ?>
                                <!-- Modal for cancel -->
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
                                                    <input type="hidden" id="orderIdCancel" name="orderIdCancel" value="<?php echo $order['orderId']; ?>">
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

                                <!-- Modal for approve -->
                                <div class="modal fade" id="approveModal<?php echo $order['orderId']; ?>" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approveModalLabel">Approve Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form id="approveForm" action="../Administrator/server.php" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" id="orderIdApprove" name="orderIdApprove" value="<?php echo $order['orderId']; ?>">
                                                    <p>Are you sure you want to approve this order?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" id="approveOrderBtn">Confirm</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
