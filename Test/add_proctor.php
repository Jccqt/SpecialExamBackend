<?php
require '../connection.php';

$student_id = "PROCTOR1";
$first_name = "Juan";
$last_name = "Dela Cruz";
$middle_name = "Tanggol";
$student_email = "delacruz.proctor1@balagtas.sti.edu.ph";
$student_pass = password_hash("tanggol", PASSWORD_DEFAULT);
$role = "Proctor";
$status = 1;
$logCount = 1;

//insert query
$add_query = "INSERT INTO Users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($add_query);
$stmt->bind_param("sssssssii", $student_id, $first_name, $last_name, $middle_name, $student_email, $student_pass, $role, $status, $logCount);
$stmt->execute();

//close statements and connection
$stmt->close();
$conn->close();

?>