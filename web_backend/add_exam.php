<?php
require '../connection.php'; 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$school_year_start = $_POST['schoolYearStart'];
$school_year_end = $_POST['schoolYearEnd'];
$term = $_POST['semester'];
$grading_period = $_POST['gradingPeriod'];
$submission_start = $_POST['submissionStart'];
$submission_end = $_POST['submissionEnd'];
$status = 1;

$get_exam_count_query = "SELECT COUNT(ExamID) AS ExamCount FROM Examinations";
$count_row = $conn->query($get_exam_count_query);
$exam_count = $count_row->fetch_assoc();
$new_exam_id = $exam_count['ExamCount'] + 1;
$exam_ID = "EXAM" . $new_exam_id;


$add_exam_query = "INSERT INTO Examinations VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($add_exam_query);
$stmt->bind_param("ssssissi", $exam_ID, $school_year_start, $school_year_end, $grading_period, $term, $submission_start, $submission_end, $status);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Examination added successfully!']);
} else {
    throw new exception('Failed to add examination');
}

$stmt->close();
$conn->close();
?>