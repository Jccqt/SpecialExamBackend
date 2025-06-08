<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$role = $_POST['userRole'];

$check_existing_user_query = "SELECT * FROM Users WHERE FirstName = ? AND MiddleName = ? AND LastName = ? AND Role = ?";
$stmt = $conn->prepare($check_existing_user_query);
$stmt->bind_param("ssss", $firstName, $middleName, $lastName, $role);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    echo json_encode(true);
} else {
    echo json_encode(false);
}
$stmt->close();
$conn->close();
?>