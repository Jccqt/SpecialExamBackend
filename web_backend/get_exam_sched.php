<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents('php://input'), true);
$exam_id = $data['examID'] ?? null;

$get_exam_sched_query = "SELECT User.FirstName, User.MiddleName, User.LastName, CourseExam.Room, CourseExam.StartTime, CourseExam.EndTime, Exam.SchoolYearStart, Exam.SchoolYearEnd, Exam.GradingPeriod FROM ApplicationCourseExam CourseExam 
JOIN Users User ON CourseExam.UserID = User.UserID 
JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID 
WHERE CourseExam.ExamID = ? AND User.Role = 'Proctor'";

$stmt = $conn->prepare($get_exam_sched_query);
$stmt->bind_param("s", $exam_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $response = [];

    while($row = $result->fetch_assoc()){
        $response[] = $row;
    }
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'No pending requests found.']);
    exit;
}
$stmt->close();
$conn->close();
?>