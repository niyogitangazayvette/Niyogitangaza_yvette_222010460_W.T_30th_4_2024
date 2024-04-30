<?php
include 'header.php';

// Retrieve orders for the seller based on their SellerId
$sellerId = $_SESSION['id']; // Assuming the seller's ID is stored in the session
$ordersList = OHSMS::getOrdersBySellerId($sellerId);

?>

<!-- Orders section -->
<div class="container">
    <div class="section-title">
        <h2>Orders for Seller</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>House UPI</th>
                        <th>House Price</th>
                        <th>House Location</th>
                        <th>Buyer Name</th>
                        <th>Status</th>
                        <th>Date Done</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordersList as $order) : ?>
                    <tr>
                        <td><?php echo $order['orderId']; ?></td>
                        <td><?php echo $order['houseUPI']; ?></td>
                        <td><?php echo $order['housePrice']; ?></td>
                        <td><?php echo $order['houseLocation']; ?></td>
                        <td><?php echo $order['buyerName']; ?></td>
                        <td><?php echo $order['pstatus']; ?></td>
                        <td><?php echo $order['pdate']; ?></td>
                        <?php if ($order['pstatus'] === 'Appending') { ?>
                            <td><button type="button" class="btn btn-success cancel-btn" data-toggle="modal" data-target="#approveModal<?php echo $order['orderId']; ?>">Approve</button></td>
                            <td><button type="button" class="btn btn-danger cancel-btn" data-toggle="modal" data-target="#cancelModal<?php echo$order['orderId']; ?>">Cancel</button></td>
                        <?php } else { ?>
                            <td colspan="2">Decision Taken</td>
                        <?php } ?>
                    </tr>

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
                                        <input type="hidden" id="orderIdCancel" name="orderIdCancel3" value="<?php echo $order['orderId']; ?>">
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
                                        <input type="hidden" id="orderIdApprove" name="orderIdApprove3" value="<?php echo $order['orderId']; ?>">
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
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>
