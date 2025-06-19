<?php
require '../connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$get_chart_data_query = "SELECT DISTINCT COUNT(CourseExam.ApplicationID) AS ApplicationCount, Exam.GradingPeriod FROM ApplicationCourseExam CourseExam  
JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID 
GROUP BY CourseExam.ApplicationID";
$result = $conn->query($get_chart_data_query);

$application_count = [
    "PRELIM" => 0,
    "MIDTERM" => 0,
    "PRE-FINALS" => 0,
    "FINALS" => 0
    ];

if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){
        $application_count[$row['GradingPeriod']] = $row['ApplicationCount'];
    }

} 
echo json_encode($application_count);
$conn->close();
?>