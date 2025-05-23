<?php
// Connect to the database
require 'connection.php';

// Check if the form is submitted
if(isset($_POST['StudentID']) && isset($_POST['StudentPass'])){
    
    // Get the input values
    $student_id = $_POST['StudentID'];
    $student_pass = $_POST['StudentPass'];
    
    // Prepare the query - only check for StudentID to get the hashed password
    $login_query = "SELECT StudentPass FROM Students WHERE StudentID = ?";

    // Prepare the statement
    $stmt = $conn->prepare($login_query);
    $stmt->bind_param("s", $student_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    // Check if the query returned any rows
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($student_pass, $row['StudentPass'])){
            echo json_encode(["login success" => true]); // Return true if login is successful
        } else {
            echo json_encode(["login success" => false]); // Return false if login fails
        }
    } else {
        echo json_encode(["login success" => false]); // Return false if login fails
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>