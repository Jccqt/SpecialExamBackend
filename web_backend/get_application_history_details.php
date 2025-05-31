<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents('php://input'), true);
$application_id = $data['applicationID'] ?? null;

$get_application_history_query = "SELECT User.FirstName, User.MiddleName, User.LastName, User.UserID, Application.ProgramID, Exam.GradingPeriod, Exam.Term, Application.ReasonType, Application.PaymentType, 
Application.ApplicationDate, Application.VerdictDate, Application.ApplicationStatus, Course.CourseName, CourseExam.CourseID FROM ApplicationCourseExam CourseExam 
JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID 
JOIN Courses Course ON CourseExam.CourseID = Course.CourseID 
JOIN Applications Application ON CourseExam.ApplicationID = Application.ApplicationID 
JOIN Users User ON Application.UserID = User.UserID 
WHERE Application.ApplicationID = ?";

$stmt = $conn->prepare($get_application_history_query);
$stmt->bind_param("s", $application_id);
$stmt->execute();
$result = $stmt->get_result();

$response = [];
$courses = [];

if($row = $result->fetch_assoc()){
    $response = [
        'studentName' => $row['FirstName'] . ' ' . $row['MiddleName'] . ' ' . $row['LastName'],
        'userID' => $row['UserID'],
        'programID' => $row['ProgramID'],
        'gradingPeriod' => $row['GradingPeriod'],
        'term' => $row['Term'],
        'reasonType' => $row['ReasonType'],
        'paymentType' => $row['PaymentType'],
        'applicationStatus' => $row['ApplicationStatus'],
        'applicationDate' => $row['ApplicationDate'],
        'verdictDate' => $row['VerdictDate'],
        'courses' => []
    ];

    $courses[] = [
        'courseID' => $row['CourseID'],
        'courseName' => $row['CourseName']
    ];

    while($row = $result->fetch_assoc()){
        $courses[] = [
            'courseID' => $row['CourseID'],
            'courseName' => $row['CourseName']
        ];
    }

    $response['courses'] = $courses;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>