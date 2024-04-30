<?php 
include 'header.php'; 
$house_count = OHSMS::getHouseCount();
$sold_count = OHSMS::getSoldHouseCount();
$user_count = OHSMS::getUserCount();
$pending_orders_count = OHSMS::getPendingOrdersCount();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <a href="list-houses.php">
                    <h5 class="card-title"><i class="fas fa-home"></i> Number of Houses</h5>
                    <p class="card-text"><?php echo $house_count; ?></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <a href="list-sold-houses.php">
                    <h5 class="card-title"><i class="fas fa-handshake"></i> Number of Houses Sold</h5>
                    <p class="card-text"><?php echo $sold_count; ?></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                     <a href="list-sellers.php">
                    <h5 class="card-title"><i class="fas fa-users"></i> Number of Users</h5>
                    <p class="card-text"><?php echo $user_count; ?></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card text-center">
                <div class="card-body">
                     <a href="list-appending-orders.php">
                    <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Number of Pending Orders</h5>
                    <p class="card-text"><?php echo $pending_orders_count; ?></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
