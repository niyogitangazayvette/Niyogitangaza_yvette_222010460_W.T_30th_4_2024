<?php 
include '../Administrator/server.php';
if (empty($_SESSION['id']) && $_SESSION['role'] != "seller") {
    // User is not logged in as a buyer, redirect to the login page
    echo '<script>window.alert("Please log in as a buyer first."); window.location.href = "../login.php";</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online House Selling Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="main">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="title">
                <h1><img src="../images/logo.JPEG" alt="Logo" height="50" width="50" style="border-radius: 50%;">OHSMS SYSTEM</h1>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: white;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myHouses.php" style="color: white;">My House</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myOrders.php" style="color: white;">My Orders</a></li>
                   <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="color: white;">Logout</a> <!-- Added Logout link -->
                    </li>
                    
                </ul>
            </div>
        </nav>
        <div class="wrapper">