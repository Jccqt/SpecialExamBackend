<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$get_student_list_query = "SELECT UserID, FirstName, MiddleName, LastName, Role FROM Users WHERE Role = 'Student'";
$result = $conn->query($get_student_list_query);

if($result->num_rows > 0){
    $user_list = [];

    while($row = $result->fetch_assoc()){
        $user_list[] = $row;
    }

    echo json_encode($user_list);
} else {
    echo json_encode(['error' => 'No pending requests found.']);
    exit;
}
$conn->close();
?>