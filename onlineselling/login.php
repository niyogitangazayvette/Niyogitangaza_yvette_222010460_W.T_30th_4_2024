
<?php include 'header.php' ?>
    <style>
        /* Additional CSS for centering buttons */
        .center-buttons {
            display: flex;
            justify-content: center;
        }
    </style>
    <div class="container">
        <center><h1 class="mt-5 mb-3">Welcome to Online House Selling Management System</h1></center><br><br>
        <div class="row">
            <div class="col-md-12 center-buttons">
                <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#loginModal" style="width:30%;">User Login</button>
                <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#AdminloginModal" style="width:30%;">Admin Login</button>
            </div>
        </div>
    </div>

<?php include 'modal.php' ?>
<?php include 'footer.php' ?>