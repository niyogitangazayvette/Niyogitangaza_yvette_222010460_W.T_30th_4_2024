<!-- Edit Modal -->
<div class="modal fade" id="editModal<?php echo $house['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $house['id']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?php echo $house['id']; ?>">Edit House</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="server.php" method="post">
                    <div class="form-group">
                        <label for="editUPI<?php echo $house['id']; ?>">UPI Number</label>
                        <input type="text" class="form-control" id="editUPI<?php echo $house['id']; ?>" name="editUPI" value="<?php echo $house['upiNumber']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription<?php echo $house['id']; ?>">Description</label>
                        <textarea class="form-control" id="editDescription<?php echo $house['id']; ?>" name="editDescription" rows="3"><?php echo $house['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editPrice<?php echo $house['id']; ?>">Price</label>
                        <input type="text" class="form-control" id="editPrice<?php echo $house['id']; ?>" name="editPrice" value="<?php echo $house['price']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="editLocation<?php echo $house['id']; ?>">Location</label>
                        <input type="text" class="form-control" id="editLocation<?php echo $house['id']; ?>" name="editLocation" value="<?php echo $house['location']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="editLocation<?php echo $house['sellerId']; ?>">Seller ID: <?php echo $house['sellerId']; ?></label>
                        <input type="hidden" class="form-control" id="editsellerId<?php echo $house['id']; ?>" name="editsellerId" value="<?php echo $house['sellerId']; ?>" required >
                    </div>
                    <!-- You can add more fields as needed -->
                    <input type="hidden" name="houseId" value="<?php echo $house['id']; ?>">
                    <button type="submit" class="btn btn-primary" name="edit_house">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal<?php echo $house['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo $house['id']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel<?php echo $house['id']; ?>">Delete House</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this house?</p>
            </div>
            <div class="modal-footer">
                <form action="server.php" method="post">
                    <input type="hidden" name="houseId" value="<?php echo $house['id']; ?>">
                    <button type="submit" class="btn btn-danger" name="delete_house">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add House Modal -->
<div class="modal fade" id="addHouseModal" tabindex="-1" role="dialog" aria-labelledby="addHouseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addHouseModalLabel">Add New House</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new house -->
                <form action="server.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="upiNumber">UPI Number</label>
                        <input type="text" class="form-control" id="upiNumber" name="upiNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="seller">Seller/Owner</label>
                        <select class="form-control" id="seller" name="seller">
                            <option selected disabled>Select Seller/Owner</option>
                            <?php
                            // Fetch sellers from the database using OHSMS class method
                            $sellers = OHSMS::getSellers();
                            foreach ($sellers as $seller) {
                                echo "<option value='" . $seller['id'] . "'>" . $seller['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Additional fields -->
                    <div class="form-group">
                        <label for="pic">Picture</label>
                        <input type="file" class="form-control-file" id="pic" name="pic">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Available">Available</option>
                            <option value="Sold">Sold</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="add_house">Add House</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="addSellerModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">User Registration Form</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="server.php" method="post" class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="mobileNumber">Mobile Number</label>
                            <input type="text" class="form-control" id="mobileNumber" placeholder="Enter your mobile number" name="mobileNumber" required>
                        </div>
                        <div class="form-group">
                            <label for="securityQuestion">Security Question</label>
                            <select class="form-control" id="securityQuestion" name="securityQuestion" required>
                                <option value="" selected disabled>Select a security question</option>
                                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                                <option value="What city were you born in?">What city were you born in?</option>
                                <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="answer">Answer</label>
                            <input type="text" class="form-control" id="answer" placeholder="Enter the answer" name="answer" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter your address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter your city" name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state" placeholder="Enter your state" name="state" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" placeholder="Enter your country" name="country" required>
                        </div>
                    </div>
                    <input type="hidden" name="role" value="seller">
                    <div class="col-md-12">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="register">Register</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




