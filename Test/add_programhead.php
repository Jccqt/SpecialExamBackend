<?php
require 'connection.php';

$program_head_ID = "PROGHEAD1";
$first_name = "Regina";
$last_name = "Mape";
$middle_name = "R.";
$email = "123sample@balagtas.sti.edu.ph";
$password = password_hash("sample", PASSWORD_DEFAULT);
$role = "Program Head";
$status = 1;
$logCount = 1;

$add_query = "INSERT INTO Users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($add_query);
$stmt->bind_param("sssssssii", $program_head_ID, $first_name, $last_name, $middle_name, $email, $password, $role, $status, $logCount);
$stmt->execute();

if($stmt->affected_rows > 0){
    echo("Program head added successfully!");
} else {
    echo("Failed to add program head");
}

$stmt->close();
$conn->close();
?>