<?php 
include 'header.php'; 
?>

<div class="container mt-5">
    <div class="row">
        <!-- Button to add a new house -->
        <div class="col-md-12 mb-3">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addHouseModal">
                Add New House
            </button>
        </div>
        
        <!-- Table to display available houses -->
        <div class="col-md-12">
            <h2>Available Houses</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>UPI Number</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Date recorded on</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch available houses from the database using OHMS class method
                    $available_houses = OHSMS::getAvailableHouses();
                    if(empty($available_houses)) {
                        echo "<tr><td colspan='5'><center><b>No houses available</td></tr>";
                    } else {
                        foreach ($available_houses as $house) {
                            ?>
                            <tr>
                                <td><?php echo $house['upiNumber']; ?></td>
                                <td><?php echo $house['description']; ?></td>
                                <td><?php echo $house['price']; ?></td>
                                <td><?php echo $house['location']; ?></td>
                                <td><?php echo $house['status']; ?></td>
                                <td><?php echo $house['date_done']; ?></td>
                                <td>
                                    <!-- Button to trigger edit modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $house['id']; ?>">
                                        Edit
                                    </button></td><td>
                                    <!-- Button to trigger delete modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $house['id']; ?>">
                                        Delete
                                    </button>
                                    <?php include 'modal.php';?>
                                </td>
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
<?php include 'modal.php';?>
<?php include 'footer.php';?>
