<?php
require '../connection.php'; 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

$get_pending_requests_query = "SELECT Application.ApplicationID, User.FirstName, User.MiddleName, User.LastName, Exam.GradingPeriod, Application.ReasonType FROM ApplicationCourseExam CourseExam 
JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID 
JOIN Applications Application ON CourseExam.ApplicationID = Application.ApplicationID 
JOIN Users User ON Application.UserID = User.UserID 
WHERE Application.ApplicationStatus = 1 GROUP BY Application.ApplicationID";

$result = $conn->query($get_pending_requests_query);

if($result->num_rows > 0){
    $pending_requests = [];

    while($row = $result->fetch_assoc()){
        $pending_requests[] = $row;
    }

    echo json_encode($pending_requests);
} else {
    echo json_encode(['error' => 'No pending requests found.']);
    exit;
}
$conn->close();
?>