<?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "exam");

    // Check connection
    if($conn->connect_error){
        die("Connrection failed: " . $conn->connect_error); // If connection fails, die and show error message
    }
?>