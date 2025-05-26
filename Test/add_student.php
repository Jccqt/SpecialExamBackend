<?php
require 'connection.php'; //connect to database

//student details
$student_id = "297700";
$first_name = "Jose";
$last_name = "Calayag";
$middle_name = "Buensuceso";
$student_email = "calayag.297700@balagtas.sti.edu.ph";
$student_pass = password_hash("jcpogi", PASSWORD_DEFAULT);
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