<?php 
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$get_application_history_query = "SELECT Application.ApplicationID, User.FirstName, User.MiddleName, User.LastName, Exam.GradingPeriod, Application.ReasonType, Application.ApplicationStatus 
FROM ApplicationCourseExam CourseExam 
JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID 
JOIN Applications Application ON CourseExam.ApplicationID = Application.ApplicationID 
JOIN Users User ON Application.UserID = User.UserID 
WHERE Application.ApplicationStatus = 2 OR Application.ApplicationStatus = 0 GROUP BY Application.ApplicationID";

$result = $conn->query($get_application_history_query);

if($result->num_rows > 0){
    $application_history = [];

    while($row = $result->fetch_assoc()){
        $application_history[] = $row;
    }

    echo json_encode($application_history);
} else {
    echo json_encode(['error' => 'No pending requests found.']);
    exit;
}
$conn->close();
?>