<?php
include 'header.php';

// Retrieve houses with user IDs from the database
$housesList = OHSMS::getHousesWithUserIds($_SESSION['id']);
?>

<!-- Houses section -->
<div class="container">
    <div class="section-title">
        <h2>Houses with User IDs</h2>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>House ID</th>
                        <th>UPI</th>
                        <th>House Location</th>
                        <th>House Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($housesList as $house) : ?>
                        <tr>
                            <td><?php echo $house['houseId']; ?></td>
                            <td><?php echo $house['upiNumber']; ?></td>
                            <td><?php echo $house['location']; ?></td>
                            <td><?php echo $house['description']; ?></td>
                            <td><?php echo $house['hstatus']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
