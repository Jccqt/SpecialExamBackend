<?php
require '../connection.php';

$user_id = "297700";
    $reason_type = "Medical";
    $reason = "Natalisod";
    $current_date = date('Y-m-d H:i');
    $status = 1;

    $get_submission_count_query = "SELECT COUNT(ApplicationID) AS count FROM Applications";
    $result = $conn->query($get_submission_count_query);
    $count = $result->fetch_assoc();
    $submission_count = "APPLICATION". $count['count']+1;

    $submit_application_query = "INSERT INTO Applications(ApplicationID, UserID, ReasonType, Reason, ApplicationDate, ApplicationStatus) VALUES(?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($submit_application_query);
    $stmt->bind_param("sssssi", $submission_count, $user_id, $reason_type, $reason, $current_date, $status);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo json_encode(["Submission Alert" => true]);
    } else {
        echo json_encode(["Submission Alert" => false]);
    } 
?>