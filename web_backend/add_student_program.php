<?php 
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$program = $_POST['program'];
$studentID = $_POST['studentID'];
$status = 1;

$add_student_program_query = "INSERT INTO StudentPrograms VALUES (?, ?, ?)";
$stmt = $conn->prepare($add_student_program_query);
$stmt->bind_param("ssi", $program, $studentID, $status);
if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'User added successfully!']);
} else {
    throw new exception('Failed to add user');
}
$stmt->close();
$conn->close();
?>