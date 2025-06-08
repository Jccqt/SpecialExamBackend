<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$studentID = $_POST['studentID'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$schoolEmail = $_POST['schoolEmail'];
$userPassword = $_POST['userPassword'];
$studentPassword = password_hash($userPassword, PASSWORD_DEFAULT);
$userRole = "Student";
$status = 1;
$logCount = 0;

$add_user_query = "INSERT INTO Users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($add_user_query);
$stmt->bind_param("sssssssii", $studentID, $firstName, $middleName, $lastName, $schoolEmail, $studentPassword, $userRole, $status, $logCount);
if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'User added successfully!']);
} else {
    throw new exception('Failed to add user');
}
$stmt->close();
$conn->close();
?>