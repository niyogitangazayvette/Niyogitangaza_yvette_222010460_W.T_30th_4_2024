<?php

include 'db_connection.php';
$conn = getDBConnection();
 session_start();

class OHSMS {
    private static $pdo;

    public static function init() {
        self::$pdo = getDBConnection();
    }  
    
    public static function registerUser($name, $email, $mobileNumber, $securityQuestion, $answer, $password, $address, $city, $state, $country,$role) {
        // Get database connection
        $conn = getDBConnection();
        $password=md5($password);
        // Check if user already exists based on email or mobile number
        $stmt_check = $conn->prepare("SELECT * FROM user WHERE email = :email and role='$role'");
        $stmt_check->bindParam(":email", $email);
        $stmt_check->execute();
        $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return array("status" => "error", "message" => "User with this email or mobile number already exists");
        } else {
            // Prepare SQL statement for user insertion
            $stmt_insert = $conn->prepare("INSERT INTO user (name, email, mobileNumber, securityQuestion, answer, password, address, city, state, country,role) VALUES (:name, :email, :mobileNumber, :securityQuestion, :answer, :password, :address, :city, :state, :country,'$role')");
            $stmt_insert->bindParam(":name", $name);
            $stmt_insert->bindParam(":email", $email);
            $stmt_insert->bindParam(":mobileNumber", $mobileNumber);
            $stmt_insert->bindParam(":securityQuestion", $securityQuestion);
            $stmt_insert->bindParam(":answer", $answer);
            $stmt_insert->bindParam(":password", $password);
            $stmt_insert->bindParam(":address", $address);
            $stmt_insert->bindParam(":city", $city);
            $stmt_insert->bindParam(":state", $state);
            $stmt_insert->bindParam(":country", $country);

            // Execute SQL statement for user insertion
            if ($stmt_insert->execute()) {
                return array("status" => "success", "message" => "New record created successfully");
            } else {
                return array("status" => "error", "message" => "Error: " . implode(", ", $stmt_insert->errorInfo()));
            }
        }
    }

    public static function authenticateUser($email, $password, $role) {
        // Get database connection
        $conn = getDBConnection();
        $password=md5($password);
        // Prepare SQL statement to fetch user based on email, password, and role
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ? AND role = ?");
        $stmt->execute([$email, $password, $role]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if any rows were returned
        if ($result) {
            // User found, return success status
            return array("status" => "success", "message" => "User authenticated successfully");
        } else {
            // User not found or authentication failed, return error status
            return array("status" => "error", "message" => "Invalid credentials or user not found");
        }
    }

    public static function getUserDetails($email, $password, $role) {
        // Get database connection
        $conn = getDBConnection(); 
        $password=md5($password);
        // Prepare SQL statement to fetch user details based on email, password, and role
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ? AND role = ?");
        $stmt->execute([$email, $password, $role]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // User found, return user details
            return $result;
        } else {
            // User not found or multiple users found (which shouldn't happen)
            return array("status" => "error", "message" => "User not found or multiple users found");
        }
    }

    public static function getAvailableHouses() {
        // Get database connection
        $conn = getDBConnection();

        // Prepare SQL statement to fetch available houses
        $stmt = $conn->prepare("SELECT *,house.id as house_id FROM house,user WHERE house.sellerId=user.id and house.status = 'Available' group by house.id");
        $stmt->execute();
        
        $houses = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $houses[] = $row;
        }

        $conn = null; // Close connection

        return $houses;
    }

    public static function getSellers() {
        // Get database connection
        $conn = getDBConnection();

        // Prepare SQL statement to fetch sellers
        $stmt = $conn->prepare("SELECT * FROM user WHERE role = 'seller'");
        $stmt->execute();
        $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Close the statement and connection
        $stmt->closeCursor();
        $conn = null;

        return $sellers;

    }

    public static function editHouse($houseId, $upiNumber, $description, $price, $location, $sellerId) {
        try {
            // Get database connection
            $conn = getDBConnection();

            // Prepare the update query
            $sql = "UPDATE house SET upiNumber=?, description=?, price=?, location=?, sellerId=? WHERE id=?";
            $stmt = $conn->prepare($sql);

            // Execute the update query
            $success = $stmt->execute([$upiNumber, $description, $price, $location, $sellerId, $houseId]);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Check if the update was successful
            if ($success) {
                return array('status' => 'success', 'message' => 'House updated successfully.');
            } else {
                return array('status' => 'error', 'message' => 'Failed to update house.');
            }
        } catch (PDOException $e) {
            return array('status' => 'error', 'message' => 'Database error: ' . $e->getMessage());
        }
    }
    public static function deleteHouse($houseId) {
        try {
            // Get database connection
            $conn = getDBConnection();

            // Prepare the delete query
            $sql = "DELETE FROM house WHERE id=?";
            $stmt = $conn->prepare($sql);

            // Execute the delete query
            $success = $stmt->execute([$houseId]);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Check if the deletion was successful
            if ($success) {
                return array('status' => 'success', 'message' => 'House deleted successfully.');
            } else {
                return array('status' => 'error', 'message' => 'Failed to delete house.');
            }
        } catch (PDOException $e) {
            return array('status' => 'error', 'message' => 'Database error: ' . $e->getMessage());
        }
    }

   public static function updateSeller($sellerId, $name, $email, $mobileNumber, $address, $city, $state, $country, $role) {
        try {
            // Get database connection
            $conn = getDBConnection();

            // Check if the email or mobile number already exists for another user with the same role
            $stmt_check = $conn->prepare("SELECT * FROM user WHERE email = :email AND role = :role AND id != :sellerId");
            $stmt_check->bindParam(":email", $email);
            $stmt_check->bindParam(":role", $role);
            $stmt_check->bindParam(":sellerId", $sellerId);

            $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Email or mobile number already exists for another user with the same role
                return array("status" => "error", "message" => "Email or mobile number already exists for another user with the same role");
            } else {
                // Prepare the update query
                $sql = "UPDATE user SET name=?, email=?, mobileNumber=?, address=?, city=?, state=?, country=? WHERE id=?";
                $stmt = $conn->prepare($sql);

                // Execute the update query
                $success = $stmt->execute([$name, $email, $mobileNumber, $address, $city, $state, $country, $sellerId]);

                // Close the statement and connection
                $stmt->closeCursor();
                $conn = null;

                // Check if the update was successful
                if ($success) {
                    return array('status' => 'success', 'message' => 'Seller updated successfully.');
                } else {
                    return array('status' => 'error', 'message' => 'Failed to update seller.');
                }
            }
        } catch (PDOException $e) {
            return array('status' => 'error', 'message' => 'Database error: ' . $e->getMessage());
        }
    }

    public static function deleteSeller($sellerId) {
        try {
            // Get database connection
            $conn = getDBConnection();

            // Prepare the delete query
            $sql = "DELETE FROM user WHERE id=?";
            $stmt = $conn->prepare($sql);

            // Execute the delete query
            $success = $stmt->execute([$sellerId]);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Check if the deletion was successful
            if ($success) {
                return array('status' => 'success', 'message' => 'Seller deleted successfully.');
            } else {
                return array('status' => 'error', 'message' => 'Failed to delete seller.');
            }
        } catch (PDOException $e) {
            return array('status' => 'error', 'message' => 'Database error: ' . $e->getMessage());
        }
    }

     public static function addHouse($upiNumber, $description, $price, $location, $sellerId, $pic, $status) {
        try {
            // Get database connection
            $conn = getDBConnection();

            // Check if the house already exists based on the UPI number
            $stmt_check = $conn->prepare("SELECT * FROM house WHERE upiNumber = :upiNumber");
            $stmt_check->bindParam(":upiNumber", $upiNumber);
            $stmt_check->execute();
            $result_check = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($result_check) {
                $stmt_check->closeCursor(); // Close the cursor
                $conn = null;
                return array("status" => "error", "message" => "House with this UPI number already exists");
            } else {
                $stmt_check->closeCursor(); // Close the cursor

                // Prepare SQL statement for inserting a new house
                $stmt_insert = $conn->prepare("INSERT INTO house (upiNumber, description, price, location, sellerId, pic, status) VALUES (:upiNumber, :description, :price, :location, :sellerId, :pic, :status)");
                $stmt_insert->bindParam(":upiNumber", $upiNumber);
                $stmt_insert->bindParam(":description", $description);
                $stmt_insert->bindParam(":price", $price);
                $stmt_insert->bindParam(":location", $location);
                $stmt_insert->bindParam(":sellerId", $sellerId);
                $stmt_insert->bindParam(":pic", $pic);
                $stmt_insert->bindParam(":status", $status);

                // Execute SQL statement for inserting the new house
                if ($stmt_insert->execute()) {
                    $stmt_insert->closeCursor(); // Close the cursor
                    $conn = null;
                    return array("status" => "success", "message" => "House added successfully");
                } else {
                    $stmt_insert->closeCursor(); // Close the cursor
                    $conn = null;
                    return array("status" => "error", "message" => "Error adding house: " . $conn->errorInfo());
                }
            }
        } catch (PDOException $e) {
            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }

    public static function getAppendingOrders() {
        try {
            // Get database connection
            $conn = getDBConnection();
            
            // Prepare the SQL query to fetch appending orders with details from house and payment tables
            $sql = "SELECT h.*, p.* ,p.status as pstatus,p.id as orderId FROM house AS h JOIN payment AS p ON h.id = p.houseId WHERE h.status = 'Appending' AND p.status = 'Appending'";
            $stmt = $conn->query($sql);

            // Fetch all appending orders with details
            $appendingOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Return the fetched appending orders
            return $appendingOrders;
        } catch (PDOException $e) {
            // Handle any database errors
            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }

    public static function approveOrder($orderId) {
        try {
            // Connect to your database using PDO
            $conn = getDBConnection();

            // Begin a transaction
            $conn->beginTransaction();

            // Update payment status to "Cancelled" in the database
            $paymentQuery = "UPDATE payment SET status = 'Approved' WHERE id = :orderId";
            $paymentStatement = $conn->prepare($paymentQuery);
            $paymentStatement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $paymentStatement->execute();

            // Check if the first update was successful
            if ($paymentStatement->rowCount() > 0) {
                // Update house status to "Available" in the database
                $houseQuery = "UPDATE house SET status = 'Sold' WHERE id = (SELECT houseId FROM payment WHERE id = :orderId)";
                $houseStatement = $conn->prepare($houseQuery);
                $houseStatement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
                $houseStatement->execute();

                // Commit the transaction if both updates are successful
                $conn->commit();

                return array("status" => "success", "message" => "Order canceled successfully.");
            } else {
                // Rollback the transaction if the first update fails
                $conn->rollBack();

                return array("status" => "error", "message" => "Error updating payment status.");
            }
        } catch (PDOException $e) {
            // Rollback the transaction in case of any exception
            $conn->rollBack();

            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }

    public static function cancelOrder($orderId) {
        try {
            // Connect to your database using PDO
            $conn = getDBConnection();

            // Begin a transaction
            $conn->beginTransaction();

            // Update payment status to "Cancelled" in the database
            $paymentQuery = "UPDATE payment SET status = 'Cancelled' WHERE id = :orderId";
            $paymentStatement = $conn->prepare($paymentQuery);
            $paymentStatement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $paymentStatement->execute();

            // Check if the first update was successful
            if ($paymentStatement->rowCount() > 0) {
                // Update house status to "Available" in the database
                $houseQuery = "UPDATE house SET status = 'Available' WHERE id = (SELECT houseId FROM payment WHERE id = :orderId)";
                $houseStatement = $conn->prepare($houseQuery);
                $houseStatement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
                $houseStatement->execute();

                // Commit the transaction if both updates are successful
                $conn->commit();

                return array("status" => "success", "message" => "Order canceled successfully.");
            } else {
                // Rollback the transaction if the first update fails
                $conn->rollBack();

                return array("status" => "error", "message" => "Error updating payment status.");
            }
        } catch (PDOException $e) {
            // Rollback the transaction in case of any exception
            $conn->rollBack();

            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }



    public static function getCancelledOrdersWithDetails() {
        try {
            // Get database connection
            $conn = getDBConnection();
            
            // Prepare the SQL query to fetch cancelled orders with details from house and payment tables
            $sql = "SELECT h.*, p.* FROM house AS h JOIN payment AS p ON h.id = p.houseId WHERE p.status = 'Cancelled'";
            $stmt = $conn->query($sql);

            // Fetch all cancelled orders with details
            $cancelledOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Return the fetched cancelled orders
            return $cancelledOrders;
        } catch (PDOException $e) {
            // Handle any database errors
            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }

    public static function getApprovedOrdersWithDetails() {
        try {
            // Get database connection
            $conn = getDBConnection();
            
            // Prepare the SQL query to fetch approved orders with details from house and payment tables
            $sql = "SELECT h.*, p.* FROM house AS h JOIN payment AS p ON h.id = p.houseId WHERE p.status = 'Approved'";
            $stmt = $conn->query($sql);

            // Fetch all approved orders with details
            $approvedOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Return the fetched approved orders
            return $approvedOrders;
        } catch (PDOException $e) {
            // Handle any database errors
            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }

    public static function getSoldHouses() {
        try {
            // Get database connection
            $conn = getDBConnection();
            
            // Prepare the SQL query to fetch sold houses with details from house and payment tables
            $sql = "SELECT h.upiNumber, h.description, h.price, h.location, u.name AS seller, p.date_done as pdate,h.status as hstatus
                    FROM house AS h
                    JOIN payment AS p ON h.id = p.houseId
                    JOIN user AS u ON h.sellerId = u.id
                    WHERE p.status = 'Approved'";
            $stmt = $conn->query($sql);

            // Fetch all sold houses with details
            $soldHouses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Return the fetched sold houses
            return $soldHouses;
        } catch (PDOException $e) {
            // Handle any database errors
            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }


   // Method to get the count of all houses
    public static function getHouseCount() {
        $query = "SELECT COUNT(*) as house_count FROM house";
        $statement = self::$pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['house_count'];
    }

    // Method to get the count of sold houses
    public static function getSoldHouseCount() {
        $query = "SELECT COUNT(*) as sold_count FROM house WHERE status = 'Sold'";
        $statement = self::$pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['sold_count'];
    }

    // Method to get the count of users
    public static function getUserCount() {
        $query = "SELECT COUNT(*) as user_count FROM user";
        $statement = self::$pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['user_count'];
    }

    // Method to get the count of pending orders
    public static function getPendingOrdersCount() {
        $query = "SELECT COUNT(*) as pending_orders_count FROM payment WHERE status = 'Pending'";
        $statement = self::$pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['pending_orders_count'];
    }

    public static function updateHouseStatus($houseId, $status)
    {
        // Assuming you have a PDO database connection stored in a variable called $pdo
        // Prepare the SQL statement
        $stmt = self::$pdo->prepare("UPDATE house SET status = :status WHERE id = :houseId");

        // Bind parameters
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':houseId', $houseId);

        // Execute the statement
        if ($stmt->execute()) {
            // If the query is successful, return success status
            return array('status' => 'success', 'message' => 'House status updated successfully.');
        } else {
            // If the query fails, return error status
            return array('status' => 'error', 'message' => 'Failed to update house status.');
        }
    }

    public static function insertPayment($houseId, $userId, $status,$price)
    {
        
        // Check if the order already exists
        $stmt_check = self::$pdo->prepare("SELECT * FROM payment WHERE houseId = :houseId AND buyerId = :userId and status='$status'");
        $stmt_check->bindParam(':houseId', $houseId);
        $stmt_check->bindParam(':userId', $userId);
        $stmt_check->execute();
        $existing_order = $stmt_check->fetch();
        if ($existing_order) {
            // Order already exists, return an error status
            return array('status' => 'error', 'message' => 'Order already exists.');
        } else {
            // Prepare the SQL statement to insert the payment record
            $stmt_insert = self::$pdo->prepare("INSERT INTO payment (houseId, buyerId, status,amount) VALUES (:houseId, :userId, :status,'$price')");
            $stmt_insert->bindParam(':houseId', $houseId);
            $stmt_insert->bindParam(':userId', $userId);
            $stmt_insert->bindParam(':status', $status);

            // Execute the statement to insert the payment record
            if ($stmt_insert->execute()) {
                // If the query is successful, return success status
                return array('status' => 'success', 'message' => 'Payment recor is initiated successfully to make order.');
            } else {
                // If the query fails, return error status
                return array('status' => 'error', 'message' => 'Failed to insert payment record.');
            }
        }
    }

    public static function getOrdersByUserId($userId) {
        try {
            // Connect to the database
            $conn = getDBConnection();

            // Prepare SQL query to fetch orders for the given user ID
            $sql = "SELECT *,h.upiNumber AS houseUPI, h.price AS housePrice, h.location AS houseLocation, h.pic AS housePic, h.status AS houseStatus,p.status as pstatus,p.id as orderId from payment p, house as h where p.houseId = h.id and p.buyerId = :userId group by p.id";
            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

            // Execute the statement
            $stmt->execute();

            // Fetch all orders
            $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Return the fetched orders
            return $orders;
        } catch (PDOException $e) {
            // Handle database errors
            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }

    public static function getHousesWithUserIds($userId) {
        try {
            // Connect to your database using PDO
            $conn = getDBConnection();

            // Prepare SQL query to fetch houses with user IDs
            $sql = "SELECT h.*, u.id as userId,u.*,h.id as houseId,h.status as hstatus
                    FROM house h
                    INNER JOIN user u ON h.SellerId = u.id where u.id='$userId' group by h.id";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Execute the statement
            $stmt->execute();

            // Fetch all houses with user IDs
            $houses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Return the fetched houses with user IDs
            return $houses;
        } catch (PDOException $e) {
            // Handle database errors
            return array("status" => "error", "message" => "Database error: " . $e->getMessage());
        }
    }

     // Assume this method is part of the OHSMS class
    public static function getOrdersBySellerId($sellerId) {
        // Establish a database connection
        $conn = getDBConnection(); // Implement this function to get the database connection

        // Prepare the SQL query
        $query = "SELECT payment.id AS orderId, 
                         house.upiNumber AS houseUPI, 
                         house.price AS housePrice, 
                         house.location AS houseLocation, 
                         user.name AS buyerName, 
                         payment.status AS pstatus,
                         payment.date_done AS pdate
                  FROM payment
                  INNER JOIN house ON payment.houseId = house.id
                  INNER JOIN user ON payment.buyerId = user.id
                  WHERE house.sellerId = :sellerId
                  GROUP BY payment.id 
                  order by payment.status";

        // Prepare and execute the query
        $statement = $conn->prepare($query);
        $statement->bindParam(':sellerId', $sellerId, PDO::PARAM_INT);
        $statement->execute();

        // Fetch all rows as an associative array
        $orders = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Close the database connection
        $conn = null;

        // Return the orders array
        return $orders;
    }

    // Method to get sold houses with details
    public static function getSoldHousesWithDetails() {
        try {
            // Get database connection
            $conn = getDBConnection();

            // Prepare SQL query to fetch sold houses with details
            $sql = "SELECT 
                        h.upiNumber AS 'House UPI',
                        h.price AS 'House Price',
                        h.location AS 'House Location',
                        s.name AS 'Seller Name',
                        b.name AS 'Buyer Name',
                        p.amount AS 'Amount Paid'
                    FROM 
                        house h
                    JOIN 
                        payment p ON h.id = p.houseId
                    JOIN 
                        user s ON h.sellerId = s.id
                    JOIN 
                        user b ON p.buyerId = b.id
                    WHERE 
                        p.status = 'Approved'";
            
            // Prepare the statement
            $stmt = $conn->prepare($sql);
            
            // Execute the statement
            $stmt->execute();
            
            // Fetch all sold houses with details
            $soldHouses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Close the statement and connection
            $stmt->closeCursor();
            $conn = null;

            // Return the fetched sold houses with details
            return $soldHouses;
        } catch (PDOException $e) {
            // Handle any database errors
            return array(); // Return an empty array in case of an error
        }
    }

    // Function to get user details by ID
    public function getUserDetailsByID($userID) {
        $sql = "SELECT * FROM user WHERE id = $userID";
        $result = $this->pdo->query($sql);
        if ($result->num_rows > 0) {
            // Fetch user details
            $userDetails = $result->fetch_assoc();
            return $userDetails;
        } else {
            return false; // User not found
        }
    }

    public static function validateAdminCredentials($username, $password,$role) {
        $conn = getDBConnection();
        // SQL query to check admin credentials
        $sql = "SELECT * FROM admin WHERE username = :username AND password = :password and role='$role'";
        $stmt = $conn ->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // If a row is returned, admin credentials are valid
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAdminDetails($username='', $password='', $role = '') {
        
        $conn = getDBConnection();
        // Prepare SQL query to select admin details based on username and password
        $sql = "SELECT * FROM admin WHERE username = :username AND password = :password";

        // Optionally filter by role if provided
        if ($role !== null) {
            $sql .= " AND role = :role";
        }

        // Prepare the statement
        $stmt = $conn ->prepare($sql);

        // Bind parameters
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        
        // Bind role parameter if provided
        if ($role !== null) {
            $stmt->bindParam(":role", $role);
        }

        // Execute the statement
        $stmt->execute();

        // Fetch admin details
        $admin_details = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return admin details
        return $admin_details;
    }
}
// Initialize the database connection
OHSMS::init();

?>
