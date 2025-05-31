<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents('php://input'), true);
$examID = $data['examID'] ?? null;

$get_exam_data_query = "SELECT CourseExam.ExamID, CourseExam.ExamDate, Course.CourseName, COUNT(Course.CourseName) AS CourseCount FROM ApplicationCourseExam CourseExam 
JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID 
JOIN Courses Course ON CourseExam.CourseID = Course.CourseID WHERE CourseExam.ExamID = ? AND CourseExam.CourseExamStatus = 2 GROUP BY Course.CourseID";

$stmt = $conn->prepare($get_exam_data_query);
$stmt->bind_param("s", $examID);
$stmt->execute();
$result = $stmt->get_result();

$reponse = [];
$courses = [];

if($row = $result->fetch_assoc()){
    $response = [
        'examID' => $row['ExamID'],
        'examDate' => $row['ExamDate'],
        'courses' => []
    ];

    $courses[] = [
        'courseNames' => $row['CourseName'] . ' - ' . $row['CourseCount']
    ];

    while($row = $result->fetch_assoc()){
        $courses[] = [
            'courseNames' => $row['CourseName'] . ' - ' . $row['CourseCount']
        ];
    }

    $response['courses'] = $courses;
}

 echo json_encode($response);
 $stmt->close();
 $conn->close();
?>