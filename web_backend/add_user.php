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
$program = $_POST['program'];
$studentPassword = password_hash($userPassword, PASSWORD_DEFAULT);
$userRole = "Student";
$status = 1;
$logCount = 0;

$conn->begin_transaction();

try{
    $add_user_query = "INSERT INTO Users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($add_user_query);
    $stmt->bind_param("sssssssii", $studentID, $firstName, $middleName, $lastName, $schoolEmail, $studentPassword, $userRole, $status, $logCount);
    $stmt->execute();

    $add_student_program = "INSERT INTO StudentPrograms VALUES (?, ?, ?)";
    $prog_stmt = $conn->prepare($add_student_program);
    $prog_stmt->bind_param("ssi", $program, $studentID, $status);
    $prog_stmt->execute();

    $stmt->close();
    $prog_stmt->close();
    $conn->commit();
    echo json_encode(['success' => true,
                    'message' => 'User added successfully!']);
} catch (Exception $e){
    $conn->rollback();
    echo json_encode(['success' => 'false',
                    'message' => $e->getMessage()]);
}

$conn->close();
?>