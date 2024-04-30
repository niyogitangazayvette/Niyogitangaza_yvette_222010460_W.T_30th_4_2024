<?php
include 'header.php';
$sold_houses = OHSMS::getSoldHouses();

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-md-center">List of Sold Houses</h2> 
            <div class="table-container "> 
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>UPI Number</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Seller</th>
                            <th>House status</th>
                            <th>Date Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($sold_houses)) { ?>
                            <tr>
                                <td colspan="6" class="text-center">No sold houses found</td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($sold_houses as $house) { ?>
                                <tr>
                                    <td><?php echo $house['upiNumber']; ?></td>
                                    <td><?php echo $house['description']; ?></td>
                                    <td><?php echo $house['price']; ?></td>
                                    <td><?php echo $house['location']; ?></td>
                                    <td><?php echo $house['seller']; ?></td>
                                    <td><?php echo $house['hstatus']; ?></td>
                                    <td><?php echo $house['pdate']; ?></td>
                                    
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
