<?php
require '../../connection.php';

if(isset($_POST['UserID'])){
    $student_id = $_POST['UserID'];

    $get_application_list_query = "SELECT CourseExam.ApplicationID, Exam.GradingPeriod, Application.ReasonType, Application.ApplicationStatus FROM ApplicationCourseExam CourseExam 
    JOIN Examinations Exam ON CourseExam.ExamID = Exam.ExamID JOIN Applications Application ON CourseExam.ApplicationID = Application.ApplicationID WHERE Application.UserID = ? GROUP BY CourseExam.ApplicationID";

    $stmt = $conn->prepare($get_application_list_query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $application_ids = [];
        $grading_periods = [];
        $reasons = [];
        $application_status = [];

        while($row = $result->fetch_assoc()){
            $application_ids[] = $row['ApplicationID'];
            $grading_periods[] = $row['GradingPeriod'];
            $reasons[] = $row['ReasonType'];
            $application_status[] = $row['ApplicationStatus'];
        }

        echo json_encode(["Submission Alert" => true,
        "Application IDs" => $application_ids,
        "Grading Periods" => $grading_periods,
        "Reasons" => $reasons,
        "Application Statuses" => $application_status]);
    } else {
        echo json_encode(["Submission Alert" => false]);
    }
    $stmt->close();
}
$conn->close();
?>
