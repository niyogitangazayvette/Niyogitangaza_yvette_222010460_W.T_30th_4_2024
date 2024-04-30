<?php

function getDBConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "yvette-niyogitangaza-ohsms";
    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // Set PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch(PDOException $e) {
        // Display error message if connection fails
        echo "Connection failed: " . $e->getMessage();
    }
}

?>
