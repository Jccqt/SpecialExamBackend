<?php
require 'connection.php';

$program_head_ID = "PROGHEAD1";
$first_name = "Regina";
$last_name = "Mape";
$middle_name = "R.";
$email = "123sample@balagtas.sti.edu.ph";
$password = password_hash("sample", PASSWORD_DEFAULT);
$handle = "BSIT";
$status = 1;

$add_query = "INSERT INTO ProgramHeads VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($add_query);
$stmt->bind_param("sssssssi", $program_head_ID, $first_name, $last_name, $middle_name, $email, $password, $handle, $status);
$stmt->execute();

$stmt->close();
$conn->close();
?>