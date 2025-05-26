<?php
// Connect to the database
require '../../connection.php';

// Check if the form is submitted
if(isset($_POST['Email']) && isset($_POST['Password'])){
    
    // Get the input values
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    
    // Prepare the query - only check for StudentID to get the hashed password
    $login_query = "SELECT users.UserID, users.FirstName, users.LastName, users.MiddleName, users.Email, users.Password, users.Role,
    users.LogCount, StudProgram.ProgramID FROM Users users JOIN StudentPrograms StudProgram ON users.UserID = StudProgram.UserID WHERE users.Email = ? AND users.Status = 1 
    AND StudProgram.Status = 1 AND users.Role = 'Student' OR Users.Role = 'Proctor'";

    // Prepare the statement
    $stmt = $conn->prepare($login_query);
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    // Check if the query returned any rows
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['Password'])){
            echo json_encode(["Login Alert" => true,
                            "UserID" => $row['UserID'],
                            "FirstName" => $row['FirstName'],
                            "LastName" => $row['LastName'],
                            "MiddleName" => $row['MiddleName'],
                            "Role" => $row['Role'],
                            "LogCount" => $row['LogCount'],
                            "ProgramID" => $row['ProgramID']]); // Return true if login is successful
        } else {
            echo json_encode(["Login Alert" => false]); // Return false if login fails
        }
    } else {
        echo json_encode(["Login Alert" => false]); // Return false if login fails
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>