<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$get_exam_list_query = "SELECT ExamID, SchoolYearStart, SchoolYearEnd, Term, GradingPeriod, SubmissionStart, SubmissionEnd, ExamStatus FROM Examinations";

$result = $conn->query($get_exam_list_query);

if($result->num_rows > 0){
    $exam_list = [];

    while($row = $result->fetch_assoc()){
        $exam_list[] = $row;
    }

    echo json_encode($exam_list);
} else {
    echo json_encode(['error' => 'No pending requests found.']);
    exit;
}
$conn->close();
?>