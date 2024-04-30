<?php 
include 'header.php';  
?>

<!-- Add Seller Button -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSellerModal">Add Seller</button>
        </div>
    </div>
</div>

<!-- Display List of Sellers -->
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <h2>List of Sellers</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Tel</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Retrieve list of sellers from the database
                    $sellers = OHSMS::getSellers();
                    foreach ($sellers as $seller) {
                        ?>
                        <tr>
                            <td><?php echo $seller['id']; ?></td>
                            <td><?php echo $seller['name']; ?></td>
                            <td><?php echo $seller['email']; ?></td>
                            <td><?php echo $seller['mobileNumber']; ?></td>
                            <td><?php echo $seller['country']; ?></td>
                            <td>
                                <!-- Edit Seller Button (opens edit modal) -->
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editSellerModal<?php echo $seller['id']; ?>">Edit</button>
                                <!-- Delete Seller Button (opens delete modal) -->
                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteSellerModal<?php echo $seller['id']; ?>">Delete</button>
                            </td>
                            <!-- Edit Seller Modal -->
                            <div class="modal fade" id="editSellerModal<?php echo $seller['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editSellerModalLabel<?php echo $seller['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Seller Details</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <form action="server.php" method="post">
                                                <div class="form-group">
                                                    <label for="editName<?php echo $seller['id']; ?>">Name</label>
                                                    <input type="text" class="form-control" id="editName<?php echo $seller['id']; ?>" name="editName" value="<?php echo $seller['name']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editEmail<?php echo $seller['id']; ?>">Email</label>
                                                    <input type="email" class="form-control" id="editEmail<?php echo $seller['id']; ?>" name="editEmail" value="<?php echo $seller['email']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editMobileNumber<?php echo $seller['id']; ?>">Mobile Number</label>
                                                    <input type="text" class="form-control" id="editMobileNumber<?php echo $seller['id']; ?>" name="editMobileNumber" value="<?php echo $seller['mobileNumber']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editAddress<?php echo $seller['id']; ?>">Address</label>
                                                    <input type="text" class="form-control" id="editAddress<?php echo $seller['id']; ?>" name="editAddress" value="<?php echo $seller['address']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editCity<?php echo $seller['id']; ?>">City</label>
                                                    <input type="text" class="form-control" id="editCity<?php echo $seller['id']; ?>" name="editCity" value="<?php echo $seller['city']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editState<?php echo $seller['id']; ?>">State</label>
                                                    <input type="text" class="form-control" id="editState<?php echo $seller['id']; ?>" name="editState" value="<?php echo $seller['state']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editCountry<?php echo $seller['id']; ?>">Country</label>
                                                    <input type="text" class="form-control" id="editCountry<?php echo $seller['id']; ?>" name="editCountry" value="<?php echo $seller['country']; ?>" required>
                                                </div>
                                                <input type="hidden" name="sellerId" value="<?php echo $seller['id']; ?>">
                                                <button type="submit" class="btn btn-primary" name="edit_seller">Save Changes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Seller Modal -->
                            <div class="modal fade" id="deleteSellerModal<?php echo $seller['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteSellerModalLabel<?php echo $seller['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteSellerModalLabel<?php echo $seller['id']; ?>">Delete Seller</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this seller?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="server.php" method="post">
                                                <input type="hidden" name="sellerId" value="<?php echo $seller['id']; ?>">
                                                <button type="submit" class="btn btn-danger" name="delete_seller">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php include 'modal.php'; ?>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include modal.php -->
<?php include 'modal.php'; ?>

<?php include 'footer.php';?>
