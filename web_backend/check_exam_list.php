<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$check_exam_list_query = "SELECT ExamID FROM Examinations WHERE ExamStatus = 1";

$result = $conn->query($check_exam_list_query);

if($result->num_rows > 0){
    echo json_encode(true);
} else {
    echo json_encode(false);
}
$conn->close();
?>