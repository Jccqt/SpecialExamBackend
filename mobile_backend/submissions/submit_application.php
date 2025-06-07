<?php
require '../../connection.php';

date_default_timezone_set('Asia/Manila');

if(isset($_POST['UserID']) && isset($_POST['ProgramID']) && isset($_POST['ReasonType']) && isset($_POST['Reason']) && isset($_POST['CourseIDs'])){
    $user_id = $_POST['UserID'];
    $reason_type = $_POST['ReasonType'];
    $reason = $_POST['Reason'];
    $course_ids = $_POST['CourseIDs'];
    $program_id = $_POST['ProgramID'];
    if (!is_array($course_ids)) {
    $course_ids = [$course_ids];
}
    $current_date = date('Y-m-d H:i');
    $status = 1;

    $get_submission_count_query = "SELECT COUNT(ApplicationID) AS count FROM Applications";
    $count_result = $conn->query($get_submission_count_query);
    $count = $count_result->fetch_assoc();
    $submission_count = "APPLICATION". $count['count']+1;

    $get_ongoing_examination_query = "SELECT ExamID FROM Examinations WHERE ExamStatus = 1";
    $exam_result = $conn->query($get_ongoing_examination_query);
    $get_exam_id = $exam_result->fetch_assoc();
    $current_exam_id = $get_exam_id['ExamID'];

    $conn->begin_transaction();

    try{
        $insert_application_query = "INSERT INTO Applications(ApplicationID, UserID, ProgramID, ReasonType, Reason, ApplicationDate, ApplicationStatus) VALUES(?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($insert_application_query);
    $stmt->bind_param("ssssssi", $submission_count, $user_id, $program_id, $reason_type, $reason, $current_date, $status);
    $stmt->execute();

    $insert_courses_query = "INSERT INTO ApplicationCourseExam(ApplicationID, CourseID, ExamID, CourseExamStatus) VALUES (?,?, ?,?)";
    $course_stmt = $conn->prepare($insert_courses_query);
    
    foreach($course_ids as $course_id){
        $course_stmt->bind_param("sssi", $submission_count, $course_id, $current_exam_id, $status);
        $course_stmt->execute();
    }
    $conn->commit();
    echo json_encode(["Submission Alert" => true,
                    "ApplicationID" => $submission_count]);
    } catch(Exception $e) {
        $conn->rollback();
        echo json_encode(["Submission Alert" => false,
        "Error Message" => $e->getMessage()]);
    }

    $stmt->close();
    $course_stmt->close();
    
} else {
    echo json_encode(["Error Message" => "Error"]);
}
$conn->close();
?>