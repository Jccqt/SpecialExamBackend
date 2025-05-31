<?php
require '../connection.php';

date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$application_id = $_POST['applicationID'];
$payment = $_POST['payment'];
$status = $_POST['status'];
$current_date = date('Y-m-d H:i');

$conn->begin_transaction();

try{
    $get_lastday_submission_query = "SELECT SubmissionEnd FROM Examinations WHERE ExamStatus = 1";
    $date_row = $conn->query($get_lastday_submission_query);
    $row = $date_row->fetch_assoc();
    $examDate = $row['SubmissionEnd'];
    $examDateObj = new DateTime($examDate);
    $examDateObj->modify('+1 day');
    $examDateFormatted = $examDateObj->format('Y-m-d');

    $update_application_query = "UPDATE Applications SET PaymentType = ?, VerdictDate = ?, ApplicationStatus = ? WHERE ApplicationID = ?";

    $stmt = $conn->prepare($update_application_query);
    $stmt->bind_param("ssis", $payment, $current_date, $status, $application_id);

    if($stmt->execute()){
        echo json_encode(['success' => true, 'message' => 'Application updated successfully!']);
    } else {
        throw new exception('Failed to update application');
    }

    if($status == 2){
        $add_exam_date_query = "UPDATE ApplicationCourseExam SET ExamDate = ?, CourseExamStatus = 2 WHERE ApplicationID = ?";
        $exam_stmt = $conn->prepare($add_exam_date_query);
        $exam_stmt->bind_param("ss", $examDateFormatted, $application_id);
        $exam_stmt->execute();
    }

    $get_user_id_query = "SELECT UserID FROM Applications WHERE ApplicationID = ?";
    $user_stmt = $conn->prepare($get_user_id_query);
    $user_stmt->bind_param("s", $application_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['UserID'];

    $verdict = '';
    if($status == 0){
        $verdict = 'Declined';
    } else {
        $verdict = 'Approved';
    }
    
    $title = $application_id . ' result';
    $message = $application_id . ' has been '  . $verdict;

    $insert_notification_query = "INSERT INTO Notifications(UserID, Title, Message, date) VALUES(?, ?, ?, ?)";
    $notif_stmt = $conn->prepare($insert_notification_query);
    $notif_stmt->bind_param("ssss", $user_id, $title, $message, $current_date);
    $notif_stmt->execute();
    
    $conn->commit();
} catch(error){
    $conn->rollback();
        echo json_encode(["Submission Alert" => false,
        "Error Message" => $e->getMessage()]);
}
$stmt->close();
$conn->close();

?>