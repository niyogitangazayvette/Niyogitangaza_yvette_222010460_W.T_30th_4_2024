<?php
include 'ohsms.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Assuming form fields are posted from the registration form
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobileNumber = $_POST["mobileNumber"];
        $securityQuestion = $_POST["securityQuestion"];
        $answer = $_POST["answer"];
        $password = $_POST["password"];
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $country = $_POST["country"];
        $role = $_POST["role"];

        // Call the registerUser function from OHSMS class
        $adduser = OHSMS::registerUser($name, $email, $mobileNumber, $securityQuestion, $answer, $password, $address, $city, $state, $country,$role);

        if ($adduser['status'] == "success") {
            echo '<script>window.alert("' . $adduser['message'] . '"); window.location.href = "../login.php";</script>';
        } else {
            echo '<script>window.alert("' . $adduser['message'] . '"); window.location.href = "../login.php";</script>';
        }
    }else if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $login_result = OHSMS::authenticateUser($email, $password, $role);

        if ($login_result['status'] == "success") {
            // Retrieve user details from the database
            $user_details = OHSMS::getUserDetails($email, $password, $role);
            // Set session variables for each parameter
            $_SESSION['id'] = $user_details['id'];
            $_SESSION['name'] = $user_details['name'];
            $_SESSION['email'] = $user_details['email'];
            $_SESSION['mobileNumber'] = $user_details['mobileNumber'];
            $_SESSION['securityQuestion'] = $user_details['securityQuestion'];
            $_SESSION['answer'] = $user_details['answer'];
            $_SESSION['password'] = $user_details['password'];
            $_SESSION['address'] = $user_details['address'];
            $_SESSION['city'] = $user_details['city'];
            $_SESSION['state'] = $user_details['state'];
            $_SESSION['country'] = $user_details['country'];
            $_SESSION['role'] = $user_details['role'];
            $_SESSION['status'] = $user_details['status'];
            //echo $_SESSION['role'];

            // Redirect the user to the appropriate dashboard based on their role
            if ($user_details['role'] == "seller") {
                echo "<script>alert('Welcome, " . $user_details['name'] . "!');</script>";
                //Redirect to the appropriate dashboard after a short delay
                echo "<script>setTimeout(function() {";
                echo "window.location.href = '../Seller/index.php';";
                echo "}, 500);</script>";
            } elseif ($user_details['role'] == "buyer") {
                echo "<script>alert('Welcome, " . $user_details['name'] . "!');</script>";
                //Redirect to the appropriate dashboard after a short delay
                echo "<script>setTimeout(function() {";
                echo "window.location.href = '../Buyer/index.php';";
                echo "}, 500);</script>";
            }

            exit();
        } else {
            echo '<script>window.alert("' . $login_result['message'] . '"); window.location.href = "../login.php";</script>';
        }
    }else if (isset($_POST['edit_house'])) {
        // Retrieve the data submitted via the form
        $houseId = $_POST['houseId'];
        $upiNumber = $_POST['editUPI'];
        $description = $_POST['editDescription'];
        $price = $_POST['editPrice'];
        $location = $_POST['editLocation'];
        $sellerId = $_POST['editsellerId'];

        // Update the house details in the database
        $success = OHSMS::editHouse($houseId, $upiNumber, $description, $price, $location, $sellerId);

        if ($success['status'] == "success") {
            echo '<script>window.alert("' . $success['message'] . '"); window.location.href = "list-houses.php";</script>';
        } else {
             echo '<script>window.alert("' . $success['message'] . '"); window.location.href = "list-houses.php";</script>';
        }
    }else if (isset($_POST['delete_house'])) {
        // Get the house ID to delete
        $houseId = $_POST['houseId'];

        // Call the deleteHouse function from your OHMS class
        $result = OHSMS::deleteHouse($houseId);

        // Check the result of the delete operation
        if ($result['status'] === 'success') {
            // Redirect to the list-houses page with a success message
            header('Location: list-houses.php?status=success&message=' . urlencode($result['message']));
            exit();
        } else {
            // Redirect to the list-houses page with an error message
            header('Location: list-houses.php?status=error&message=' . urlencode($result['message']));
            exit();
        }
    }else if (isset($_POST['edit_seller'])) {
        
        // Get the seller details from the $_POST superglobal
        $sellerId = $_POST['sellerId'];
        $name = $_POST['editName'];
        $email = $_POST['editEmail'];
        $mobileNumber = $_POST['editMobileNumber'];
        $address = $_POST['editAddress'];
        $city = $_POST['editCity'];
        $state =$_POST['editState'];
        $country =$_POST['editCountry'];


        // Assuming $role is known and stored somewhere in your application
        $role = 'seller';

        // Call the updateSeller method with all required parameters
        $result = OHSMS::updateSeller($sellerId, $name, $email, $mobileNumber, $address, $city, $state, $country, $role);

      
        if ($result['status'] == "success") {
            echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-sellers.php";</script>';
        } else {
             echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-sellers.php";</script>';
        } exit();
        
    }else if (isset($_POST['delete_seller'])) {
        // Get the seller ID from the POST data
        $sellerId = $_POST['sellerId'];
        
        // Call the deleteSeller method from the OHSMS class
        $result = OHSMS::deleteSeller($sellerId);

        if ($result['status'] == "success") {
            echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-sellers.php";</script>';
        } else {
             echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-sellers.php";</script>';
        } exit();
    }else if(isset($_POST['add_house'])) {
        // Get form data
        $upiNumber = $_POST['upiNumber'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $location = $_POST['location'];
        $sellerId = $_POST['seller'];
        $pic = $_FILES['pic'];
        $status = $_POST['status'];

        // File upload handling
        $targetDirectory = "img/";
        $imageFileType = strtolower(pathinfo($pic['name'], PATHINFO_EXTENSION));
        $uniqueFileName = uniqid() . '_' . time() . '.' . $imageFileType; // Unique file name with timestamp
        $targetFile = $targetDirectory . $uniqueFileName;
        $uploadOk = 1;

        // Check if file is an actual image
        $check = getimagesize($pic["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($pic["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($pic["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars($targetFile). " has been uploaded.";

                // Call the addHouse function with the full file path
                $result = OHSMS::addHouse($upiNumber, $description, $price, $location, $sellerId, $targetFile, $status);

                // Check the result
                if ($result['status'] == "success") {
                    echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-houses.php";</script>';
                } else {
                     echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-houses.php";</script>';
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }else if(isset($_POST['orderIdApprove'])) {
        // Process the approval logic here
        $orderId = $_POST['orderIdApprove'];
        // Update payment status and house status using your OHMS class
        $result=OHSMS::approveOrder($orderId);
        // Check the result
        if ($result['status'] == "success") {
            echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-houses.php";</script>';
        } else {
             echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-houses.php";</script>';
        } 
    }else if(isset($_POST['orderIdApprove3'])) {
        // Process the approval logic here
        $orderId = $_POST['orderIdApprove3'];
        // Update payment status and house status using your OHMS class
        $result=OHSMS::approveOrder($orderId);
        // Check the result
        if ($result['status'] == "success") {
            echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "../Seller/myOrders.php";</script>';
        } else {
            echo '<script>window.alert("' . $result['message'] . '"); window.location.href ="../Seller/myOrders.php";</script>';
        } 
    }else if(isset($_POST['orderIdCancel'])) {
        // Process the cancellation logic here
        $orderId = $_POST['orderIdCancel'];
        // Update payment status and house status using your OHMS class
        $result=OHSMS::cancelOrder($orderId);
        // Check the result
        if ($result['status'] == "success") {
            echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-houses.php";</script>';
        } else {
             echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "list-houses.php";</script>';
        } 
    }else if(isset($_POST['orderIdCancel2'])) {
        // Process the cancellation logic here
        $orderId = $_POST['orderIdCancel2'];
        // Update payment status and house status using your OHMS class
        $result=OHSMS::cancelOrder($orderId);
        // Check the result
        if ($result['status'] == "success") {
            echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "../Buyer/myOrders.php";</script>';
        } else {
             echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "../Buyer/myOrders.php";</script>';
        } 
    }else if(isset($_POST['orderIdCancel3'])) {
        // Process the cancellation logic here
        $orderId = $_POST['orderIdCancel3'];
        // Update payment status and house status using your OHMS class
        $result=OHSMS::cancelOrder($orderId);
        // Check the result
        if ($result['status'] == "success") {
            echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "../Seller/myOrders.php";</script>';
        } else {
             echo '<script>window.alert("' . $result['message'] . '"); window.location.href = "../Seller/myOrders.php";</script>';
        } 
    }else if (isset($_POST['orderIdBuy'])) {
        // Get the house ID from the form
        $houseId = $_POST['orderIdBuy'];
        $price = $_POST['price'];
        if ($_SESSION['role'] == "seller") {
            // User is not logged in as a buyer, redirect to the login page
            echo '<script>window.alert("Please You must create the Acccount of buyer."); window.location.href = "../login.php";</script>';
            exit();
        }
        if (empty($_SESSION['id']) && (empty($_SESSION['role']))) {
            // User is not logged in as a buyer, redirect to the login page
            echo '<script>window.alert("Please log in as a buyer first."); window.location.href = "../login.php";</script>';
            exit();
        }


        $check = OHSMS::updateHouseStatus($houseId, $_SESSION['id']);
        // Update the house status to "Appending"
        $updateHouseStatus = OHSMS::updateHouseStatus($houseId, 'Appending');

        // Check if the house status was updated successfully
        if ($updateHouseStatus['status'] == 'success') {
            // Insert a payment record with status "Appending"
            $insertPayment = OHSMS::insertPayment($houseId, $_SESSION['id'], 'Appending',$price);

            if ($insertPayment['status'] == 'success') {
                echo '<script>window.alert("'.$insertPayment['message'] .'."); window.location.href = "../myhouses.php";</script>';
            } else {
                // If insertion of payment record fails, revert the house status
                OHSMS::updateHouseStatus($houseId, 'Available');
                echo '<script>window.alert("'.$insertPayment['message'] .'"); window.location.href = "../myhouses.php";</script>';
            }
        } else {
            echo '<script>window.alert("'.$updateHouseStatus['message'] .'"); window.location.href = "../myhouses.php";</script>';
        }
    }else if(isset($_POST['adminlogin'])) {
        // Get the username and password from the form
        $username = $_POST['adminUsername'];
        $password = $_POST['adminPassword'];
        $role= $_POST['role'];

        // Validate admin credentials using your OHSMS class method
        $isAdminValid = OHSMS::validateAdminCredentials($username, $password,$role);

        if($isAdminValid) {
            // If admin credentials are valid, retrieve admin details
            $admin_details = OHSMS::getAdminDetails($username, $password,$role);

            // store admin details
            $_SESSION['id'] = $admin_details['id'];
            $_SESSION['name'] = $admin_details['name'];
            $_SESSION['email'] = $admin_details['email'];
            $_SESSION['mobileNumber'] = $admin_details['mobileNumber'];
            $_SESSION['securityQuestion'] = $admin_details['securityQuestion'];
            $_SESSION['answer'] = $admin_details['answer'];
            $_SESSION['password'] = $admin_details['password'];
            $_SESSION['address'] = $admin_details['address'];
            $_SESSION['city'] = $admin_details['city'];
            $_SESSION['state'] = $admin_details['state'];
            $_SESSION['country'] = $admin_details['country'];
            $_SESSION['role'] = $admin_details['role'];
            $_SESSION['status'] = $admin_details['status'];

            // Display a welcome alert using JavaScript
            echo "<script>alert('Welcome, " . $admin_details['name'] . "!');</script>";

            //Redirect to the appropriate dashboard after a short delay
            echo "<script>setTimeout(function() {";
            echo "window.location.href = '../Administrator/index.php';";
            echo "}, 500);</script>";
            exit();
        } else {
            // Display a welcome alert using JavaScript
            echo "<script>alert('Invalid credentials. Please try again., " . $$username. "!');</script>";

            // Redirect to the appropriate dashboard after a short delay
            echo "<script>setTimeout(function() {";
            echo "window.location.href = '../index.php';";
            echo "}, 500);</script>";
            exit();
        }
    }

}   
?>
