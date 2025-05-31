<?php 
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents('php://input'), true);
$applicationID = $data['applicationID'] ?? null;

$get_application_details_query = "SELECT User.FirstName, User.MiddleName, User.LastName, User.UserID, Application.ProgramID, Exam.GradingPeriod,
 Application.ReasonType, Course.CourseName, CourseExam.CourseID, Application.ApplicationStatus FROM ApplicationCourseExam CourseExam 
 JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID 
 JOIN Applications Application ON CourseExam.ApplicationID = Application.ApplicationID 
 JOIN Courses Course ON CourseExam.CourseID = Course.CourseID 
 JOIN Users User ON Application.UserID = User.UserID WHERE Application.ApplicationID = ?";

 $stmt = $conn->prepare($get_application_details_query);
 $stmt->bind_param("s", $applicationID);
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
        'reasonType' => $row['ReasonType'],
        'status' => $row['ApplicationStatus'],
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