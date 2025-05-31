<?php
require '../connection.php'; //connect to database

//student details
$student_id = "02000286986";
$first_name = "Adrianne";
$last_name = "Villa";
$middle_name = "Lapada";
$student_email = "villa.286986@balagtas.sti.edu.ph";
$student_pass = password_hash("villa", PASSWORD_DEFAULT);
$role = "Student";
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